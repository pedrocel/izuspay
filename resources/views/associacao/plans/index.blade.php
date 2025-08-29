@extends('layouts.app')

@section('title', 'Planos - Adoring Fans')
@section('page-title', 'Gerenciar Planos')

@section('content')
<div class="space-y-8">
    {{-- CABEÇALHO --}}
    <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 shadow-lg">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    {{-- Ícone com a cor rosa principal da identidade visual --}}
                    <div class="w-10 h-10 bg-pink-500 rounded-lg flex items-center justify-center shadow-md">
                        <i data-lucide="award" class="w-6 h-6 text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Planos</h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400">Crie e gerencie os pacotes de assinatura para seus membros.</p>
            </div>
            <a href="{{ route('associacao.plans.create') }}" 
               class="inline-flex items-center space-x-2 bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Novo Plano</span>
            </a>
        </div>
    </div>

    {{-- CARDS DE ESTATÍSTICAS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Planos Totais</p>
                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ $plans->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/20 rounded-lg flex items-center justify-center shadow-sm">
                    <i data-lucide="package" class="w-6 h-6 text-blue-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Ativos</p>
                    <p class="text-3xl font-bold text-green-500">{{ $plans->where('is_active', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center shadow-sm">
                    <i data-lucide="shield-check" class="w-6 h-6 text-green-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Inativos</p>
                    <p class="text-3xl font-bold text-red-500">{{ $plans->where('is_active', false)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 dark:bg-red-900/20 rounded-lg flex items-center justify-center shadow-sm">
                    <i data-lucide="shield-off" class="w-6 h-6 text-red-500"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- LISTA DE PLANOS EM FORMATO DE CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($plans as $plan)
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 flex flex-col transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            {{-- Cabeçalho do Card --}}
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 truncate pr-4">{{ $plan->name }}</h3>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                        {{ $plan->is_active ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}">
                        {{ $plan->is_active ? 'Ativo' : 'Inativo' }}
                    </span>
                </div>
            </div>

            {{-- Corpo do Card --}}
            <div class="p-6 flex-grow">
                <div class="text-center mb-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Preço</p>
                    <p class="text-4xl font-bold text-pink-500">R$ {{ number_format($plan->total_price, 2, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        @if($plan->recurrence === 'monthly')
                            /mês
                        @elseif($plan->recurrence === 'yearly')
                            /ano
                        @else
                            Pagamento Único
                        @endif
                    </p>
                </div>
                
                {{-- Lista de Benefícios (Exemplo) --}}
                <ul class="space-y-3 text-sm text-gray-600 dark:text-gray-300">
                    <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-green-500 mr-2"></i> Acesso a Conteúdo Exclusivo</li>
                    <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-green-500 mr-2"></i> Suporte Prioritário</li>
                    <li class="flex items-center"><i data-lucide="check" class="w-4 h-4 text-green-500 mr-2"></i> Selo de Membro no Perfil</li>
                </ul>
            </div>

            {{-- Rodapé com Ações --}}
            <div class="p-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-center space-x-2">
                    <button onclick="copyLink(this, '{{ $plan->hash_id }}')"
                            class="flex-1 inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 rounded-lg transition-colors">
                        <i data-lucide="copy" class="w-4 h-4 mr-2"></i>
                        <span class="copy-text">Copiar Link</span>
                    </button>
                    <a href="{{ route('associacao.plans.edit', $plan) }}" 
                       class="flex-1 inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 rounded-lg transition-colors">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                        Editar
                    </a>
                    <button onclick="confirmDelete('{{ $plan->id }}', '{{ $plan->name }}')"
                            class="flex-1 inline-flex justify-center items-center px-3 py-2 text-sm font-medium text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 rounded-lg transition-colors">
                        <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                        Excluir
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="md:col-span-2 xl:col-span-3 bg-white dark:bg-gray-800 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-700 p-12 text-center flex flex-col items-center justify-center">
            <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700/50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="package-plus" class="w-10 h-10 text-gray-400 dark:text-gray-500"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-2">Nenhum plano encontrado</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6 max-w-md">Parece que você ainda não criou nenhum plano. Clique no botão abaixo para começar a oferecer assinaturas aos seus membros.</p>
            <a href="{{ route('associacao.plans.create') }}" 
               class="inline-flex items-center space-x-2 bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i data-lucide="plus" class="w-5 h-5"></i>
                <span>Criar Primeiro Plano</span>
            </a>
        </div>
        @endforelse
    </div>

    {{-- PAGINAÇÃO --}}
    @if($plans->hasPages())
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4">
        {{ $plans->links() }}
    </div>
    @endif
</div>

{{-- MODAL DE EXCLUSÃO (sem alterações na estrutura, apenas no estilo) --}}
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-60 backdrop-blur-sm z-50 hidden flex items-center justify-center">
    <div class="bg-white dark:bg-gray-800 rounded-xl max-w-md w-full m-4 p-6 shadow-2xl transform transition-all"
         x-data="{ show: false }" x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        <div class="flex flex-col items-center text-center">
            <div class="w-16 h-16 flex items-center justify-center bg-red-100 dark:bg-red-900/30 rounded-full mb-5">
                <i data-lucide="alert-triangle" class="w-8 h-8 text-red-500"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Confirmar Exclusão</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Tem certeza que deseja excluir o plano "<strong id="deletePlanName" class="text-gray-800 dark:text-gray-200"></strong>"? Esta ação não pode ser desfeita.
            </p>
            <div class="flex justify-center space-x-4 w-full">
                <button @click="closeDeleteModal()" class="flex-1 px-4 py-2.5 text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 rounded-lg font-semibold transition-colors">
                    Cancelar
                </button>
                <form id="deleteForm" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold transition-colors">
                        Sim, Excluir
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Adicionando Alpine.js para transições no modal
    document.addEventListener('alpine:init', () => {
        Alpine.data('deleteModal', () => ({
            show: false,
            open() { this.show = true; },
            close() { this.show = false; }
        }))
    });

    function copyLink(button, hashId) {
        const link = `{{ url('/checkout') }}/${hashId}`;
        navigator.clipboard.writeText(link).then(() => {
            const textSpan = button.querySelector('.copy-text');
            if (textSpan) {
                textSpan.textContent = 'Copiado!';
                button.querySelector('i').setAttribute('data-lucide', 'check-circle');
                lucide.createIcons(); // Atualiza o ícone

                setTimeout(() => {
                    textSpan.textContent = 'Copiar Link';
                    button.querySelector('i').setAttribute('data-lucide', 'copy');
                    lucide.createIcons();
                }, 2000);
            }
            // Você pode usar sua função global de notificação se preferir
            // showNotification('Link de checkout copiado!', 'success');
        }).catch(err => {
            console.error('Falha ao copiar o link: ', err);
            // showNotification('Falha ao copiar o link.', 'error');
        });
    }
    
    const deleteModalEl = document.getElementById('deleteModal');
    
    function confirmDelete(planId, planName) {
        document.getElementById('deletePlanName').textContent = planName;
        document.getElementById('deleteForm').action = `{{ url('/associacao/plans') }}/${planId}`;
        deleteModalEl.classList.remove('hidden');
        // Dispara a transição do Alpine
        deleteModalEl.querySelector('[x-data]')._x_dataStack[0].show = true;
    }

    function closeDeleteModal() {
        const alpineData = deleteModalEl.querySelector('[x-data]')._x_dataStack[0];
        alpineData.show = false;
        // Esconde o modal após a animação de saída
        setTimeout(() => {
            deleteModalEl.classList.add('hidden');
        }, 300);
    }

    // Fechar modal com a tecla Esc
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !deleteModalEl.classList.contains('hidden')) {
            closeDeleteModal();
        }
    });
</script>
@endpush
