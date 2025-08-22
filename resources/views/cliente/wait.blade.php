@extends('layouts.app')

@section('title', 'Aguardando Aprovação')
@section('page-title', 'Status Pendente')

@section('content')
<div class="max-w-md mx-auto text-center space-y-6">
    <div class="w-24 h-24 bg-yellow-100 dark:bg-yellow-900/20 rounded-full flex items-center justify-center mx-auto">
        <i data-lucide="clock" class="w-12 h-12 text-yellow-600 dark:text-yellow-400"></i>
    </div>
    <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Aguardando Aprovação</h2>
    <p class="text-gray-600 dark:text-gray-400">
        Seu cadastro foi recebido com sucesso. Ele está em análise e, em breve, você receberá uma notificação para prosseguir com a próxima etapa.
    </p>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush