<?php

namespace App\Http\Controllers;

use App\Models\CreatorProfile;
use App\Models\User;
use Illuminate\Http\Request;

class PublicCreatorController extends Controller
{
    public function show($username)
    {
        // Buscar o criador pelo username
        $creator = CreatorProfile::where('username', $username)
            ->with(['user', 'association'])
            ->firstOrFail();

        // Dados mockados para os planos (você pode criar uma model Plans depois)
        $plans = [
            [
                'id' => 1,
                'name' => 'Mensal',
                'price' => 29.90,
                'period' => 'mês',
                'description' => 'Acesso completo ao conteúdo exclusivo',
                'features' => [
                    'Conteúdo exclusivo diário',
                    'Chat direto com o criador',
                    'Lives privadas semanais',
                    'Fotos e vídeos em alta qualidade'
                ]
            ],
            [
                'id' => 2,
                'name' => 'Trimestral',
                'price' => 79.90,
                'period' => '3 meses',
                'description' => 'Economize 10% no plano trimestral',
                'discount' => '10%',
                'original_price' => 89.70,
                'features' => [
                    'Tudo do plano mensal',
                    'Conteúdo bônus exclusivo',
                    'Acesso antecipado a novos conteúdos',
                    'Desconto em produtos personalizados'
                ]
            ],
            [
                'id' => 3,
                'name' => 'Semestral',
                'price' => 149.90,
                'period' => '6 meses',
                'description' => 'Economize 15% no plano semestral',
                'discount' => '15%',
                'original_price' => 179.40,
                'features' => [
                    'Tudo dos planos anteriores',
                    'Videochamada mensal exclusiva',
                    'Conteúdo personalizado',
                    'Acesso vitalício a conteúdos especiais'
                ]
            ],
            [
                'id' => 4,
                'name' => 'Anual',
                'price' => 279.90,
                'period' => '12 meses',
                'description' => 'Economize 20% no plano anual',
                'discount' => '20%',
                'original_price' => 358.80,
                'popular' => true,
                'features' => [
                    'Tudo dos planos anteriores',
                    'Encontro presencial anual (se possível)',
                    'Kit de produtos físicos exclusivos',
                    'Acesso vitalício a todo conteúdo',
                    'Participação em decisões de conteúdo'
                ]
            ]
        ];

        // Estatísticas mockadas (você pode implementar depois)
        $stats = [
            'followers' => rand(1000, 50000),
            'posts' => rand(100, 1000),
            'likes' => rand(10000, 100000),
            'subscribers' => rand(50, 500)
        ];

        return view('public.creator_profile', compact('creator', 'plans', 'stats'));
    }

    public function subscribe(Request $request, $username, $planId)
    {
        // Aqui você implementaria a lógica de assinatura
        // Por enquanto, apenas redireciona com mensagem
        
        $creator = CreatorProfile::where('username', $username)->firstOrFail();
        
        // Validar dados
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
        ]);

        // Aqui você integraria com gateway de pagamento (Stripe, PagSeguro, etc.)
        
        return redirect()->back()->with('success', 'Assinatura iniciada! Você receberá um email com as instruções de pagamento.');
    }
}
