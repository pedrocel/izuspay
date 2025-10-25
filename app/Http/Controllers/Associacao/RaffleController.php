<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\Raffle;
use App\Models\RaffleTicket;
use App\Services\RaffleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RaffleController extends Controller
{
    protected $raffleService;

    public function __construct(RaffleService $raffleService)
    {
        $this->raffleService = $raffleService;
    }

    // Exibir a lista de rifas
    public function index(Request $request)
    {
        $raffles = Raffle::where('association_id', auth()->user()->association_id)
            ->withCount(['tickets', 'sales'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('associacao.raffles.index', compact('raffles'));
    }

    // Exibir o formulário de criação de rifa
    public function create()
    {
        return view('associacao.raffles.create_edit');
    }

    // Criar nova rifa
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'total_tickets' => 'required|integer|min:1',
            'draw_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $price = str_replace(',', '.', $request->input('price'));

        $data = [
            'association_id' => auth()->user()->association_id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $price,
            'total_tickets' => $request->input('total_tickets'),
            'status' => $request->input('status', 'active'),
            'draw_date' => $request->input('draw_date'),
        ];

        // Upload da imagem, se houver
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('raffles', 'public');
        }

        $raffle = Raffle::create($data);

        return redirect()->route('associacao.raffles.index')
            ->with('success', 'Rifa criada com sucesso!');
    }

    // Exibir o formulário de edição da rifa
    public function edit($id)
    {
        $raffle = Raffle::where('id', $id)
            ->where('association_id', auth()->user()->association_id)
            ->firstOrFail();
        
        return view('associacao.raffles.create_edit', compact('raffle'));
    }

    // Atualizar as informações da rifa
    public function update(Request $request, Raffle $raffle)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'draw_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $price = str_replace(',', '.', $request->input('price'));

        $updateData = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $price,
            'status' => $request->input('status', 'active'),
            'draw_date' => $request->input('draw_date'),
        ];

        // Upload da imagem, se houver
        if ($request->hasFile('image')) {
            // Deleta imagem antiga
            if ($raffle->image) {
                Storage::disk('public')->delete($raffle->image);
            }
            $updateData['image'] = $request->file('image')->store('raffles', 'public');
        }

        $raffle->update($updateData);

        return redirect()->route('associacao.raffles.index')
            ->with('success', 'Rifa atualizada com sucesso!');
    }

    // Criar tickets para a rifa
    public function createTickets(Raffle $raffle)
    {
        if ($raffle->created_tickets) {
            return back()->with('error', 'Os tickets já foram criados para esta rifa!');
        }

        $success = $this->raffleService->createTicketsForRaffle(
            $raffle->id, 
            $raffle->total_tickets
        );

        if ($success) {
            return redirect()->route('associacao.raffles.index')
                ->with('success', 'Tickets criados com sucesso!');
        }

        return back()->with('error', 'Erro ao criar tickets.');
    }

    // Visualizar tickets da rifa
    public function viewTickets(Raffle $raffle)
    {
        $tickets = $raffle->tickets()
            ->with('raffleSale')
            ->orderBy('number')
            ->paginate(100);
        
        $stats = [
            'total' => $raffle->total_tickets,
            'sold' => $raffle->tickets()->where('status', 'sold')->count(),
            'available' => $raffle->tickets()->where('status', 'available')->count(),
        ];
        
        return view('associacao.raffles.tickets', compact('raffle', 'tickets', 'stats'));
    }

    // Sortear ganhador
    public function drawWinner(Raffle $raffle)
    {
        if ($raffle->status === 'completed') {
            return back()->with('error', 'Esta rifa já foi sorteada!');
        }

        $winner = $this->raffleService->drawWinner($raffle->id);

        if ($winner) {
            return redirect()->route('associacao.raffles.index')
                ->with('success', 'Ganhador sorteado com sucesso!');
        }

        return back()->with('error', 'Não há tickets vendidos para sortear.');
    }

    // Visualizar vendas
    public function sales(Request $request)
    {
        $sales = \App\Models\RaffleSale::whereHas('raffle', function($query) {
                $query->where('association_id', auth()->user()->association_id);
            })
            ->with(['raffle', 'tickets'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        return view('associacao.raffles.sales', compact('sales'));
    }

    // Excluir uma rifa
    public function destroy(Raffle $raffle)
    {
        if ($raffle->created_tickets) {
            return back()->with('error', 'Não é possível excluir uma rifa que já possui tickets criados!');
        }

        // Deleta imagem se existir
        if ($raffle->image) {
            Storage::disk('public')->delete($raffle->image);
        }

        $raffle->delete();
        
        return redirect()->route('associacao.raffles.index')
            ->with('success', 'Rifa excluída com sucesso!');
    }
}
