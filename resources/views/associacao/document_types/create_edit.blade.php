@extends('layouts.app')

@section('title', isset($documentType) ? 'Editar Tipo de Documento' : 'Novo Tipo de Documento')
@section('page-title', isset($documentType) ? 'Editar Tipo de Documento' : 'Novo Tipo de Documento')

@section('content')
<div class="max-w-xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ isset($documentType) ? 'Editar Tipo' : 'Novo Tipo de Documento' }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ isset($documentType) ? 'Atualize o tipo de documento.' : 'Crie um novo tipo de documento para sua associação.' }}
                    </p>
                </div>
            </div>
            <a href="{{ route('associacao.document-types.index') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>
    
    <form action="{{ isset($documentType) ? route('associacao.document-types.update', $documentType) : route('associacao.document-types.store') }}" 
          method="POST" class="space-y-6">
        @csrf
        @if(isset($documentType))
            @method('PUT')
        @endif
        
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Nome do Tipo de Documento *
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $documentType->name ?? '') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg dark:bg-gray-700 dark:text-white @error('name') border-red-500 @enderror"
                           placeholder="Ex: RG, Comprovante de Endereço">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="is_required" name="is_required" value="1"
                               {{ old('is_required', $documentType->is_required ?? false) ? 'checked' : '' }}
                               class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <label for="is_required" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Obrigatório</label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                               {{ old('is_active', $documentType->is_active ?? false) ? 'checked' : '' }}
                               class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                        <label for="is_active" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Ativo</label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('associacao.document-types.index') }}" 
               class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 transition-colors">
                Cancelar
            </a>
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                Salvar Tipo
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush