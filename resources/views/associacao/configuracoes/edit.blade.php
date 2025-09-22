@extends('layouts.app')

@section('title', 'Configurações - Izus Payment')
@section('page-title', 'Configurações da Conta')

@section('content')
<div class="space-y-8">
    {{-- CABEÇALHO PRINCIPAL --}}
    <div class="relative rounded-2xl p-8 overflow-hidden bg-slate-900 border border-blue-500/20 shadow-2xl">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-black to-black opacity-80"></div>
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-full opacity-20 blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-4 mb-2">
                    <div class="w-16 h-16 bg-black/30 backdrop-blur-sm border border-white/10 rounded-xl flex items-center justify-center shadow-lg">
                        <i data-lucide="user-cog" class="w-8 h-8 text-blue-300"></i>
                    </div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-300 to-cyan-300 bg-clip-text text-transparent">
                        Configurações
                    </h1>
                </div>
                <p class="text-blue-200/80 ml-20 sm:ml-0">Gerencie seus dados, documentos e integrações.</p>
            </div>
            <div class="flex items-center gap-3 self-start sm:self-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center space-x-2 bg-slate-700/50 hover:bg-slate-700 text-gray-300 hover:text-white px-5 py-2.5 rounded-xl font-semibold border border-white/10 transition-all">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Voltar</span>
                </a>
                 <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center space-x-2 px-5 py-2.5 bg-red-600/80 text-white rounded-xl hover:bg-red-600 transition-colors font-semibold shadow-md border border-red-500/50">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Sair</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- MENSAGENS DE SUCESSO E ERRO --}}
    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-300 p-4 rounded-xl flex items-center space-x-3">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-500/10 border border-red-500/30 text-red-300 p-4 rounded-xl">
            <div class="flex items-start space-x-3">
                <i data-lucide="alert-circle" class="w-5 h-5 mt-0.5 flex-shrink-0"></i>
                <div>
                    <h4 class="font-bold mb-1">Ops! Corrija os seguintes erros:</h4>
                    <ul class="list-disc list-inside text-sm">
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

        <!-- SISTEMA DE ABAS -->
        <div class="border-b border-white/10">
            <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                @php
                    $tabs = [
                        ['id' => 'account', 'label' => 'Conta', 'icon' => 'user'],
                        ['id' => 'business', 'label' => 'Empresa e Documentos', 'icon' => 'building'],
                        ['id' => 'api', 'label' => 'API', 'icon' => 'code-2'],
                        ['id' => 'integrations', 'label' => 'Integrações', 'icon' => 'plug-zap'],
                        ['id' => 'security', 'label' => 'Segurança (2FA)', 'icon' => 'shield'],
                    ];
                @endphp

                @foreach ($tabs as $index => $tab)
                    <button type="button" class="tab-button group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200
                        {{ $index === 0 ? 'border-blue-500 text-blue-400' : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-500' }}"
                        data-tab="{{ $tab['id'] }}">
                        <i data-lucide="{{ $tab['icon'] }}" class="w-5 h-5 mr-2 {{ $index === 0 ? 'text-blue-500' : 'text-gray-500 group-hover:text-gray-400' }} transition-colors duration-200"></i>
                        {{ $tab['label'] }}
                    </button>
                @endforeach
            </nav>
        </div>

        <!-- CONTEÚDO DAS ABAS -->
        <div class="mt-6">
            <!-- Aba: Conta -->
            <div class="tab-content" id="account">
                <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <h3 class="text-xl font-bold text-white flex items-center"><i data-lucide="user" class="w-6 h-6 mr-3 text-blue-400"></i>Dados da Conta</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-300 mb-1">Nome Completo *</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-300 mb-1">Email *</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            </div>
                        </div>
                        <div class="border-t border-white/10 pt-6 space-y-4">
                            <h4 class="text-lg font-semibold text-white">Alterar Senha</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="current_password" class="block text-sm font-semibold text-gray-300 mb-1">Senha Atual</label>
                                    <input type="password" id="current_password" name="current_password" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                </div>
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-gray-300 mb-1">Nova Senha</label>
                                    <input type="password" id="password" name="password" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                </div>
                                <div class="md:col-span-2">
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-300 mb-1">Confirmar Nova Senha</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aba: Empresa e Documentos -->
            <div class="tab-content hidden" id="business">
                <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <h3 class="text-xl font-bold text-white flex items-center"><i data-lucide="building" class="w-6 h-6 mr-3 text-blue-400"></i>Empresa e Documentos</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="association_name" class="block text-sm font-semibold text-gray-300 mb-1">Nome da Empresa/Associação *</label>
                                <input type="text" id="association_name" name="association_name" value="{{ old('association_name', $association->nome ?? '') }}" required class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            </div>
                            <div>
                                <label for="tipo" class="block text-sm font-semibold text-gray-300 mb-1">Tipo *</label>
                                <select id="tipo" name="tipo" required class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    <option value="pf" @selected(old('tipo', $association->tipo ?? '') == 'pf')>Pessoa Física</option>
                                    <option value="cnpj" @selected(old('tipo', $association->tipo ?? '') == 'cnpj')>Pessoa Jurídica</option>
                                </select>
                            </div>
                            <div>
                                <label for="documento" class="block text-sm font-semibold text-gray-300 mb-1">Documento (CPF/CNPJ) *</label>
                                <input type="text" id="documento" name="documento" value="{{ old('documento', $association->documento ?? '') }}" required class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            </div>
                        </div>
                        <div class="border-t border-white/10 pt-6 space-y-4">
                            <h4 class="text-lg font-semibold text-white">Envio de Documentos para Verificação</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @php
                                    $documents = [
                                        ['name' => 'doc_identity', 'label' => 'Documento de Identidade (Frente e Verso)', 'icon' => 'user-square'],
                                        ['name' => 'doc_selfie', 'label' => 'Selfie com o Documento', 'icon' => 'camera'],
                                        ['name' => 'doc_address', 'label' => 'Comprovante de Residência', 'icon' => 'home'],
                                        ['name' => 'doc_cnpj', 'label' => 'Comprovante de CNPJ (se aplicável)', 'icon' => 'file-text'],
                                    ];
                                @endphp
                                @foreach ($documents as $doc)
                                <div>
                                    <label for="{{ $doc['name'] }}" class="block text-sm font-semibold text-gray-300 mb-1">{{ $doc['label'] }}</label>
                                    <label class="w-full flex items-center text-sm px-4 py-2.5 border-2 border-dashed border-gray-600 hover:border-blue-500 rounded-lg bg-slate-900/50 text-gray-400 hover:text-white cursor-pointer transition-all">
                                        <i data-lucide="{{ $doc['icon'] }}" class="w-5 h-5 inline-block mr-3"></i>
                                        <span class="file-name-span truncate">Clique para enviar o arquivo</span>
                                    </label>
                                    <input type="file" id="{{ $doc['name'] }}" name="{{ $doc['name'] }}" class="hidden file-input">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aba: API -->
            <div class="tab-content hidden" id="api">
                <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <h3 class="text-xl font-bold text-white flex items-center"><i data-lucide="code-2" class="w-6 h-6 mr-3 text-blue-400"></i>Chave de API</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <p class="text-gray-300">Use esta chave para integrar seus sistemas com a plataforma Izus Payment. Mantenha sua chave de API segura e não a compartilhe publicamente.</p>
                        <div class="relative">
                            <input type="text" id="api-key" readonly value="{{ $apiKey ?? 'Nenhuma chave de API gerada' }}" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all pr-12">
                            <button type="button" onclick="copyToClipboard('api-key')" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-white rounded-md hover:bg-slate-700 transition-colors" title="Copiar Chave">
                                <i data-lucide="copy" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aba: Integrações -->
            <div class="tab-content hidden" id="integrations">
                <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <h3 class="text-xl font-bold text-white flex items-center"><i data-lucide="plug-zap" class="w-6 h-6 mr-3 text-blue-400"></i>Integrações e Webhooks</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="postback_url" class="block text-sm font-semibold text-gray-300 mb-1">URL de Postback/Webhook</label>
                            <input type="url" id="postback_url" name="postback_url" value="{{ old('postback_url', $association->postback_url ?? '') }}" placeholder="https://seu-sistema.com/webhook" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                            <p class="text-xs text-gray-400 mt-1">Informe a URL para receber notificações de eventos em tempo real.</p>
                        </div>
                        <div>
                            <label for="webhook_secret" class="block text-sm font-semibold text-gray-300 mb-1">Webhook Secret</label>
                            <div class="relative">
                                <input type="text" id="webhook_secret" readonly value="{{ $association->webhook_secret ?? 'Será gerado ao salvar' }}" class="w-full px-4 py-2.5 border border-gray-600 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all pr-12">
                                <button type="button" onclick="copyToClipboard('webhook_secret' )" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-white rounded-md hover:bg-slate-700 transition-colors" title="Copiar Segredo">
                                    <i data-lucide="copy" class="w-5 h-5"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Use este segredo para verificar a autenticidade dos webhooks recebidos.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Aba: Segurança (2FA) -->
            <div class="tab-content hidden" id="security">
                <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden">
                    <div class="p-6 border-b border-white/10">
                        <h3 class="text-xl font-bold text-white flex items-center"><i data-lucide="shield" class="w-6 h-6 mr-3 text-blue-400"></i>Segurança (2FA)</h3>
                    </div>
                    <div class="p-12 text-center text-gray-500">
                        <i data-lucide="wrench" class="w-12 h-12 mx-auto mb-4"></i>
                        <h4 class="text-lg font-semibold text-white mb-2">Em Desenvolvimento</h4>
                        <p>A funcionalidade de autenticação de dois fatores (2FA) está sendo preparada e estará disponível em breve.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTÕES DE AÇÃO -->
        <div class="bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl p-6 flex justify-end gap-4">
            <a href="{{ route('dashboard') }}" class="px-8 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition-colors font-semibold">Cancelar</a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-cyan-600 text-white rounded-xl hover:from-blue-600 hover:to-cyan-700 transition-all font-semibold shadow-lg hover:shadow-blue-500/30">
                <i data-lucide="save" class="w-5 h-5 inline mr-2"></i>Salvar Configurações
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetTabId = button.dataset.tab;

                // Atualiza a aparência dos BOTÕES
                tabButtons.forEach(btn => {
                    const icon = btn.querySelector('i[data-lucide]');
                    if (btn.dataset.tab === targetTabId) {
                        // ATIVA o botão clicado
                        btn.classList.remove('border-transparent', 'text-gray-400', 'hover:text-gray-200', 'hover:border-gray-500');
                        btn.classList.add('border-blue-500', 'text-blue-400');
                        if (icon) {
                            icon.classList.remove('text-gray-500', 'group-hover:text-gray-400');
                            icon.classList.add('text-blue-500');
                        }
                    } else {
                        // DESATIVA os outros botões
                        btn.classList.remove('border-blue-500', 'text-blue-400');
                        btn.classList.add('border-transparent', 'text-gray-400', 'hover:text-gray-200', 'hover:border-gray-500');
                        if (icon) {
                            icon.classList.remove('text-blue-500');
                            icon.classList.add('text-gray-500', 'group-hover:text-gray-400');
                        }
                    }
                });

                // Esconde e mostra o CONTEÚDO correspondente
                tabContents.forEach(content => {
                    if (content.id === targetTabId) {
                        content.classList.remove('hidden');
                    } else {
                        content.classList.add('hidden');
                    }
                });
            });
        });

        // Funcionalidade para nome do arquivo no upload
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', function() {
                const fileNameSpan = this.previousElementSibling.querySelector('.file-name-span');
                if (this.files && this.files.length > 0) {
                    fileNameSpan.textContent = this.files[0].name;
                } else {
                    fileNameSpan.textContent = 'Clique para enviar o arquivo';
                }
            });
        });
    });

    function copyToClipboard(elementId) {
        const input = document.getElementById(elementId);
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand('copy');
        alert('Copiado para a área de transferência!');
    }
</script>
@endpush

{{-- A seção @push('styles') foi removida --}}
