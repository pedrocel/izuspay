<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo/Título -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white mb-2">Recuperar Senha</h1>
                <p class="text-purple-200">Não se preocupe, vamos te ajudar a redefinir!</p>
            </div>

            <!-- Container Principal -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden backdrop-blur-sm p-8">
                <div class="mb-6 text-sm text-gray-600">
                    {{ __("Esqueceu sua senha? Sem problemas. Basta nos informar seu endereço de e-mail e nós lhe enviaremos um link de redefinição de senha que permitirá que você escolha uma nova.") }}
                </div>

                <!-- Session Status -->
                {{-- <x-auth-session-status class="mb-4" :status="session('status')"> --}}

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6"> 
                    @csrf

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
                        <x-text-input 
                            id="email" 
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus 
                            placeholder="seu@email.com" 
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="w-full justify-center py-3 px-4 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-2 4v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7" />
                            </svg>
                            {{ __('Enviar Link de Redefinição de Senha') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <div class="mt-6 text-center">
                <a class="text-white text-sm hover:text-purple-200 font-medium transition-colors duration-200" href="{{ route('login') }}">
                    Lembrou da senha? Voltar para o Login
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
