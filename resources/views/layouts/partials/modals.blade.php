<!-- User Profile Modal -->
<div id="user-profile-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl max-w-md w-full p-6 transform transition-all">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Perfil do Usuário</h3>
                <button id="close-user-profile-modal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <div class="text-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl font-semibold text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </span>
                </div>
                <h4 class="text-xl font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h4>
                <p class="text-gray-500 dark:text-gray-400">
                    @if(auth()->user()->tipo == 'adm')
                        Administrador
                    @elseif(auth()->user()->tipo == 'cliente')
                        Cliente
                    @else
                        Membro
                    @endif
                </p>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Informações Pessoais</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Alterar Senha</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Última alteração há 30 dias</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <i data-lucide="bell" class="w-5 h-5 text-gray-400"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Notificações</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Gerenciar preferências</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer">
                    <i data-lucide="shield" class="w-5 h-5 text-gray-400"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Privacidade</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Configurações de segurança</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-2 p-3 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span class="font-medium">Sair da Conta</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
