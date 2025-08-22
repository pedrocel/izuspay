<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-lg leading-tight">
        Minha conta
        </h2>
    </x-slot>

    <div class="w-full max-w-6xl bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" x-data="{ activeTab: 'dadosPessoais' }">
        <div class="flex border-b border-gray-200 dark:border-gray-700">
            <button 
                @click="activeTab = 'dadosPessoais'" 
                :class="activeTab === 'dadosPessoais' ? 'border-purple-500 text-purple-500' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300'"
                class="tab-link px-4 py-2 border-b-2 font-medium text-sm">
                Dados Pessoais
            </button>
            <!-- <button 
                @click="activeTab = 'dadosBancarios'" 
                :class="activeTab === 'dadosBancarios' ? 'border-purple-500 text-purple-500' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300'"
                class="tab-link px-4 py-2 border-b-2 font-medium text-sm">
                Dados Bancários
            </button>
            <button 
                @click="activeTab = 'taxasPlataforma'" 
                :class="activeTab === 'taxasPlataforma' ? 'border-purple-500 text-purple-500' : 'border-transparent text-gray-500 hover:text-gray-700 dark:hover:text-gray-300'"
                class="tab-link px-4 py-2 border-b-2 font-medium text-sm">
                Taxas da Plataforma
            </button> -->
        </div>

        <!-- Conteúdo das Abas -->
        <div class="mt-6">
            <!-- Aba: Dados Pessoais -->
            <div x-show="activeTab === 'dadosPessoais'" class="space-y-4">
                <section>
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <x-input-label for="name" :value="__('Nome')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div>
                                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                        {{ __('Your email address is unverified.') }}

                                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400"
                                >{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </section>
            </div>

            <!-- Aba: Dados Bancários -->
            <div x-show="activeTab === 'dadosBancarios'" class="space-y-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Dados Bancários</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Banco</label>
                    <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:text-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Agência</label>
                    <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:text-gray-200">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Conta</label>
                    <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-700 dark:text-gray-200">
                </div>
            </div>

            <!-- Aba: Taxas da Plataforma -->
            <div x-show="activeTab === 'taxasPlataforma'" class="space-y-4">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Taxas da Plataforma</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Aqui você pode visualizar as taxas cobradas pela plataforma para suas transações.
                </p>
                <ul class="list-disc pl-5 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                    <li>Taxa de inscrição: 5%</li>
                    <li>Taxa de saque: R$ 1,50 por transação</li>
                    <li>Taxa de manutenção: R$ 10,00/mês</li>
                </ul>
            </div>

            <!-- Aba: Informações do Perfil -->
            
        </div>
    </div>
</x-app-layout>