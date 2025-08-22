@extends('layouts.app')

@section('title', isset($banner) ? 'Editar Banner - AssociaMe' : 'Novo Banner - AssociaMe')
@section('page-title', isset($banner) ? 'Editar Banner' : 'Novo Banner')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="{{ isset($banner) ? 'image' : 'plus' }}" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ isset($banner) ? 'Editar Banner' : 'Novo Banner' }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ isset($banner) ? 'Atualize as informações do banner ' . $banner->name : 'Preencha os dados para criar um novo banner' }}
                    </p>
                </div>
            </div>
            <a href="{{ route('associacao.banners.index') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    <form action="{{ isset($banner) ? route('associacao.banners.update', $banner) : route('associacao.banners.store') }}" 
          method="POST" class="space-y-6">
        @csrf
        @if(isset($banner))
            @method('PUT')
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-2">
                    <i data-lucide="image" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detalhes do Banner</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="lg:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="tag" class="w-4 h-4 inline mr-1"></i>
                            Nome do Banner *
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $banner->name ?? '') }}" required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('name') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Ex: Banner de Lançamento">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="image_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="image-plus" class="w-4 h-4 inline mr-1"></i>
                            URL da Imagem *
                        </label>
                        <input type="url" id="image_url" name="image_url" value="{{ old('image_url', $banner->image_url ?? '') }}" required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('image_url') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="https://exemplo.com/banner.jpg">
                        @error('image_url')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="link" class="w-4 h-4 inline mr-1"></i>
                            Link (Opcional)
                        </label>
                        <input type="url" id="link" name="link" value="{{ old('link', $banner->link ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('link') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="https://exemplo.com">
                        @error('link')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="lg:col-span-2">
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="check-circle" class="w-4 h-4 inline mr-1"></i>
                            Status *
                        </label>
                        <select id="status" name="status" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('status') border-red-500 focus:ring-red-500 @enderror">
                            <option value="active" {{ old('status', $banner->status ?? '') == 'active' ? 'selected' : '' }}>
                                ✅ Ativo
                            </option>
                            <option value="inactive" {{ old('status', $banner->status ?? '') == 'inactive' ? 'selected' : '' }}>
                                ❌ Inativo
                            </option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    @if(isset($banner))
                    <div class="lg:col-span-2">
                        <div class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="image" class="w-4 h-4 inline mr-1"></i>
                            Pré-visualização do Banner
                        </div>
                        <img src="{{ $banner->image_url }}" alt="{{ $banner->name }}" class="w-full max-h-48 object-cover rounded-lg shadow-sm">
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('associacao.banners.index') }}" 
                   class="inline-flex items-center justify-center space-x-2 px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span>Cancelar</span>
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center space-x-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i data-lucide="{{ isset($banner) ? 'save' : 'plus' }}" class="w-4 h-4"></i>
                    <span>{{ isset($banner) ? 'Atualizar Banner' : 'Criar Banner' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection