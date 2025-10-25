<?php

namespace App\Services;

use App\Models\Raffle;
use App\Models\RaffleTicket;
use App\Models\RaffleSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RaffleService
{
    public function createTicketsForRaffle(int $raffleId, int $totalTickets): bool
    {
        return DB::transaction(function () use ($raffleId, $totalTickets) {
            $tickets = [];
            for ($i = 1; $i <= $totalTickets; $i++) {
                $tickets[] = [
                    'id' => (string) Str::uuid(),
                    'raffle_id' => $raffleId,
                    'number' => $i,
                    'status' => 'available',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Insere em lotes para melhor performance
            foreach (array_chunk($tickets, 1000) as $chunk) {
                RaffleTicket::insert($chunk);
            }

            Raffle::where('id', $raffleId)->update(['created_tickets' => true]);

            return true;
        });
    }

    public function purchaseTickets(
        int $raffleId,
        string $buyerName,
        string $buyerEmail,
        int $quantity,
        ?int $userId = null,
        ?string $buyerPhone = null
    ): array {
        return DB::transaction(function () use ($raffleId, $buyerName, $buyerEmail, $quantity, $userId, $buyerPhone) {
            $raffle = Raffle::findOrFail($raffleId);
            
            $availableTickets = RaffleTicket::where('raffle_id', $raffleId)
                ->where('status', 'available')
                ->orderBy('number')
                ->limit($quantity)
                ->lockForUpdate()
                ->get();

            if ($availableTickets->count() < $quantity) {
                return ['error' => 'Tickets insuficientes disponíveis'];
            }

            $totalPrice = $raffle->price * $quantity;
            $feeTotal = $totalPrice * 0.05; // 5% de taxa
            $netAmount = $totalPrice - $feeTotal;

            $sale = RaffleSale::create([
                'raffle_id' => $raffleId,
                'user_id' => $userId,
                'buyer_name' => $buyerName,
                'buyer_email' => $buyerEmail,
                'buyer_phone' => $buyerPhone,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'payment_status' => 'paid',
                'fee_total' => $feeTotal,
                'net_amount' => $netAmount,
            ]);

            $ticketNumbers = [];
            foreach ($availableTickets as $ticket) {
                $ticket->update([
                    'status' => 'sold',
                    'raffle_sale_id' => $sale->id
                ]);
                
                $sale->tickets()->attach($ticket->id);
                $ticketNumbers[] = $ticket->number;
            }

            return [
                'success' => true,
                'sale_id' => $sale->id,
                'ticket_numbers' => $ticketNumbers,
                'total_price' => $totalPrice,
            ];
        });
    }

    public function drawWinner(int $raffleId): ?RaffleSale
    {
        return DB::transaction(function () use ($raffleId) {
            $soldTickets = RaffleTicket::where('raffle_id', $raffleId)
                ->where('status', 'sold')
                ->get();

            if ($soldTickets->isEmpty()) {
                return null;
            }

            $winnerTicket = $soldTickets->random();
            $winnerSale = $winnerTicket->raffleSale;

            Raffle::where('id', $raffleId)->update([
                'status' => 'completed',
                'winner_sale_id' => $winnerSale->id
            ]);

            return $winnerSale;
        });
    }
}
