@extends('layouts.app')

@section('title', 'Configurações do Perfil - Creator Platform')
@section('page-title', 'Configurações do Perfil')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-[#621d62] to-[#ff00ff] rounded-2xl p-8 mb-8 text-white shadow-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/30">
                            <i data-lucide="user-cog" class="w-10 h-10 text-white"></i>
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-gradient-to-r from-[#ff00ff] to-[#621d62] rounded-full flex items-center justify-center">
                            <i data-lucide="sparkles" class="w-4 h-4 text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold mb-2">Configurações do Perfil</h1>
                        <p class="text-purple-100 text-lg">Personalize sua presença como criador de conteúdo</p>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 px-6 py-3 rounded-xl border border-white/30 transition-all duration-300 hover:scale-105">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    <span class="font-medium">Voltar</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white p-4 rounded-xl mb-6 shadow-lg">
                <div class="flex items-center space-x-3">
                    <i data-lucide="check-circle" class="w-5 h-5"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white p-4 rounded-xl mb-6 shadow-lg">
                <div class="flex items-start space-x-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5"></i>
                    <div>
                        <h4 class="font-bold mb-2">Ops! Corrija os seguintes erros:</h4>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('associacao.configuracoes.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Navigation Tabs -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-2">
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="tab-button flex-1 min-w-0 px-6 py-4 rounded-xl font-semibold transition-all duration-300 bg-gradient-to-r from-[#621d62] to-[#ff00ff] text-white shadow-lg" data-tab="profile">
                        <i data-lucide="user" class="w-5 h-5 inline mr-2"></i>
                        <span class="hidden sm:inline">Perfil Público</span>
                        <span class="sm:hidden">Perfil</span>
                    </button>
                    <button type="button" class="tab-button flex-1 min-w-0 px-6 py-4 rounded-xl font-semibold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300" data-tab="account">
                        <i data-lucide="settings" class="w-5 h-5 inline mr-2"></i>
                        <span class="hidden sm:inline">Conta</span>
                        <span class="sm:hidden">Conta</span>
                    </button>
                    <button type="button" class="tab-button flex-1 min-w-0 px-6 py-4 rounded-xl font-semibold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300" data-tab="business">
                        <i data-lucide="building" class="w-5 h-5 inline mr-2"></i>
                        <span class="hidden sm:inline">Empresa</span>
                        <span class="sm:hidden">Empresa</span>
                    </button>
                    <button type="button" class="tab-button flex-1 min-w-0 px-6 py-4 rounded-xl font-semibold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-300" data-tab="social">
                        <i data-lucide="share-2" class="w-5 h-5 inline mr-2"></i>
                        <span class="hidden sm:inline">Redes Sociais</span>
                        <span class="sm:hidden">Social</span>
                    </button>
                </div>
            </div>

            <!-- Profile Tab -->
            <div class="tab-content" id="profile">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#621d62] to-[#ff00ff] px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <i data-lucide="user" class="w-6 h-6 text-white"></i>
                            <h3 class="text-xl font-bold text-white">Perfil Público</h3>
                        </div>
                        <p class="text-purple-100 mt-2">Como você aparece para seus seguidores</p>
                    </div>
                    <div class="p-8 space-y-8">
                        <!-- Profile Images Section -->
                        <div class="space-y-8">
                            <!-- Cover Image -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Imagem de Capa</label>
                                <div class="relative group">
                                    <div class="w-full h-48 rounded-2xl bg-gradient-to-br from-[#621d62] to-[#ff00ff] flex items-center justify-center overflow-hidden border-4 border-white shadow-xl">
                                        @if($creatorProfile && $creatorProfile->cover_image)
                                            <img id="cover-preview" src="{{ Storage::url($creatorProfile->cover_image) }}" alt="Cover" class="w-full h-full object-cover">
                                        @else
                                            <div class="text-center text-white">
                                                <i data-lucide="image" class="w-16 h-16 mx-auto mb-2"></i>
                                                <p class="text-lg font-medium">Adicionar Capa</p>
                                            </div>
                                        @endif
                                    </div>
                                    <input type="file" id="cover_image" name="cover_image" accept="image/*" class="hidden" onchange="previewImage(this, 'cover-preview')">
                                    <button type="button" onclick="document.getElementById('cover_image').click()" class="absolute inset-0 bg-black/50 rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i data-lucide="camera" class="w-12 h-12 text-white"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Profile Picture Section -->
                            <div class="flex flex-col lg:flex-row lg:items-start lg:space-x-8 space-y-6 lg:space-y-0">
                                <div class="flex-shrink-0">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Foto de Perfil</label>
                                    <div class="relative group">
                                        <div class="w-32 h-32 rounded-2xl bg-gradient-to-br from-[#621d62] to-[#ff00ff] flex items-center justify-center overflow-hidden border-4 border-white shadow-xl">
                                            @if($creatorProfile && $creatorProfile->profile_image)
                                                <img id="profile-preview" src="{{ Storage::url($creatorProfile->profile_image) }}" alt="Profile" class="w-full h-full object-cover">
                                            @else
                                                <i data-lucide="camera" class="w-12 h-12 text-white"></i>
                                            @endif
                                        </div>
                                        <!-- Changed from avatar to profile_image -->
                                        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="hidden" onchange="previewImage(this, 'profile-preview')">
                                        <button type="button" onclick="document.getElementById('profile_image').click()" class="absolute inset-0 bg-black/50 rounded-2xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <i data-lucide="camera" class="w-8 h-8 text-white"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="flex-1 space-y-6">
                                    <div>
                                        <label for="username" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nome de Usuário *</label>
                                        <div class="relative">
                                            <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">@</span>
                                            <input type="text" id="username" name="username" value="{{ old('username', $creatorProfile->username ?? '') }}" required
                                                   class="w-full pl-8 pr-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('username') border-red-500 @enderror">
                                        </div>
                                        @error('username') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="display_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nome de Exibição *</label>
                                        <input type="text" id="display_name" name="display_name" value="{{ old('display_name', $creatorProfile->display_name ?? '') }}" required
                                               class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('display_name') border-red-500 @enderror">
                                        @error('display_name') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label for="category" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Categoria *</label>
                                        <select id="category" name="category" required
                                                class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('category') border-red-500 @enderror">
                                            <option value="">Selecione uma categoria</option>
                                            <option value="gaming" {{ old('category', $creatorProfile->category ?? '') == 'gaming' ? 'selected' : '' }}>Gaming</option>
                                            <option value="lifestyle" {{ old('category', $creatorProfile->category ?? '') == 'lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                                            <option value="tech" {{ old('category', $creatorProfile->category ?? '') == 'tech' ? 'selected' : '' }}>Tecnologia</option>
                                            <option value="fitness" {{ old('category', $creatorProfile->category ?? '') == 'fitness' ? 'selected' : '' }}>Fitness</option>
                                            <option value="food" {{ old('category', $creatorProfile->category ?? '') == 'food' ? 'selected' : '' }}>Culinária</option>
                                            <option value="travel" {{ old('category', $creatorProfile->category ?? '') == 'travel' ? 'selected' : '' }}>Viagem</option>
                                            <option value="education" {{ old('category', $creatorProfile->category ?? '') == 'education' ? 'selected' : '' }}>Educação</option>
                                            <option value="entertainment" {{ old('category', $creatorProfile->category ?? '') == 'entertainment' ? 'selected' : '' }}>Entretenimento</option>
                                        </select>
                                        @error('category') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            <div>
                                <label for="bio" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Biografia</label>
                                <textarea id="bio" name="bio" rows="4" placeholder="Conte um pouco sobre você e seu conteúdo..."
                                          class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white resize-none transition-all duration-300 @error('bio') border-red-500 @enderror">{{ old('bio', $creatorProfile->bio ?? '') }}</textarea>
                                @error('bio') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account Tab -->
            <div class="tab-content hidden" id="account">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#621d62] to-[#ff00ff] px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <i data-lucide="settings" class="w-6 h-6 text-white"></i>
                            <h3 class="text-xl font-bold text-white">Configurações da Conta</h3>
                        </div>
                        <p class="text-purple-100 mt-2">Informações pessoais e de acesso</p>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nome Completo *</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required
                                       class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('name') border-red-500 @enderror">
                                @error('name') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Email *</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required
                                       class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('email') border-red-500 @enderror">
                                @error('email') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Alterar Senha</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="current_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Senha Atual</label>
                                    <input type="password" id="current_password" name="current_password"
                                           class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('current_password') border-red-500 @enderror">
                                    @error('current_password') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nova Senha</label>
                                    <input type="password" id="password" name="password"
                                           class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('password') border-red-500 @enderror">
                                    @error('password') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Confirmar Nova Senha</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Tab -->
            <div class="tab-content hidden" id="business">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#621d62] to-[#ff00ff] px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <i data-lucide="building" class="w-6 h-6 text-white"></i>
                            <h3 class="text-xl font-bold text-white">Informações da Empresa</h3>
                        </div>
                        <p class="text-purple-100 mt-2">Dados da sua associação/empresa</p>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="association_name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Nome da Associação *</label>
                                <input type="text" id="association_name" name="association_name" value="{{ old('association_name', $association->nome ?? '') }}" required
                                       class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('association_name') border-red-500 @enderror">
                                @error('association_name') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="tipo" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tipo *</label>
                                <select id="tipo" name="tipo" required
                                        class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('tipo') border-red-500 @enderror">
                                    <option value="pf" {{ old('tipo', $association->tipo ?? '') == 'pf' ? 'selected' : '' }}>Pessoa Física</option>
                                    <option value="cnpj" {{ old('tipo', $association->tipo ?? '') == 'cnpj' ? 'selected' : '' }}>Pessoa Jurídica</option>
                                </select>
                                @error('tipo') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="documento" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Documento (CPF/CNPJ) *</label>
                                <input type="text" id="documento" name="documento" value="{{ old('documento', $association->documento ?? '') }}" required
                                       class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('documento') border-red-500 @enderror">
                                @error('documento') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        
                        <div>
                            <label for="association_description" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Descrição da Empresa</label>
                            <textarea id="association_description" name="association_description" rows="3"
                                      class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white resize-none transition-all duration-300 @error('association_description') border-red-500 @enderror">{{ old('association_description', $association->descricao ?? '') }}</textarea>
                            @error('association_description') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="association_phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Telefone</label>
                                <input type="tel" id="association_phone" name="association_phone" value="{{ old('association_phone', $association->telefone ?? '') }}"
                                       class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('association_phone') border-red-500 @enderror">
                                @error('association_phone') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="association_website" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Website</label>
                                <input type="url" id="association_website" name="association_website" value="{{ old('association_website', $association->site ?? '') }}"
                                       class="w-full px-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('association_website') border-red-500 @enderror">
                                @error('association_website') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Tab -->
            <div class="tab-content hidden" id="social">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-[#621d62] to-[#ff00ff] px-8 py-6">
                        <div class="flex items-center space-x-3">
                            <i data-lucide="share-2" class="w-6 h-6 text-white"></i>
                            <h3 class="text-xl font-bold text-white">Redes Sociais</h3>
                        </div>
                        <p class="text-purple-100 mt-2">Conecte suas redes sociais</p>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="instagram_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Instagram</label>
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <i data-lucide="instagram" class="w-5 h-5 text-pink-500"></i>
                                    </div>
                                    <input type="url" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $creatorProfile->instagram_url ?? '') }}" placeholder="https://instagram.com/seuusuario"
                                           class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('instagram_url') border-red-500 @enderror">
                                </div>
                                @error('instagram_url') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="youtube_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">YouTube</label>
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <i data-lucide="youtube" class="w-5 h-5 text-red-500"></i>
                                    </div>
                                    <input type="url" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $creatorProfile->youtube_url ?? '') }}" placeholder="https://youtube.com/@seucanal"
                                           class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('youtube_url') border-red-500 @enderror">
                                </div>
                                @error('youtube_url') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="tiktok_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">TikTok</label>
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <i data-lucide="music" class="w-5 h-5 text-gray-900"></i>
                                    </div>
                                    <input type="url" id="tiktok_url" name="tiktok_url" value="{{ old('tiktok_url', $creatorProfile->tiktok_url ?? '') }}" placeholder="https://tiktok.com/@seuusuario"
                                           class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('tiktok_url') border-red-500 @enderror">
                                </div>
                                @error('tiktok_url') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="twitter_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Twitter/X</label>
                                <div class="relative">
                                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                        <i data-lucide="twitter" class="w-5 h-5 text-blue-500"></i>
                                    </div>
                                    <input type="url" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $creatorProfile->twitter_url ?? '') }}" placeholder="https://twitter.com/seuusuario"
                                           class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-[#621d62] focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white font-medium transition-all duration-300 @error('twitter_url') border-red-500 @enderror">
                                </div>
                                @error('twitter_url') <p class="text-red-500 text-sm mt-2">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 p-8">
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center justify-center space-x-2 px-8 py-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-semibold transition-all duration-300 hover:scale-105">
                        <i data-lucide="x" class="w-5 h-5"></i>
                        <span>Cancelar</span>
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center space-x-2 px-8 py-4 bg-gradient-to-r from-[#621d62] to-[#ff00ff] hover:from-[#4a1549] hover:to-[#e600e6] text-white rounded-xl font-semibold transition-all duration-300 hover:scale-105 shadow-xl hover:shadow-2xl">
                        <i data-lucide="save" class="w-5 h-5"></i>
                        <span>Salvar Configurações</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // Tab functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active classes from all buttons
                tabButtons.forEach(btn => {
                    btn.classList.remove('bg-gradient-to-r', 'from-[#621d62]', 'to-[#ff00ff]', 'text-white', 'shadow-lg');
                    btn.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
                });
                
                // Hide all tab contents
                tabContents.forEach(content => content.classList.add('hidden'));

                // Add active classes to clicked button
                button.classList.add('bg-gradient-to-r', 'from-[#621d62]', 'to-[#ff00ff]', 'text-white', 'shadow-lg');
                button.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');

                // Show corresponding tab content
                const tabId = button.dataset.tab;
                document.getElementById(tabId).classList.remove('hidden');
            });
        });
    });

    // Image preview function
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                if (preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
