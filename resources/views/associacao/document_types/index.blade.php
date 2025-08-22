@extends('layouts.app')

@section('title', 'Tipos de Documentos')
@section('page-title', 'Gerenciar Tipos de Documentos')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Tipos de Documentos</h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Gerencie os tipos de documentos que seus associados devem enviar.</p>
            </div>
            <a href="{{ route('associacao.document-types.create') }}" 
               class="inline-flex items-center space-x-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Novo Tipo</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total de Tipos</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $documentTypes->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="file-text" class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Obrigatórios</p>
                    <p class="text-2xl font-bold text-green-600">{{ $documentTypes->where('is_required', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Ativos</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $documentTypes->where('is_active', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/20 rounded-lg flex items-center justify-center">
                    <i data-lucide="activity" class="w-6 h-6 text-yellow-600 dark:text-yellow-400"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($documentTypes as $type)
            <li class="py-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <i data-lucide="file-text" class="w-5 h-5 text-gray-600 dark:text-gray-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $type->name }}</p>
                        <div class="flex items-center space-x-2 mt-1">
                            <span class="px-2 py-1 text-xs font-medium rounded-full {{ $type->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $type->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                            @if($type->is_required)
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                    Obrigatório
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('associacao.document-types.edit', $type) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" title="Editar">
                        <i data-lucide="edit" class="w-5 h-5"></i>
                    </a>
                    <form method="POST" action="{{ route('associacao.document-types.destroy', $type) }}" class="inline-block" onsubmit="return confirm('Excluir este tipo de documento?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" title="Excluir">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            </li>
            @empty
            <li class="py-4 text-center text-gray-500 dark:text-gray-400">Nenhum tipo de documento cadastrado.</li>
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