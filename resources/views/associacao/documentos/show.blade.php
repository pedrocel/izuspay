@extends('layouts.app')

@section('title', 'Documentos de ' . $user->name)
@section('page-title', 'Detalhes dos Documentos')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-blue-100 dark:border-gray-600">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Documentos de {{ $user->name }}</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Gerencie a documentação do cliente e libere as próximas etapas.
                </p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Status da Documentação</h3>
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($submittedDocs as $doc)
            <li class="py-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ $doc->documentType->name }}
                        @if($doc->documentType->is_required)
                            <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                Obrigatório
                            </span>
                        @endif
                    </p>
                    <div class="flex items-center mt-1 space-x-2">
                        @if($doc->status === 'approved')
                            <span class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Aprovado</span>
                        @elseif($doc->status === 'rejected')
                            <span class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Reprovado</span>
                            @if($doc->rejection_reason)
                                <p class="ml-2 text-xs text-red-500 dark:text-red-400">Motivo: {{ $doc->rejection_reason }}</p>
                            @endif
                        @else
                            <span class="px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Pendente de Revisão</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    @if($doc->file_path)
                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" title="Ver arquivo">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </a>
                    @endif
                    
                    @if($doc->status !== 'approved')
                        <form action="{{ route('associacao.documentos.approve', ['documentation' => $doc->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Aprovar o documento {{ $doc->documentType->name }}?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" title="Aprovar">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                            </button>
                        </form>
                    @endif
                    
                    @if($doc->status !== 'rejected')
                        <button type="button" onclick="showRejectModal('{{ $doc->id }}')" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Reprovar">
                            <i data-lucide="x-circle" class="w-5 h-5"></i>
                        </button>
                    @endif
                </div>
            </li>
            @empty
            <li class="py-4 text-center text-gray-500 dark:text-gray-400">Nenhum documento enviado pelo cliente.</li>
            @endforelse
        </ul>
    </div>
</div>

<div id="reject-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl max-w-lg w-full p-6 transform transition-all">
            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 dark:bg-red-900/20 rounded-full">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600 dark:text-red-400"></i>
            </div>
            
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-center mb-2">Reprovar Documento</h3>
            <p class="text-gray-600 dark:text-gray-400 text-center mb-6">
                Informe o motivo da reprovação para o cliente.
            </p>
            
            <form id="reject-form" method="POST" action="">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Motivo</label>
                    <textarea name="rejection_reason" id="rejection_reason" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('rejection_reason') border-red-500 @enderror"></textarea>
                    @error('rejection_reason') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex space-x-4">
                    <button type="button" onclick="closeRejectModal()" 
                            class="flex-1 px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        Reprovar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function showRejectModal(docId) {
        const modal = document.getElementById('reject-modal');
        const form = document.getElementById('reject-form');
        form.action = `{{ route('associacao.documentos.reject', '') }}/${docId}`;
        modal.classList.remove('hidden');
    }
    
    function closeRejectModal() {
        const modal = document.getElementById('reject-modal');
        modal.classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush