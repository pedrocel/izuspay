@extends('layouts.app')

@section('title', 'Contrato de Associação')
@section('page-title', 'Contrato Pendente')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-red-50 to-orange-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-red-100 dark:border-gray-600">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center">
                <i data-lucide="file-signature" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Contrato de Associação</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Seu pagamento foi confirmado! Por favor, leia e assine o contrato para finalizar sua associação.
                </p>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Conteúdo do Contrato</h3>
        <div class="prose max-w-none dark:prose-invert" style="max-height: 500px; overflow-y: auto; border: 1px solid #e5e7eb; padding: 1rem; border-radius: 0.5rem;">
            <p><strong>Cláusula 1: Objeto do Contrato</strong></p>
            <p>O presente contrato tem por objeto regular a associação do [Nome do Cliente] à [Nome da Associação]...</p>
            </div>
        
        <form action="{{ route('cliente.contrato.sign') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div class="flex items-center">
                <input type="checkbox" id="aceite" name="aceite" required
                       class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                <label for="aceite" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Li e concordo com os termos e condições do contrato.
                </label>
            </div>
            <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Assinar e Ativar Associação
            </button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush