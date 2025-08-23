@extends('layouts.app')

@section('title', isset($product) ? 'Editar Produto - Lux Secrets' : 'Novo Produto - Lux Secrets')
@section('page-title', isset($product) ? 'Editar Produto' : 'Novo Produto')

@section('content')
<!-- Removido gradiente roxo do fundo, usando apenas preto/branco com modo dark/light -->
<div class="min-h-screen bg-white dark:bg-black transition-colors duration-300 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header simplificado sem gradientes roxos -->
        <div class="relative bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-4 md:p-8 mb-8 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 md:space-x-6">
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-gray-100 dark:bg-gray-800 rounded-2xl flex items-center justify-center border border-gray-200 dark:border-gray-700">
                        <i data-lucide="{{ isset($product) ? 'package-check' : 'sparkles' }}" class="w-6 h-6 md:w-8 md:h-8 text-purple-600"></i>
                    </div>
                    <div>
                        <h1 class="text-xl md:text-3xl font-bold text-purple-600 mb-1 md:mb-2">
                            {{ isset($product) ? 'Editar Produto' : 'Criar Novo Produto' }}
                        </h1>
                        <!-- Removendo texto no mobile e diminuindo tamanho da fonte -->
                        <p class="hidden md:block text-gray-600 dark:text-gray-400 text-lg">
                            {{ isset($product) ? 'Atualize as informações do produto ' . $product->name : 'Transforme sua ideia em um produto incrível' }}
                        </p>
                    </div>
                </div>
                <a href="{{ route('associacao.products.index') }}" 
                   class="group flex items-center space-x-1 md:space-x-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 px-3 md:px-6 py-2 md:py-3 rounded-xl border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:scale-105">
                    <i data-lucide="arrow-left" class="w-4 h-4 md:w-5 md:h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="font-medium text-sm md:text-base">Voltar</span>
                </a>
            </div>
            
            <!-- Progress bar com cores roxas apenas -->
            <div class="relative mt-6 md:mt-8">
                <div class="flex items-center justify-between text-gray-500 dark:text-gray-400 text-xs md:text-sm mb-2">
                    <span>Progresso do Formulário</span>
                    <span id="progress-text">0% Completo</span>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                    <div id="progress-bar" class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full transition-all duration-500" style="width: 0%"></div>
                </div>
            </div>

            <!-- Indicadores de etapas responsivos com textos menores no mobile -->
            <div class="flex items-center justify-center mt-4 md:mt-6 space-x-4 md:space-x-8">
                <div class="flex items-center space-x-1 md:space-x-2 step-indicator active" data-step="1">
                    <div class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs md:text-sm font-semibold">1</div>
                    <span class="text-xs md:text-sm font-medium text-purple-600">Básico</span>
                </div>
                <div class="w-8 md:w-12 h-px bg-gray-300 dark:bg-gray-600"></div>
                <div class="flex items-center space-x-1 md:space-x-2 step-indicator" data-step="2">
                    <div class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-300 dark:bg-gray-600 text-gray-600 dark:text-gray-400 flex items-center justify-center text-xs md:text-sm font-semibold">2</div>
                    <span class="text-xs md:text-sm font-medium text-gray-500 dark:text-gray-400">Avançado</span>
                </div>
                <div class="w-8 md:w-12 h-px bg-gray-300 dark:bg-gray-600"></div>
                <div class="flex items-center space-x-1 md:space-x-2 step-indicator" data-step="3">
                    <div class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-300 dark:bg-gray-600 text-gray-600 dark:text-gray-400 flex items-center justify-center text-xs md:text-sm font-semibold">3</div>
                    <span class="text-xs md:text-sm font-medium text-gray-500 dark:text-gray-400">Imagem</span>
                </div>
            </div>
        </div>

        <form action="{{ isset($product) ? route('associacao.products.update', $product) : route('associacao.products.store') }}" 
              enctype="multipart/form-data" method="POST" id="product-form" class="space-y-8">
            @csrf
            @if(isset($product))
                @method('PUT')
            @endif

            <!-- Step 1: Informações Básicas -->
            <!-- Removendo classe hidden e garantindo que apareça por padrão -->
            <div class="form-step" data-step="1">
                <!-- Card com fundo branco/preto e bordas sutis -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 shadow-lg">
                    <div class="bg-gray-50 dark:bg-gray-800 px-4 md:px-8 py-4 md:py-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                <i data-lucide="info" class="w-4 h-4 md:w-5 md:h-5 text-purple-600"></i>
                            </div>
                            <div>
                                <!-- Títulos menores no mobile -->
                                <h3 class="text-lg md:text-xl font-bold text-purple-600">Informações Básicas</h3>
                                <p class="text-sm md:text-base text-gray-600 dark:text-gray-400">Defina os dados principais do seu produto</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 md:p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Nome do Produto -->
                            <div class="lg:col-span-2">
                                <label for="name" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="tag" class="w-4 h-4 inline mr-2"></i>
                                    Nome do Produto *
                                </label>
                                <div class="relative">
                                    <!-- Input com foco roxo e bordas sutis -->
                                    <input type="text" id="name" name="name" 
                                           value="{{ old('name', $product->name ?? '') }}" 
                                           required
                                           class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400 @error('name') border-red-500 focus:ring-red-500 @enderror"
                                           placeholder="Digite um nome atrativo para seu produto">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-6">
                                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500 hidden validation-success"></i>
                                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 hidden validation-error"></i>
                                    </div>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-2 flex items-center animate-fade-in">
                                        <i data-lucide="alert-triangle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                    <span id="name-counter">0</span>/100 caracteres
                                </div>
                            </div>
                            
                            <!-- Preço -->
                            <div>
                                <label for="price" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="dollar-sign" class="w-4 h-4 inline mr-2"></i>
                                    Preço *
                                </label>
                                <div class="relative">
                                    <span class="absolute left-6 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-400 font-medium">R$</span>
                                    <input type="text" id="price" name="price" 
                                           value="{{ old('price', $product->price ?? '') }}" 
                                           required
                                           class="w-full pl-12 pr-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400 @error('price') border-red-500 focus:ring-red-500 @enderror"
                                           placeholder="0,00">
                                </div>
                                @error('price')
                                    <p class="text-red-500 text-sm mt-2 flex items-center animate-fade-in">
                                        <i data-lucide="alert-triangle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                            
                            <!-- Status -->
                            <div>
                                <label for="is_active" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="activity" class="w-4 h-4 inline mr-2"></i>
                                    Status *
                                </label>
                                <select id="is_active" name="is_active" required
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400 @error('is_active') border-red-500 focus:ring-red-500 @enderror">
                                    <option value="1" {{ old('is_active', $product->is_active ?? '') == '1' ? 'selected' : '' }}>
                                        🟢 Ativo
                                    </option>
                                    <option value="0" {{ old('is_active', $product->is_active ?? '') == '0' ? 'selected' : '' }}>
                                        🔴 Inativo
                                    </option>
                                </select>
                                @error('is_active')
                                    <p class="text-red-500 text-sm mt-2 flex items-center animate-fade-in">
                                        <i data-lucide="alert-triangle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Descrição -->
                            <div class="lg:col-span-2">
                                <label for="description" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="align-left" class="w-4 h-4 inline mr-2"></i>
                                    Descrição
                                </label>
                                <textarea id="description" name="description" rows="4"
                                          class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400 resize-none @error('description') border-red-500 focus:ring-red-500 @enderror"
                                          placeholder="Descreva seu produto de forma atrativa e detalhada...">{{ old('description', $product->description ?? '') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-2 flex items-center animate-fade-in">
                                        <i data-lucide="alert-triangle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                    <span id="description-counter">0</span>/500 caracteres
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 2: Configurações Avançadas -->
            <!-- Mantendo hidden por padrão -->
            <div class="form-step hidden" data-step="2">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-lg">
                    <div class="bg-gray-50 dark:bg-gray-800 px-4 md:px-8 py-4 md:py-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                <i data-lucide="settings" class="w-4 h-4 md:w-5 md:h-5 text-purple-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg md:text-xl font-bold text-purple-600">Configurações Avançadas</h3>
                                <p class="text-sm md:text-base text-gray-600 dark:text-gray-400">Configure os detalhes técnicos do produto</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 md:p-8">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <!-- Tipo de Produto -->
                            <div>
                                <label for="tipo_produto" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="layers" class="w-4 h-4 inline mr-2"></i>
                                    Tipo de Produto
                                </label>
                                <select id="tipo_produto" name="tipo_produto"
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400">
                                    <option value="">Selecione o tipo...</option>
                                    <option value="0" {{ old('tipo_produto', $product->tipo_produto ?? '') == '0' ? 'selected' : '' }}>📦 Produto Físico</option>
                                    <option value="1" {{ old('tipo_produto', $product->tipo_produto ?? '') == '1' ? 'selected' : '' }}>💻 Produto Digital</option>
                                </select>
                            </div>

                            <!-- Entrega do Produto -->
                            <div>
                                <label for="entrega_produto" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="truck" class="w-4 h-4 inline mr-2"></i>
                                    Método de Entrega
                                </label>
                                <select id="entrega_produto" name="entrega_produto"
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400">
                                    <option value="">Selecione o método...</option>
                                    <option value="0" {{ old('entrega_produto', $product->entrega_produto ?? '') == '0' ? 'selected' : '' }}>🚫 Não anexa</option>
                                    <option value="1" {{ old('entrega_produto', $product->entrega_produto ?? '') == '1' ? 'selected' : '' }}>🔒 Área de membros interna</option>
                                    <option value="2" {{ old('entrega_produto', $product->entrega_produto ?? '') == '2' ? 'selected' : '' }}>🌐 Área de membros externa</option>
                                </select>
                            </div>

                            <!-- Categoria -->
                            <div>
                                <label for="categoria_produto" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="folder" class="w-4 h-4 inline mr-2"></i>
                                    Categoria *
                                </label>
                                <select id="categoria_produto" name="categoria_produto" required
                                        class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400 @error('categoria_produto') border-red-500 focus:ring-red-500 @enderror">
                                    <option value="">Selecione uma categoria</option>
                                    @foreach(\App\Enums\CategoriaProduto::all() as $id => $nome)
                                        <option value="{{ $id }}" {{ old('categoria_produto', $product->categoria_produto ?? '') == $id ? 'selected' : '' }}>
                                            {{ $nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria_produto')
                                    <p class="text-red-500 text-sm mt-2 flex items-center animate-fade-in">
                                        <i data-lucide="alert-triangle" class="w-4 h-4 mr-1"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- URL de Venda -->
                            <div>
                                <label for="url_venda" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="link" class="w-4 h-4 inline mr-2"></i>
                                    URL da Página de Vendas
                                </label>
                                <input type="url" id="url_venda" name="url_venda" 
                                       value="{{ old('url_venda', $product->url_venda ?? '') }}" 
                                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400"
                                       placeholder="https://exemplo.com/minha-pagina">
                            </div>

                            <!-- Nome SAC -->
                            <div>
                                <label for="nome_sac" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="user" class="w-4 h-4 inline mr-2"></i>
                                    Nome do SAC
                                </label>
                                <input type="text" id="nome_sac" name="nome_sac" 
                                       value="{{ old('nome_sac', $product->nome_sac ?? '') }}" 
                                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400"
                                       placeholder="Nome do responsável pelo atendimento">
                            </div>

                            <!-- Email SAC -->
                            <div>
                                <label for="email_sac" class="block text-sm font-semibold text-purple-600 mb-3">
                                    <i data-lucide="mail" class="w-4 h-4 inline mr-2"></i>
                                    Email do SAC
                                </label>
                                <input type="email" id="email_sac" name="email_sac" 
                                       value="{{ old('email_sac', $product->email_sac ?? '') }}" 
                                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-gray-900 dark:text-white transition-all duration-300 hover:border-purple-400"
                                       placeholder="contato@exemplo.com">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 3: Imagem do Produto -->
            <!-- Mantendo hidden por padrão -->
            <div class="form-step hidden" data-step="3">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden shadow-lg">
                    <div class="bg-gray-50 dark:bg-gray-800 px-4 md:px-8 py-4 md:py-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 md:w-10 md:h-10 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center">
                                <i data-lucide="image" class="w-4 h-4 md:w-5 md:h-5 text-purple-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg md:text-xl font-bold text-purple-600">Imagem do Produto</h3>
                                <p class="text-sm md:text-base text-gray-600 dark:text-gray-400">Adicione uma imagem atrativa para seu produto</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 md:p-8">
                        <div class="space-y-6">
                            <!-- Upload area melhorada com preview instantâneo -->
                            <div class="relative">
                                <input type="file" name="image" id="image" accept="image/*" class="hidden">
                                <div id="upload-area" class="border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-purple-400 dark:hover:border-purple-500 rounded-2xl p-6 md:p-12 text-center transition-all duration-300 cursor-pointer group hover:bg-purple-50 dark:hover:bg-purple-900/10">
                                    <div id="upload-content">
                                        <i data-lucide="upload-cloud" class="w-12 h-12 md:w-16 md:h-16 text-gray-400 group-hover:text-purple-500 mx-auto mb-4 transition-colors duration-300"></i>
                                        <h4 class="text-base md:text-lg font-semibold text-gray-900 dark:text-white mb-2">Clique para fazer upload</h4>
                                        <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 mb-4">ou arraste e solte uma imagem aqui</p>
                                        <p class="text-xs md:text-sm text-gray-500 dark:text-gray-400">PNG, JPG, WEBP até 5MB</p>
                                    </div>
                                    <!-- Preview melhorado com animações -->
                                    <div id="upload-preview" class="hidden">
                                        <div class="relative inline-block">
                                            <img id="preview-image" class="max-w-full max-h-80 mx-auto rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                                            <div class="absolute inset-0 bg-black/0 hover:bg-black/10 rounded-xl transition-colors duration-300 flex items-center justify-center opacity-0 hover:opacity-100">
                                                <div class="bg-white dark:bg-gray-800 rounded-lg px-4 py-2 shadow-lg">
                                                    <p class="text-sm text-gray-700 dark:text-gray-300">Clique para alterar</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-6 flex items-center justify-center space-x-4">
                                            <button type="button" id="change-image" class="flex items-center space-x-2 text-purple-600 hover:text-purple-700 font-medium transition-colors">
                                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                                <span>Alterar imagem</span>
                                            </button>
                                            <button type="button" id="remove-image" class="flex items-center space-x-2 text-red-500 hover:text-red-600 font-medium transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                <span>Remover</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(isset($product) && $product->image)
                                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                                    <h5 class="font-semibold text-gray-900 dark:text-white mb-3">Imagem Atual</h5>
                                    <img src="{{ Storage::url($product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="h-32 w-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation melhorada com botões responsivos -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-4 md:p-8 shadow-lg">
                <div class="flex flex-col sm:flex-row gap-4 justify-between items-center">
                    <div class="flex space-x-4">
                        <button type="button" id="prev-step" class="hidden flex items-center space-x-2 px-4 md:px-6 py-2 md:py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium transition-all duration-300 hover:scale-105 text-sm md:text-base">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            <span>Anterior</span>
                        </button>
                    </div>
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('associacao.products.index') }}" 
                           class="flex items-center space-x-2 px-4 md:px-6 py-2 md:py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-medium transition-all duration-300 hover:scale-105 text-sm md:text-base">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            <span>Cancelar</span>
                        </a>
                        
                        <button type="button" id="next-step" class="flex items-center space-x-2 px-6 md:px-8 py-2 md:py-3 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl text-sm md:text-base">
                            <span id="next-text">Próximo</span>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </button>
                        
                        <button type="submit" id="submit-btn" class="hidden flex items-center space-x-2 px-6 md:px-8 py-2 md:py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-lg hover:shadow-xl text-sm md:text-base">
                            <i data-lucide="{{ isset($product) ? 'save' : 'plus' }}" class="w-4 h-4"></i>
                            <span>{{ isset($product) ? 'Atualizar Produto' : 'Criar Produto' }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Lucide icons
    lucide.createIcons();
    
    // Form steps management
    let currentStep = 1;
    const totalSteps = 3;
    
    const nextBtn = document.getElementById('next-step');
    const prevBtn = document.getElementById('prev-step');
    const submitBtn = document.getElementById('submit-btn');
    const nextText = document.getElementById('next-text');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');
    
    // Character counters
    const nameInput = document.getElementById('name');
    const nameCounter = document.getElementById('name-counter');
    const descriptionInput = document.getElementById('description');
    const descriptionCounter = document.getElementById('description-counter');
    
    // Price formatting
    const priceInput = document.getElementById('price');
    
    // Image upload
    const imageInput = document.getElementById('image');
    const uploadArea = document.getElementById('upload-area');
    const uploadContent = document.getElementById('upload-content');
    const uploadPreview = document.getElementById('upload-preview');
    const previewImage = document.getElementById('preview-image');
    const changeImageBtn = document.getElementById('change-image');
    const removeImageBtn = document.getElementById('remove-image');
    
    function updateStepIndicators() {
        document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
            const stepNumber = index + 1;
            const circle = indicator.querySelector('div');
            const text = indicator.querySelector('span');
            
            if (stepNumber < currentStep) {
                // Completed step
                circle.className = 'w-6 h-6 md:w-8 md:h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-xs md:text-sm font-semibold';
                circle.innerHTML = '<i data-lucide="check" class="w-3 h-3 md:w-4 md:h-4"></i>';
                text.className = 'text-xs md:text-sm font-medium text-green-600';
            } else if (stepNumber === currentStep) {
                // Current step
                circle.className = 'w-6 h-6 md:w-8 md:h-8 rounded-full bg-purple-600 text-white flex items-center justify-center text-xs md:text-sm font-semibold';
                circle.textContent = stepNumber;
                text.className = 'text-xs md:text-sm font-medium text-purple-600';
            } else {
                // Future step
                circle.className = 'w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-300 dark:bg-gray-600 text-gray-600 dark:text-gray-400 flex items-center justify-center text-xs md:text-sm font-semibold';
                circle.textContent = stepNumber;
                text.className = 'text-xs md:text-sm font-medium text-gray-500 dark:text-gray-400';
            }
        });
        
        // Reinitialize icons
        lucide.createIcons();
    }
    
    // Update progress
    function updateProgress() {
        const progress = (currentStep / totalSteps) * 100;
        progressBar.style.width = progress + '%';
        progressText.textContent = Math.round(progress) + '% Completo';
        updateStepIndicators();
    }
    
    function showStep(step) {
        // Esconder todas as etapas
        document.querySelectorAll('.form-step').forEach(s => {
            s.style.display = 'none';
            s.classList.remove('active');
        });
        
        // Mostrar etapa atual
        const targetStep = document.querySelector(`[data-step="${step}"]`);
        if (targetStep) {
            targetStep.style.display = 'block';
            targetStep.classList.add('active');
        }
        
        // Update navigation
        prevBtn.classList.toggle('hidden', step === 1);
        
        if (step === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
            nextText.textContent = step === totalSteps - 1 ? 'Finalizar' : 'Próximo';
        }
        
        updateProgress();
    }
    
    // Navigation
    nextBtn.addEventListener('click', () => {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    });
    
    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });
    
    // Character counters
    nameInput.addEventListener('input', function() {
        nameCounter.textContent = this.value.length;
        
        // Validation feedback
        const successIcon = this.parentElement.querySelector('.validation-success');
        const errorIcon = this.parentElement.querySelector('.validation-error');
        
        if (this.value.length >= 3) {
            successIcon.classList.remove('hidden');
            errorIcon.classList.add('hidden');
        } else {
            successIcon.classList.add('hidden');
            errorIcon.classList.remove('hidden');
        }
    });
    
    descriptionInput.addEventListener('input', function() {
        descriptionCounter.textContent = this.value.length;
    });
    
    // Price formatting
    priceInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        value = (value / 100).toLocaleString('pt-BR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        this.value = value;
    });
    
    uploadArea.addEventListener('click', () => imageInput.click());
    
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('border-purple-400', 'bg-purple-50', 'dark:bg-purple-900/10');
    });
    
    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('border-purple-400', 'bg-purple-50', 'dark:bg-purple-900/10');
    });
    
    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('border-purple-400', 'bg-purple-50', 'dark:bg-purple-900/10');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            handleImageUpload(files[0]);
        }
    });
    
    imageInput.addEventListener('change', function() {
        if (this.files.length > 0) {
            handleImageUpload(this.files[0]);
        }
    });
    
    if (changeImageBtn) {
        changeImageBtn.addEventListener('click', () => imageInput.click());
    }
    
    if (removeImageBtn) {
        removeImageBtn.addEventListener('click', () => {
            imageInput.value = '';
            uploadContent.classList.remove('hidden');
            uploadPreview.classList.add('hidden');
        });
    }
    
    function handleImageUpload(file) {
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                uploadContent.classList.add('hidden');
                uploadPreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
    
    // Initialize
    updateProgress();
    
    // Initialize counters
    if (nameInput && nameCounter) {
        nameCounter.textContent = nameInput.value.length;
    }
    if (descriptionInput && descriptionCounter) {
        descriptionCounter.textContent = descriptionInput.value.length;
    }
});
</script>

<style>
/* Removendo CSS que estava escondendo as etapas por padrão */
.form-step {
    transition: opacity 0.3s ease-in-out;
}

.animate-fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Scrollbar customizada com cores roxas */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgb(243 244 246);
}

.dark ::-webkit-scrollbar-track {
    background: rgb(31 41 55);
}

::-webkit-scrollbar-thumb {
    background: rgb(147 51 234);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgb(126 34 206);
}
</style>
@endsection
