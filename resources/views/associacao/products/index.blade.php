@extends('layouts.app')

@section('title', 'Produtos')
@section('page-title', 'Produtos')

@section('content')
<div class="space-y-6">
    {{-- CABEÇALHO PRINCIPAL --}}
    <div class="bg-gradient-to-r from-purple-900 via-purple-800 to-black rounded-xl p-6 border border-purple-500/20 shadow-2xl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
                        <i data-lucide="package" class="w-7 h-7 text-white"></i>
                    </div>
                    <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">Gestão de Produtos</h2>
                </div>
                <p class="text-purple-200">Controle total dos seus produtos e vendas</p>
            </div>
            <div class="flex items-center gap-3">
                {{-- Substituindo link por botão que abre modal --}}
                <button onclick="openProductModal()" class="inline-flex items-center space-x-2 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                    <span>Novo Produto</span>
                </button>
            </div>
        </div>
    </div>

    {{-- GRID DE PRODUTOS --}}
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden">
                        
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/20 dark:to-pink-900/20 flex items-center justify-center">
                                <i data-lucide="image" class="w-12 h-12 text-purple-400"></i>
                            </div>
                            
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-3 right-3">
                            
                            @if($product->is_active)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/90 text-white backdrop-blur-sm">
                                    <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                    Ativo
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-500/90 text-white backdrop-blur-sm">
                                    <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                    Inativo
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white group-hover:bg-gradient-to-r group-hover:from-purple-600 group-hover:to-pink-500 group-hover:bg-clip-text group-hover:text-transparent transition-all duration-300 line-clamp-2">
                                {{ $product->name }}
                            </h3>
                        </div>
                        
                        @if($product->description)
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">
                                {{ $product->description }}
                            </p>
                        @endif

                          <div class="text-center mb-4">
                            @if($product->categoria_produto)
                                <span class="text-xs px-3 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-full font-medium">
                                    {{ \App\Enums\CategoriaProduto::all()[$product->categoria_produto] ?? 'N/A' }}
                                </span>
                            @endif
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="text-2xl font-bold bg-gradient-to-r from-green-600 to-emerald-500 bg-clip-text text-transparent">
                                R$ {{ number_format($product->price, 2, ',', '.') }}
                            </div>
                        </div>
                        
                        <!-- Product Meta -->
                        <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-4">
                            <div class="flex items-center space-x-2">
                                @if($product->tipo_produto !== null)
                                    <span class="flex items-center bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-lg">
                                        <i data-lucide="{{ $product->tipo_produto == 1 ? 'monitor' : 'package' }}" class="w-3 h-3 mr-1"></i>
                                        {{ $product->tipo_produto == 1 ? 'Digital' : 'Físico' }}
                                    </span>
                                @endif
                            </div>
                            
                            <span class="bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-lg">{{ $product->created_at->format('d/m/Y') }}</span>
                        </div>
                        
                        
                        <!-- Actions -->
                        <div class="flex space-x-2">
                            {{-- Substituindo link de edição por botão que abre modal --}}
                            <button onclick="editProduct({{ $product->id }}, '{{ $product->name }}', '{{ $product->description }}', {{ $product->price }}, {{ $product->is_active ? 'true' : 'false' }}, {{ $product->tipo_produto ?? 'null' }}, {{ $product->categoria_produto ?? 'null' }}, '{{ $product->url_venda ?? '' }}', '{{ $product->nome_sac ?? '' }}', '{{ $product->email_sac ?? '' }}', '{{ $product->image ? Storage::url($product->image) : '' }}')" 
                               class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white rounded-xl text-sm font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                                Editar
                            </button>
                            <button onclick="confirmDelete('{{ $product->id }}', '{{ $product->name }}')" 
                                    class="px-4 py-3 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white rounded-xl text-sm font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
            <div class="flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl border border-purple-500/30 p-12 text-center shadow-xl">
            <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                <i data-lucide="package" class="w-10 h-10 text-white"></i>
            </div>
            <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent mb-3">Nenhum produto encontrado</h3>
            <p class="text-gray-300 mb-8 max-w-md mx-auto">
                Você ainda não possui produtos cadastrados. Comece criando seu primeiro produto e impulsione suas vendas.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                {{-- Substituindo link por botão que abre modal --}}
                <button onclick="openProductModal()" 
                   class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Criar Primeiro Produto</span>
                </button>
            </div>
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
                    Tem certeza que deseja excluir o produto <strong id="product-name" class="text-white"></strong>?
                </p>
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4">
                    <p class="text-sm text-red-400 flex items-center">
                        <i data-lucide="alert-triangle" class="w-4 h-4 mr-2"></i>
                        Esta ação não pode ser desfeita e removerá permanentemente o produto.
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
                        Excluir Produto
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Product Modal -->
<div id="product-modal" class="fixed inset-0 bg-black/70 z-50 hidden backdrop-blur-sm">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto transform transition-all shadow-2xl border border-purple-500/30">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-purple-600 to-pink-500 p-6 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <i data-lucide="package" class="w-5 h-5 text-white"></i>
                        </div>
                        <h3 id="modal-title" class="text-xl font-bold text-white">Novo Produto</h3>
                    </div>
                    <button onclick="closeProductModal()" class="text-white/80 hover:text-white transition-colors">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <form id="product-form" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                <div id="method-field"></div>

                <!-- Informações Básicas -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <i data-lucide="info" class="w-5 h-5 mr-2 text-purple-500"></i>
                        Informações Básicas
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome do Produto *</label>
                            <input type="text" name="name" id="product-name-input" required
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Preço (R$) *</label>
                            <input type="number" name="price" id="product-price" step="0.01" min="0" required
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Descrição</label>
                        <textarea name="description" id="product-description" rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300 resize-none"></textarea>
                    </div>
                </div>

                <!-- Configurações -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <i data-lucide="settings" class="w-5 h-5 mr-2 text-purple-500"></i>
                        Configurações
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                            <select name="is_active" id="product-status"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300">
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tipo</label>
                            <select name="tipo_produto" id="product-type"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300">
                                <option value="">Selecione</option>
                                <option value="1">Digital</option>
                                <option value="0">Físico</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Categoria</label>
                            <select name="categoria_produto" id="product-category"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300">
                                <option value="">Selecione</option>
                                @if(class_exists('\App\Enums\CategoriaProduto'))
                                    @foreach(\App\Enums\CategoriaProduto::all() as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Imagem -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <i data-lucide="image" class="w-5 h-5 mr-2 text-purple-500"></i>
                        Imagem do Produto
                    </h4>
                    
                    <div class="flex items-center space-x-4">
                        <div id="image-preview" class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-300 dark:border-gray-600 hidden">
                            <img id="preview-img" class="w-full h-full object-cover rounded-xl" alt="Preview">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="image" id="product-image" accept="image/*" 
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Formatos aceitos: JPG, PNG, GIF (máx. 2MB)</p>
                        </div>
                    </div>
                </div>

                <!-- Informações Adicionais -->
                <div class="space-y-4">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <i data-lucide="link" class="w-5 h-5 mr-2 text-purple-500"></i>
                        Informações Adicionais
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">URL de Venda</label>
                            <input type="url" name="url_venda" id="product-url"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome do SAC</label>
                            <input type="text" name="nome_sac" id="product-phone"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email SAC</label>
                        <input type="email" name="email_sac" id="product-email"
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all duration-300">
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="button" onclick="closeProductModal()" 
                            class="flex-1 px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl font-medium transition-all duration-300">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 px-6 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl">
                        <span id="submit-text">Criar Produto</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleDarkMode() {
        const html = document.documentElement;
        const isDark = html.classList.contains('dark');
        
        if (isDark) {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        } else {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        }
    }

    function initializeTheme() {
        const savedTheme = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }

    function confirmDelete(productId, productName) {
        document.getElementById('product-name').textContent = productName;
        document.getElementById('delete-form').action = `/associacao/products/${productId}`;
        document.getElementById('delete-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    let isEditMode = false;
    let editProductId = null;

    function openProductModal() {
        isEditMode = false;
        editProductId = null;
        document.getElementById('modal-title').textContent = 'Novo Produto';
        document.getElementById('submit-text').textContent = 'Criar Produto';
        document.getElementById('product-form').action = '{{ route("associacao.products.store") }}';
        document.getElementById('method-field').innerHTML = '';
        
        // Limpar formulário
        document.getElementById('product-form').reset();
        document.getElementById('image-preview').classList.add('hidden');
        
        document.getElementById('product-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function editProduct(id, name, description, price, isActive, type, category, url, phone, email, imageUrl) {
        isEditMode = true;
        editProductId = id;
        document.getElementById('modal-title').textContent = 'Editar Produto';
        document.getElementById('submit-text').textContent = 'Atualizar Produto';
        document.getElementById('product-form').action = `/associacao/products/${id}`;
        document.getElementById('method-field').innerHTML = '@method("PUT")';
        
        // Preencher formulário
        document.getElementById('product-name-input').value = name;
        document.getElementById('product-description').value = description || '';
        document.getElementById('product-price').value = price;
        document.getElementById('product-status').value = isActive ? '1' : '0';
        document.getElementById('product-type').value = type || '';
        document.getElementById('product-category').value = category || '';
        document.getElementById('product-url').value = url || '';
        document.getElementById('product-phone').value = phone || '';
        document.getElementById('product-email').value = email || '';
        
        // Mostrar preview da imagem se existir
        if (imageUrl) {
            document.getElementById('preview-img').src = imageUrl;
            document.getElementById('image-preview').classList.remove('hidden');
        } else {
            document.getElementById('image-preview').classList.add('hidden');
        }
        
        document.getElementById('product-modal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeProductModal() {
        document.getElementById('product-modal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // Preview de imagem
    document.getElementById('product-image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('image-preview').classList.add('hidden');
        }
    });

    // Fechar modal com Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
            closeProductModal();
        }
    });

    // Fechar modal clicando fora
    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    document.getElementById('product-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeProductModal();
        }
    });

    // Inicializa os ícones da página
    document.addEventListener('DOMContentLoaded', () => {
        initializeTheme();
        lucide.createIcons();
    });
</script>
@endsection
