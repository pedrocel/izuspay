<?php

namespace App\Http\Controllers;

use App\Models\Raffle;
use App\Models\RaffleSale;
use Illuminate\Http\Request;

class PublicRaffleController extends Controller
{
    public function index()
    {
        $raffles = Raffle::where('status', 'active')
            ->where('created_tickets', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('public.raffles.index', compact('raffles'));
    }

    public function show($hash_id)
    {
        $raffle = Raffle::where('hash_id', $hash_id)
            ->where('status', 'active')
            ->where('created_tickets', true)
            ->firstOrFail();

        $availableCount = $raffle->availableTicketsCount();
        $soldPercentage = $raffle->soldPercentage();

        return view('public.raffles.show', compact('raffle', 'availableCount', 'soldPercentage'));
    }

    public function winners()
    {
        $winners = Raffle::where('status', 'completed')
            ->whereNotNull('winner_sale_id')
            ->with(['winnerSale.tickets'])
            ->orderBy('draw_date', 'desc')
            ->limit(20)
            ->get();

        return view('public.raffles.winners', compact('winners'));
    }

    public function myNumbers(Request $request)
    {
        $email = $request->get('email');
        $phone = $request->get('phone');
        $sales = [];

        if ($email || $phone) {
            $query = RaffleSale::with(['raffle', 'tickets']);
            
            if ($email) {
                $query->where('buyer_email', $email);
            }
            
            if ($phone) {
                $query->orWhere('buyer_phone', 'like', '%' . preg_replace('/\D/', '', $phone) . '%');
            }
            
            $sales = $query->orderBy('created_at', 'desc')->get();
        }

        return view('public.raffles.my-numbers', compact('sales', 'email', 'phone'));
    }
}
