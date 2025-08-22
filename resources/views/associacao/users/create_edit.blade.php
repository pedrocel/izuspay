@extends('layouts.app')

@section('title', isset($user) ? 'Editar Usuário - AssociaMe' : 'Novo Usuário - AssociaMe')
@section('page-title', isset($user) ? 'Editar Usuário' : 'Novo Usuário')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="{{ isset($user) ? 'user-cog' : 'user-plus' }}" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ isset($user) ? 'Editar Usuário' : 'Novo Usuário' }}
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ isset($user) ? 'Atualize as informações do usuário ' . $user->name : 'Preencha os dados para criar um novo usuário' }}
                    </p>
                </div>
            </div>
            <a href="{{ route('associacao.users.index') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    <!-- Main Form -->
    <form action="{{ isset($user) ? route('associacao.users.update', $user) : route('associacao.users.store') }}" 
          method="POST" class="space-y-6">
        @csrf

        <!-- Personal Information Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-2">
                    <i data-lucide="user" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informações Pessoais</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="lg:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="user" class="w-4 h-4 inline mr-1"></i>
                            Nome Completo *
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $user->name ?? '') }}" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('name') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Digite o nome completo">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="mail" class="w-4 h-4 inline mr-1"></i>
                            Email *
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email ?? '') }}" 
                               required
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('email') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="exemplo@email.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="telefone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="phone" class="w-4 h-4 inline mr-1"></i>
                            Telefone
                        </label>
                        <input type="tel" 
                               id="telefone" 
                               name="telefone" 
                               value="{{ old('telefone', $user->telefone ?? '') }}"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('telefone') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="(00) 00000-0000">
                        @error('telefone')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-2">
                    <i data-lucide="settings" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Configurações do Sistema</h3>
                </div>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="shield" class="w-4 h-4 inline mr-1"></i>
                            Perfil *
                        </label>
                        <select id="role" 
                                name="role" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('role') border-red-500 focus:ring-red-500 @enderror">
                            <option value="">Selecione o perfil</option>
                            @foreach($perfis as $perfil)
                                <option value="{{ $perfil->id }}" 
                                        {{ old('role', $user->perfis[0]->id ?? '') == $perfil->id ? 'selected' : '' }}>
                                    {{ $perfil->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            <i data-lucide="activity" class="w-4 h-4 inline mr-1"></i>
                            Status *
                        </label>
                        <select id="status" 
                                name="status" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('status') border-red-500 focus:ring-red-500 @enderror">
                            <option value="ativo" {{ old('status', $user->status ?? '') == 'ativo' ? 'selected' : '' }}>
                                ✅ Ativo
                            </option>
                            <option value="inativo" {{ old('status', $user->status ?? '') == 'inativo' ? 'selected' : '' }}>
                                ❌ Inativo
                            </option>
                            <option value="pendente" {{ old('status', $user->status ?? '') == 'pendente' ? 'selected' : '' }}>
                                ⏳ Pendente
                            </option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Security Information Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex items-center space-x-2">
                    <i data-lucide="lock" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Segurança</h3>
                </div>
            </div>
            <div class="p-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        <i data-lucide="key" class="w-4 h-4 inline mr-1"></i>
                        Senha {{ isset($user) ? '' : '*' }}
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password"
                               class="w-full px-4 py-3 pr-12 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all @error('password') border-red-500 focus:ring-red-500 @enderror"
                               placeholder="Digite a senha">
                        <button type="button" 
                                onclick="togglePassword()"
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <i data-lucide="eye" id="eye-icon" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <div class="mt-2 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <div class="flex items-start space-x-2">
                            <i data-lucide="info" class="w-4 h-4 text-blue-600 dark:text-blue-400 mt-0.5"></i>
                            <div class="text-sm text-blue-800 dark:text-blue-200">
                                @if(isset($user))
                                    <p class="font-medium">Opcional para edição</p>
                                    <p>Deixe em branco para manter a senha atual.</p>
                                @else
                                    <p class="font-medium">Obrigatório para novos usuários</p>
                                    <p>Recomendamos uma senha com pelo menos 8 caracteres.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <i data-lucide="alert-circle" class="w-4 h-4 mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('associacao.users.index') }}" 
                   class="inline-flex items-center justify-center space-x-2 px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span>Cancelar</span>
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center space-x-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i data-lucide="{{ isset($user) ? 'save' : 'user-plus' }}" class="w-4 h-4"></i>
                    <span>{{ isset($user) ? 'Atualizar Usuário' : 'Criar Usuário' }}</span>
                </button>
            </div>
        </div>
    </form>

    @if(isset($user))
    <!-- Additional Information Card (only for editing) -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
            <div class="flex items-center space-x-2">
                <i data-lucide="info" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Informações Adicionais</h3>
            </div>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center">
                        <i data-lucide="calendar" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Criado em</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                        <i data-lucide="edit" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Atualizado em</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/20 rounded-lg flex items-center justify-center">
                        <i data-lucide="clock" class="w-5 h-5 text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Último acesso</p>
                        <p class="font-medium text-gray-900 dark:text-white">
                            {{ $user->ultimo_acesso ? $user->ultimo_acesso->diffForHumans() : 'Nunca' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.setAttribute('data-lucide', 'eye-off');
        } else {
            passwordInput.type = 'password';
            eyeIcon.setAttribute('data-lucide', 'eye');
        }
        
        lucide.createIcons();
    }

    // Phone mask
    document.getElementById('telefone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{2})(\d)/, '($1) $2');
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
        e.target.value = value;
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const requiredFields = document.querySelectorAll('input[required], select[required]');
        let hasError = false;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                hasError = true;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (hasError) {
            e.preventDefault();
            showNotification('Por favor, preencha todos os campos obrigatórios.', 'error');
        }
    });

    // Initialize Lucide icons
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection