<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Association;
use Illuminate\Http\Request;

class AssociationController extends Controller
{
    public function index(Request $request)
    {
        $query = Association::with(['users', 'plans', 'products', 'wallet', 'creatorProfile', 'sales', 'withdrawals', 'fees']);

        // Filtro por período
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // Filtro por busca (nome, email, documento)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('documento', 'like', "%{$request->search}%");
            });
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $associations = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.associations.index', compact('associations'));
    }

    public function show(Association $association)
    {
        // Carrega todos os relacionamentos necessários para a tela de detalhes
        $association->load([
            'users',
            'creatorProfile',
            'plans',
            'products',
            'wallet',
            'bankAccounts',
            'sales' => function ($query) {
                $query->with(['user', 'product', 'plan'])->latest()->take(10); // Pega as 10 últimas vendas
            },
            'withdrawals' => function ($query) {
                $query->with('bankAccount')->latest()->take(10); // Pega os 10 últimos saques
            }
        ]);

        return view('admin.associations.show', compact('association'));
    }
}
