@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="edit-3" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Editar Notícia: <span class="font-normal text-gray-600 dark:text-gray-400">{{ Str::limit($news->title, 30) }}</span>
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        Atualize os detalhes da notícia
                    </p>
                </div>
            </div>
            <a href="{{ route('associacao.news.index') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    <form action="{{ route('associacao.news.update', $news) }}" 
          method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex items-center space-x-2">
                            <i data-lucide="file-text" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detalhes da Notícia</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Título da Notícia *
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $news->title) }}"
                                   required
                                   maxlength="255"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-gray-700 dark:text-white text-lg font-medium transition-all @error('title') border-red-500 focus:ring-red-500 @enderror"
                                   placeholder="Digite o título da notícia...">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Resumo *
                            </label>
                            <textarea id="excerpt" 
                                      name="excerpt" 
                                      rows="3" 
                                      required
                                      maxlength="500"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-gray-700 dark:text-white resize-none transition-all @error('excerpt') border-red-500 focus:ring-red-500 @enderror"
                                      placeholder="Escreva um breve resumo da notícia...">{{ old('excerpt', $news->excerpt) }}</textarea>
                            <div class="flex justify-between mt-1">
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    Este resumo aparecerá na timeline de notícias
                                </span>
                                <span id="excerpt-counter" class="text-xs text-gray-500 dark:text-gray-400">
                                    0/500
                                </span>
                            </div>
                            @error('excerpt')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex items-center space-x-2">
                            <i data-lucide="edit-3" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Conteúdo</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div>
                            <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                <div class="bg-gray-50 dark:bg-gray-700 border-b border-gray-300 dark:border-gray-600 p-2">
                                    <div class="flex flex-wrap gap-1">
                                        <button type="button" onclick="formatText('bold')" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded" title="Negrito">
                                            <i data-lucide="bold" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" onclick="formatText('italic')" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded" title="Itálico">
                                            <i data-lucide="italic" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" onclick="formatText('underline')" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded" title="Sublinhado">
                                            <i data-lucide="underline" class="w-4 h-4"></i>
                                        </button>
                                        <div class="w-px bg-gray-300 dark:bg-gray-600 mx-1"></div>
                                        <button type="button" onclick="formatText('insertUnorderedList')" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded" title="Lista">
                                            <i data-lucide="list" class="w-4 h-4"></i>
                                        </button>
                                        <button type="button" onclick="formatText('insertOrderedList')" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded" title="Lista Numerada">
                                            <i data-lucide="list-ordered" class="w-4 h-4"></i>
                                        </button>
                                        <div class="w-px bg-gray-300 dark:bg-gray-600 mx-1"></div>
                                        <button type="button" onclick="insertLink()" class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 rounded" title="Link">
                                            <i data-lucide="link" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <div id="content-editor" 
                                     contenteditable="true" 
                                     class="min-h-[400px] p-4 focus:outline-none dark:bg-gray-700 dark:text-white"
                                     style="max-height: 600px; overflow-y: auto;"
                                     placeholder="Escreva o conteúdo da notícia aqui...">{{ old('content', $news->content) }}</div>
                                
                                <textarea id="content" name="content" class="hidden" required>{{ old('content', $news->content) }}</textarea>
                            </div>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex items-center space-x-2">
                            <i data-lucide="check-square" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Publicação</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Status
                            </label>
                            <select id="status" name="status"
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
                                <option value="draft" {{ old('status', $news->status) === 'draft' ? 'selected' : '' }}>Rascunho</option>
                                <option value="published" {{ old('status', $news->status) === 'published' ? 'selected' : '' }}>Publicada</option>
                            </select>
                        </div>
                        <div>
                            <label for="published_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Data de Publicação
                            </label>
                            <input type="datetime-local" id="published_at" name="published_at"
                                   value="{{ old('published_at', $news->published_at?->format('Y-m-d\TH:i')) }}"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Deixe em branco para publicar imediatamente.
                            </p>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                   {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}
                                   class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="is_featured" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                Notícia em destaque
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex items-center space-x-2">
                            <i data-lucide="image" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Imagem Destacada</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        <div id="image-preview" class="{{ $news->featured_image ? '' : 'hidden' }}">
                            <img id="preview-img" src="{{ $news->featured_image_url }}" alt="Preview" class="w-full h-48 object-cover rounded-lg shadow">
                            <button type="button" onclick="removeImage()" class="mt-2 text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 flex items-center space-x-1">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                <span>Remover imagem</span>
                            </button>
                            <input type="hidden" name="remove_featured_image" id="remove_featured_image" value="0">
                        </div>
                        <div id="image-upload" class="{{ $news->featured_image ? 'hidden' : '' }} border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center">
                            <input type="file" id="featured_image" name="featured_image" accept="image/*" class="hidden" onchange="previewImage(this)">
                            <label for="featured_image" class="cursor-pointer">
                                <i data-lucide="upload" class="w-8 h-8 text-gray-400 mx-auto mb-2"></i>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Clique para selecionar uma imagem
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    PNG, JPG até 2MB
                                </p>
                            </label>
                        </div>
                        @error('featured_image')
                            <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex items-center space-x-2">
                            <i data-lucide="tags" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tags</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <input type="text" id="tag-input" placeholder="Digite uma tag e pressione Enter"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                        </div>
                        <div id="selected-tags" class="flex flex-wrap gap-2"></div>
                        <input type="hidden" id="tags" name="tags" value="{{ old('tags', json_encode($news->tags ?? [])) }}">
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            Pressione Enter para adicionar uma tag
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex items-center space-x-2">
                            <i data-lucide="link" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">URL da Notícia</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex">
                            <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-sm">
                                {{ url('/') }}/noticias/
                            </span>
                            <input type="text" id="slug" name="slug"
                                   value="{{ old('slug', $news->slug ?? '') }}"
                                   class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-r-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                   placeholder="url-da-noticia">
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                            Deixe em branco para gerar automaticamente.
                        </p>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('associacao.news.index') }}" 
                   class="inline-flex items-center justify-center space-x-2 px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span>Cancelar</span>
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center space-x-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Salvar Alterações</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // ------------------ Contador de caracteres do resumo ------------------
        const excerptTextarea = document.getElementById('excerpt');
        const excerptCounter = document.getElementById('excerpt-counter');
        function updateExcerptCounter() {
            const length = excerptTextarea.value.length;
            excerptCounter.textContent = `${length}/500`;
            excerptCounter.className = length > 450 ? 'text-xs text-red-500' : 'text-xs text-gray-500 dark:text-gray-400';
        }
        if (excerptTextarea) {
            excerptTextarea.addEventListener('input', updateExcerptCounter);
            updateExcerptCounter();
        }

        // ------------------ Geração automática de slug ------------------
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        if (titleInput && slugInput) {
            slugInput.dataset.manual = '{{ old('slug', $news->slug ?? '') ? 'true' : '' }}';
            titleInput.addEventListener('input', function() {
                if (!slugInput.dataset.manual) {
                    const slug = this.value
                        .toLowerCase()
                        .normalize('NFD')
                        .replace(/[\u0300-\u036f]/g, '')
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .trim('-');
                    slugInput.value = slug;
                }
            });
            slugInput.addEventListener('input', function() {
                this.dataset.manual = 'true';
            });
        }
        
        // ------------------ Editor de conteúdo ------------------
        const contentEditor = document.getElementById('content-editor');
        const contentTextarea = document.getElementById('content');
        if (contentEditor && contentTextarea) {
            contentEditor.addEventListener('input', function() {
                contentTextarea.value = this.innerHTML;
            });
            contentEditor.innerHTML = contentTextarea.value; // Carrega o conteúdo
        }
        
        // ------------------ Placeholder para o editor ------------------
        contentEditor.addEventListener('focus', function() {
            if (this.innerHTML === '') {
                this.innerHTML = '';
            }
        });
        contentEditor.addEventListener('blur', function() {
            if (this.innerHTML === '') {
                this.setAttribute('data-placeholder', 'Escreva o conteúdo da notícia aqui...');
            }
        });

        // ------------------ Sistema de tags ------------------
        const tagInput = document.getElementById('tag-input');
        const selectedTagsDiv = document.getElementById('selected-tags');
        const tagsHiddenInput = document.getElementById('tags');
        let tags = [];
        if (tagsHiddenInput && tagsHiddenInput.value) {
            try {
                const existingTags = JSON.parse(tagsHiddenInput.value);
                if (Array.isArray(existingTags)) {
                    tags = existingTags;
                }
            } catch (e) {
                console.error("Erro ao parsear as tags existentes:", e);
            }
        }
        renderTags();
        if (tagInput) {
            tagInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const tag = this.value.trim();
                    if (tag && !tags.includes(tag)) {
                        tags.push(tag);
                        renderTags();
                        this.value = '';
                    }
                }
            });
        }
        
        window.removeTag = function(index) {
            tags.splice(index, 1);
            renderTags();
        };

        function renderTags() {
            if (selectedTagsDiv && tagsHiddenInput) {
                selectedTagsDiv.innerHTML = '';
                tags.forEach((tag, index) => {
                    const tagElement = document.createElement('span');
                    tagElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
                    tagElement.innerHTML = `
                        ${tag}
                        <button type="button" onclick="removeTag(${index})" class="ml-2 text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-200">
                            <i data-lucide="x" class="w-3 h-3"></i>
                        </button>
                    `;
                    selectedTagsDiv.appendChild(tagElement);
                });
                tagsHiddenInput.value = JSON.stringify(tags);
                lucide.createIcons();
            }
        }

        // ------------------ Funções do editor ------------------
        window.formatText = function(command) {
            document.execCommand(command, false, null);
            document.getElementById('content-editor').focus();
        };
        window.insertLink = function() {
            const url = prompt('Digite a URL do link:');
            if (url) {
                document.execCommand('createLink', false, url);
            }
            document.getElementById('content-editor').focus();
        };

        // ------------------ Preview de imagem ------------------
        window.previewImage = function(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                    document.getElementById('image-upload').classList.add('hidden');
                    const removeInput = document.getElementById('remove_featured_image');
                    if (removeInput) removeInput.value = '0';
                };
                reader.readAsDataURL(input.files[0]);
            }
        };

        window.removeImage = function() {
            document.getElementById('featured_image').value = '';
            document.getElementById('image-preview').classList.add('hidden');
            document.getElementById('image-upload').classList.remove('hidden');
            const removeInput = document.getElementById('remove_featured_image');
            if (removeInput) removeInput.value = '1';
        };
    });
</script>
<style>
#content-editor:empty:before {
    content: attr(placeholder);
    color: #9CA3AF;
    pointer-events: none;
}
.dark #content-editor:empty:before { color: #6B7280; }
#content-editor:focus:before { content: none; }
</style>
@endpush