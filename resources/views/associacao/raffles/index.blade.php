@extends('layouts.app')

@section('title', 'Rifas')
@section('page-title', 'Rifas')

@section('content')
<div class="space-y-8">
    {{-- CABEÇALHO PRINCIPAL --}}
    <div class="relative rounded-2xl p-8 overflow-hidden bg-slate-900 border border-purple-500/20 shadow-2xl">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900/50 via-black to-black opacity-80"></div>
        <div class="absolute -top-10 -right-10 w-48 h-48 bg-gradient-to-br from-pink-500 to-purple-600 rounded-full opacity-20 blur-3xl"></div>
        
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-4 mb-2">
                    <div class="w-16 h-16 bg-black/30 backdrop-blur-sm border border-white/10 rounded-xl flex items-center justify-center shadow-lg">
                        <i data-lucide="ticket" class="w-8 h-8 text-purple-300"></i>
                    </div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent">
                        Gestão de Rifas
                    </h1>
                </div>
                <p class="text-purple-200/80 ml-20 sm:ml-0">Crie, gerencie e sorteie suas rifas online.</p>
            </div>
            <div class="flex items-center gap-3 self-start sm:self-center">
                <button onclick="openRaffleModal()" class="inline-flex items-center space-x-2 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span>Nova Rifa</span>
                </button>
            </div>
        </div>
    </div>

    {{-- GRID DE RIFAS --}}
    @if($raffles->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($raffles as $raffle)
                <div class="relative bg-slate-800/50 backdrop-blur-md border border-white/10 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                    <!-- Imagem da Rifa -->
                    <div class="relative overflow-hidden h-48">
                        @if($raffle->image)
                            <img src="{{ Storage::url($raffle->image) }}" alt="{{ $raffle->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-purple-900 to-pink-900 flex items-center justify-center">
                                <i data-lucide="ticket" class="w-12 h-12 text-purple-300/30"></i>
                            </div>
                        @endif
                        <!-- Badge de Status -->
                        <div class="absolute top-3 right-3">
                            @if($raffle->status === 'active')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/80 text-white backdrop-blur-sm border border-white/20">
                                    <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i> Ativa
                                </span>
                            @elseif($raffle->status === 'completed')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-500/80 text-white backdrop-blur-sm border border-white/20">
                                    <i data-lucide="trophy" class="w-3 h-3 mr-1"></i> Finalizada
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-500/80 text-white backdrop-blur-sm border border-white/20">
                                    <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i> Inativa
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Informações da Rifa -->
                    <div class="p-5 flex flex-col h-[calc(100%-12rem)]">
                        <div class="flex-grow">
                            <h3 class="text-lg font-bold text-white group-hover:text-pink-300 transition-colors duration-300 line-clamp-2 mb-2">
                                {{ $raffle->title }}
                            </h3>
                            @if($raffle->description)
                                <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $raffle->description }}</p>
                            @endif
                        </div>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-400">Total de Números:</span>
                                <span class="text-white font-semibold">{{ number_format($raffle->total_tickets, 0, ',', '.') }}</span>
                            </div>
                            
                            @if($raffle->created_tickets)
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-400">Disponíveis:</span>
                                    <span class="text-green-400 font-semibold">{{ number_format($raffle->availableTicketsCount(), 0, ',', '.') }}</span>
                                </div>
                                
                                <!-- Barra de Progresso -->
                                <div class="w-full bg-gray-700 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-2 rounded-full transition-all duration-300" 
                                         style="width: {{ $raffle->soldPercentage() }}%"></div>
                                </div>
                                <div class="text-xs text-gray-400 text-center">
                                    {{ number_format($raffle->soldPercentage(), 1) }}% vendido
                                </div>
                            @else
                                <div class="text-center py-2">
                                    <span class="text-yellow-400 text-xs">⚠️ Tickets não criados</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="border-t border-white/10 pt-4">
                            <div class="flex items-center justify-between mb-4">
                                <div class="text-2xl font-bold text-pink-300">
                                    R$ {{ number_format($raffle->price, 2, ',', '.') }}
                                </div>
                                @if($raffle->draw_date)
                                    <div class="text-xs text-gray-400">
                                        <i data-lucide="calendar" class="w-3 h-3 inline mr-1"></i>
                                        {{ $raffle->draw_date->format('d/m/Y') }}
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Ações -->
                            <div class="flex space-x-2">
                                @if(!$raffle->created_tickets)
                                    <form action="{{ route('associacao.raffles.create-tickets', $raffle) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-lg text-sm font-semibold transition-all duration-300 shadow-lg">
                                            <i data-lucide="hash" class="w-4 h-4 mr-2"></i>
                                            <span>Criar Números</span>
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('associacao.raffles.tickets', $raffle) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2.5 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white rounded-lg text-sm font-semibold transition-all duration-300 shadow-lg">
                                        <i data-lucide="list" class="w-4 h-4 mr-2"></i>
                                        <span>Ver Números</span>
                                    </a>
                                @endif
                                
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" class="px-3 py-2.5 bg-slate-700 hover:bg-slate-600 text-white rounded-lg text-sm font-medium transition-all duration-300">
                                        <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                    </button>
                                    
                                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 bottom-full mb-2 w-48 bg-slate-800 rounded-lg shadow-xl border border-white/10 z-10">
                                        <button onclick="editRaffle({{ $raffle->id }}, '{{ $raffle->title }}', '{{ addslashes($raffle->description) }}', {{ $raffle->price }}, '{{ $raffle->status }}', '{{ $raffle->draw_date ? $raffle->draw_date->format('Y-m-d') : '' }}', '{{ $raffle->image ? Storage::url($raffle->image) : '' }}')" 
                                                class="w-full flex items-center px-4 py-3 text-sm text-gray-300 hover:bg-purple-900/30 hover:text-white transition-colors duration-200 rounded-t-lg">
                                            <i data-lucide="edit" class="w-4 h-4 mr-3 text-purple-400"></i> Editar
                                        </button>
                                        
                                        @if($raffle->created_tickets && $raffle->status === 'active')
                                            <form action="{{ route('associacao.raffles.draw', $raffle) }}" method="POST" class="w-full">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Deseja sortear o ganhador agora?')" class="w-full flex items-center px-4 py-3 text-sm text-yellow-400 hover:bg-yellow-900/30 hover:text-yellow-300 transition-colors duration-200 border-t border-white/10">
                                                    <i data-lucide="trophy" class="w-4 h-4 mr-3"></i> Sortear Ganhador
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <button onclick="confirmDelete('{{ $raffle->id }}', '{{ $raffle->title }}')" 
                                                class="w-full flex items-center px-4 py-3 text-sm text-red-400 hover:bg-red-900/30 hover:text-red-300 transition-colors duration-200 border-t border-white/10 rounded-b-lg">
                                            <i data-lucide="trash-2" class="w-4 h-4 mr-3"></i> Excluir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($raffles->hasPages())
            <div class="mt-8">{{ $raffles->links() }}</div>
        @endif
    @else
        <!-- Estado Vazio -->
        <div class="bg-slate-900/50 backdrop-blur-md border border-purple-500/20 rounded-2xl p-12 text-center shadow-xl">
            <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <i data-lucide="ticket" class="w-10 h-10 text-white"></i>
            </div>
            <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-300 to-pink-400 bg-clip-text text-transparent mb-3">Nenhuma rifa encontrada</h3>
            <p class="text-gray-400 mb-8 max-w-md mx-auto">Comece a criar suas rifas agora mesmo. Clique no botão abaixo para cadastrar sua primeira rifa.</p>
            <button onclick="openRaffleModal()" class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-purple-500/20">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Criar Primeira Rifa</span>
            </button>
        </div>
    @endif
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 bg-black/70 z-50 hidden backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl max-w-md w-full p-8 transform transition-all shadow-2xl border border-purple-500/30">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i data-lucide="trash-2" class="w-6 h-6 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold bg-gradient-to-r from-red-400 to-pink-400 bg-clip-text text-transparent">Confirmar Exclusão</h3>
                </div>
                <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>
            
            <div class="mb-8">
                <p class="text-gray-300 mb-3">
                    Tem certeza que deseja excluir a rifa <strong id="raffle-name" class="text-white"></strong>?
                </p>
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4">
                    <p class="text-sm text-red-400 flex items-center">
                        <i data-lucide="alert-triangle" class="w-4 h-4 mr-2"></i>
                        Esta ação não pode ser desfeita e removerá permanentemente a rifa.
                    </p>
                </div>
            </div>

            <div class="flex space-x-4">
                <button onclick="closeDeleteModal()" 
                        class="flex-1 px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white rounded-xl font-medium transition-all duration-300">
                    Cancelar
                </button>
                <form id="delete-form" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full px-6 py-3 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                        Excluir Rifa
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Rifa (Criar/Editar) -->
<div id="raffle-modal" class="fixed inset-0 bg-black/70 z-50 hidden backdrop-blur-sm transition-opacity duration-300">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-slate-800 rounded-2xl max-w-2xl w-full max-h-[90vh] flex flex-col shadow-2xl border border-purple-500/20 transform transition-all duration-300">
            
            <!-- Cabeçalho do Modal -->
            <div class="sticky top-0 bg-gradient-to-r from-purple-600 to-pink-500 p-5 rounded-t-2xl flex items-center justify-between flex-shrink-0">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i data-lucide="ticket" class="w-5 h-5 text-white"></i>
                    </div>
                    <h3 id="modal-title" class="text-xl font-bold text-white">Nova Rifa</h3>
                </div>
                <button onclick="closeRaffleModal()" class="text-white/80 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Corpo do Modal com Scroll -->
            <form id="raffle-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-6 overflow-y-auto">
                @csrf
                <div id="method-field"></div>

                <!-- Seção: Informações Básicas -->
                <div class="p-5 bg-gray-50 dark:bg-slate-900/50 rounded-xl border border-gray-200 dark:border-white/10 space-y-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                        <i data-lucide="info" class="w-5 h-5 mr-2 text-purple-500"></i>
                        Informações Básicas
                    </h4>
                    
                    <div>
                        <label for="raffle-title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título da Rifa *</label>
                        <input type="text" name="title" id="raffle-title" required
                               class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all">
                    </div>

                    <div>
                        <label for="raffle-description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descrição</label>
                        <textarea name="description" id="raffle-description" rows="3"
                                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all resize-none"></textarea>
                    </div>
                </div>

                <!-- Seção: Configurações da Rifa -->
                <div class="p-5 bg-gray-50 dark:bg-slate-900/50 rounded-xl border border-gray-200 dark:border-white/10 space-y-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                        <i data-lucide="settings" class="w-5 h-5 mr-2 text-purple-500"></i>
                        Configurações
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="raffle-price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Preço por Número (R$) *</label>
                            <input type="number" name="price" id="raffle-price" step="0.01" min="0" required
                                   class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all">
                        </div>
                        
                        <div>
                            <label for="raffle-total-tickets" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Total de Números *</label>
                            <input type="number" name="total_tickets" id="raffle-total-tickets" min="1" required
                                   class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all">
                        </div>
                        
                        <div>
                            <label for="raffle-status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                            <select name="status" id="raffle-status"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all">
                                <option value="active">Ativa</option>
                                <option value="inactive">Inativa</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="raffle-draw-date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Data do Sorteio</label>
                        <input type="date" name="draw_date" id="raffle-draw-date"
                               class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all">
                    </div>
                </div>

                <!-- Seção: Imagem -->
                <div class="p-5 bg-gray-50 dark:bg-slate-900/50 rounded-xl border border-gray-200 dark:border-white/10 space-y-4">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-white flex items-center">
                        <i data-lucide="image" class="w-5 h-5 mr-2 text-purple-500"></i>
                        Imagem da Rifa
                    </h4>
                    
                    <div class="flex items-center space-x-4">
                        <div id="image-preview" class="w-20 h-20 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300 dark:border-gray-600 hidden flex-shrink-0">
                            <img id="preview-img" class="w-full h-full object-cover rounded-lg" alt="Preview">
                        </div>
                        <div class="flex-1">
                            <label for="raffle-image" class="w-full flex items-center text-sm px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-500 dark:text-gray-400 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-600 transition-all">
                                <i data-lucide="upload-cloud" class="w-4 h-4 inline-block mr-2"></i>
                                <span id="file-name" class="truncate">Clique para enviar uma imagem</span>
                            </label>
                            <input type="file" name="image" id="raffle-image" accept="image/*" class="hidden">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Formatos: JPG, PNG, GIF (máx. 2MB)</p>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Rodapé do Modal -->
            <div class="p-5 mt-auto border-t border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50 rounded-b-2xl flex-shrink-0">
                <div class="flex space-x-4">
                    <button type="button" onclick="closeRaffleModal()" 
                            class="flex-1 px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-semibold transition-all">
                        Cancelar
                    </button>
                    <button type="submit" form="raffle-form"
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-xl font-semibold transition-all shadow-lg hover:shadow-purple-500/30">
                        <span id="submit-text">Criar Rifa</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let isEditMode = false;
    let editRaffleId = null;

    function openRaffleModal() {
        isEditMode = false;
        editRaffleId = null;
        document.getElementById('modal-title').textContent = 'Nova Rifa';
        document.getElementById('submit-text').textContent = 'Criar Rifa';
        document.getElementById('raffle-form').action = '{{ route("associacao.raffles.store") }}';
        document.getElementById('method-field').innerHTML = '';
        
        // Limpar formulário
        document.getElementById('raffle-form').reset();
        document.getElementById('image-preview').classList.add('hidden');
        
        document.getElementById('raffle-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function editRaffle(id, title, description, price, status, drawDate, imageUrl) {
        isEditMode = true;
        editRaffleId = id;
        document.getElementById('modal-title').textContent = 'Editar Rifa';
        document.getElementById('submit-text').textContent = 'Atualizar Rifa';
        document.getElementById('raffle-form').action = `/associacao/raffles/${id}`;
        document.getElementById('method-field').innerHTML = '<input type="hidden" name="_method" value="PUT">';

        // Preencher os campos
        document.getElementById('raffle-title').value = title;
        document.getElementById('raffle-description').value = description;
        document.getElementById('raffle-price').value = price;
        document.getElementById('raffle-status').value = status;
        document.getElementById('raffle-draw-date').value = drawDate;

        // Imagem
        if (imageUrl) {
            const imagePreviewContainer = document.getElementById('image-preview');
            const imagePreviewImg = document.getElementById('preview-img');
            imagePreviewImg.src = imageUrl;
            imagePreviewContainer.classList.remove('hidden');
        }

        // Abrir modal
        document.getElementById('raffle-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeRaffleModal() {
        document.getElementById('raffle-modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function confirmDelete(raffleId, raffleName) {
        document.getElementById('raffle-name').textContent = raffleName;
        document.getElementById('delete-form').action = `/associacao/raffles/${raffleId}`;
        document.getElementById('delete-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Preview de imagem
    document.getElementById('raffle-image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
                document.getElementById('file-name').textContent = file.name;
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('image-preview').classList.add('hidden');
            document.getElementById('file-name').textContent = 'Clique para enviar uma imagem';
        }
    });

    // Fechar modal com Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
            closeRaffleModal();
        }
    });

    // Fechar modal clicando fora
    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    document.getElementById('raffle-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRaffleModal();
        }
    });

    // Inicializa os ícones da página
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
@endsection
