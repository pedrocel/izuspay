@extends('layouts.app')

@section('title', 'Envio de Documentos')
@section('page-title', 'Documentação Pendente')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-red-50 to-orange-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-red-100 dark:border-gray-600">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Atenção!</h2>
                <p class="text-gray-600 dark:text-gray-400">
                    Sua documentação está pendente. Por favor, envie os documentos abaixo para prosseguir com a associação.
                </p>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Enviar Novo Documento</h3>
        
        <form action="{{ route('associacao.documentos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label for="document_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo de Documento</label>
                <select id="document_type" name="document_type" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('document_type') border-red-500 @enderror">
                    <option value="">Selecione...</option>
                    <option value="RG">RG</option>
                    <option value="CPF">CPF</option>
                    <option value="Comprovante de Endereço">Comprovante de Endereço</option>
                </select>
                @error('document_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="document_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Arquivo</label>
                <input type="file" id="document_file" name="document_file" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('document_file') border-red-500 @enderror">
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Formatos aceitos: PDF, JPG, JPEG, PNG. Máximo 2MB.</p>
                @error('document_file') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Enviar Documento
            </button>
        </form>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Meus Documentos Enviados</h3>
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($documentations as $doc)
            <li class="py-4 flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $doc->document_type }}</p>
                    <div class="flex items-center mt-1">
                        @if($doc->status === 'approved')
                            <span class="px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">Aprovado</span>
                        @elseif($doc->status === 'rejected')
                            <span class="px-2 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Reprovado</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium text-yellow-800 bg-yellow-100 rounded-full">Pendente</span>
                        @endif
                        @if($doc->rejection_reason)
                            <p class="ml-2 text-xs text-red-500 dark:text-red-400">Motivo: {{ $doc->rejection_reason }}</p>
                        @endif
                    </div>
                </div>
                <a href="{{ Storage::url($doc->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900">
                    <i data-lucide="eye" class="w-4 h-4"></i>
                </a>
            </li>
            @empty
            <li class="py-4 text-center text-gray-500 dark:text-gray-400">Nenhum documento enviado ainda.</li>
            @endforelse
        </ul>
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