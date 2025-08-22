@extends('layouts.mobile-app')

@section('title', 'Mensagens - Lux Secrets')
@section('page-title', 'Mensagens')
@section('page-subtitle', 'Suas conversas e mensagens')

@section('content')
<div class="flex h-full">
    <!-- Lista de Conversas -->
    <div class="w-full lg:w-1/3 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col">
        <!-- Header da Lista -->
        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-display font-semibold text-gray-900 dark:text-white">Conversas</h2>
                <button id="new-conversation-btn" class="p-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                </button>
            </div>
            
            <!-- Busca -->
            <div class="relative">
                <input type="text" 
                       id="search-conversations" 
                       placeholder="Buscar conversas..." 
                       class="w-full px-4 py-2 pl-10 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400"></i>
            </div>
        </div>

        <!-- Lista de Conversas -->
        <div class="flex-1 overflow-y-auto" id="conversations-list">
            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="message-circle" class="w-8 h-8"></i>
                </div>
                <p>Carregando conversas...</p>
            </div>
        </div>
    </div>

    <!-- Área de Conversa -->
    <div class="hidden lg:flex flex-1 flex-col bg-gray-50 dark:bg-gray-900" id="conversation-area">
        <div class="flex-1 flex items-center justify-center">
            <div class="text-center text-gray-500 dark:text-gray-400">
                <div class="w-24 h-24 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="message-circle" class="w-12 h-12"></i>
                </div>
                <h3 class="text-lg font-medium mb-2">Selecione uma conversa</h3>
                <p>Escolha uma conversa da lista para começar a conversar</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nova Conversa -->
<div id="new-conversation-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-md">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-display font-semibold text-gray-900 dark:text-white">Nova Conversa</h3>
                <button id="close-modal-btn" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Buscar Usuários -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Buscar usuário</label>
                <div class="relative">
                    <input type="text" 
                           id="search-users" 
                           placeholder="Digite o nome ou username..." 
                           class="w-full px-4 py-2 pl-10 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                </div>
            </div>

            <!-- Resultados da Busca -->
            <div id="users-search-results" class="space-y-2 max-h-60 overflow-y-auto mb-4">
                <!-- Resultados aparecerão aqui -->
            </div>

            <!-- Botões -->
            <div class="flex space-x-3">
                <button id="cancel-conversation-btn" class="flex-1 px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Cancelar
                </button>
                <button id="create-conversation-btn" class="flex-1 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Criar Conversa
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Template para Item de Conversa -->
<template id="conversation-item-template">
    <div class="conversation-item flex items-center p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer border-b border-gray-100 dark:border-gray-700 transition-colors" data-conversation-id="">
        <div class="relative flex-shrink-0 mr-3">
            <div class="w-12 h-12 bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 rounded-full flex items-center justify-center">
                <span class="conversation-avatar text-sm font-semibold text-primary-600"></span>
            </div>
            <div class="unread-indicator absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center hidden">
                <span class="unread-count"></span>
            </div>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-1">
                <h4 class="conversation-title text-sm font-medium text-gray-900 dark:text-white truncate"></h4>
                <span class="conversation-time text-xs text-gray-500 dark:text-gray-400"></span>
            </div>
            <p class="conversation-last-message text-sm text-gray-600 dark:text-gray-400 truncate"></p>
        </div>
    </div>
</template>

<!-- Template para Resultado de Busca de Usuário -->
<template id="user-search-result-template">
    <div class="user-result flex items-center p-3 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg cursor-pointer transition-colors" data-user-id="">
        <div class="w-10 h-10 bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 rounded-full flex items-center justify-center mr-3">
            <span class="user-avatar text-sm font-semibold text-primary-600"></span>
        </div>
        <div class="flex-1 min-w-0">
            <h4 class="user-name text-sm font-medium text-gray-900 dark:text-white"></h4>
            <p class="user-username text-xs text-gray-500 dark:text-gray-400"></p>
        </div>
        <div class="user-select-indicator w-5 h-5 border-2 border-gray-300 dark:border-gray-600 rounded-full flex items-center justify-center">
            <div class="w-3 h-3 bg-primary-600 rounded-full hidden"></div>
        </div>
    </div>
</template>
@endsection

@push('styles')
<style>
    .conversation-item.active {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(22, 163, 74, 0.1) 100%);
        border-left: 4px solid #ff00ff;
    }
    
    .user-result.selected {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(22, 163, 74, 0.1) 100%);
    }
    
    .user-result.selected .user-select-indicator div {
        display: block;
    }
    
    @media (max-width: 1024px) {
        .conversation-item.active {
            border-left: none;
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const conversationsList = document.getElementById('conversations-list');
    const newConversationBtn = document.getElementById('new-conversation-btn');
    const newConversationModal = document.getElementById('new-conversation-modal');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const cancelConversationBtn = document.getElementById('cancel-conversation-btn');
    const searchUsersInput = document.getElementById('search-users');
    const usersSearchResults = document.getElementById('users-search-results');
    const createConversationBtn = document.getElementById('create-conversation-btn');
    const searchConversationsInput = document.getElementById('search-conversations');
    
    let conversations = [];
    let selectedUser = null;
    let searchTimeout = null;

    // Carrega conversas
    loadConversations();

    // Event Listeners
    newConversationBtn.addEventListener('click', openNewConversationModal);
    closeModalBtn.addEventListener('click', closeNewConversationModal);
    cancelConversationBtn.addEventListener('click', closeNewConversationModal);
    searchUsersInput.addEventListener('input', handleUserSearch);
    createConversationBtn.addEventListener('click', createConversation);
    searchConversationsInput.addEventListener('input', handleConversationSearch);

    // Fecha modal ao clicar fora
    newConversationModal.addEventListener('click', function(e) {
        if (e.target === newConversationModal) {
            closeNewConversationModal();
        }
    });

    function loadConversations() {
        fetch('/api/conversations')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    conversations = data.data;
                    renderConversations(conversations);
                } else {
                    showError('Erro ao carregar conversas');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                showError('Erro ao carregar conversas');
            });
    }

    function renderConversations(conversationsToRender) {
        const template = document.getElementById('conversation-item-template');
        conversationsList.innerHTML = '';

        if (conversationsToRender.length === 0) {
            conversationsList.innerHTML = `
                <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="message-circle" class="w-8 h-8"></i>
                    </div>
                    <p>Nenhuma conversa encontrada</p>
                    <button class="mt-2 text-primary-600 hover:text-primary-700 text-sm font-medium" onclick="document.getElementById('new-conversation-btn').click()">
                        Iniciar nova conversa
                    </button>
                </div>
            `;
            lucide.createIcons();
            return;
        }

        conversationsToRender.forEach(conversation => {
            const clone = template.content.cloneNode(true);
            const item = clone.querySelector('.conversation-item');
            
            item.dataset.conversationId = conversation.id;
            
            // Avatar
            const avatar = clone.querySelector('.conversation-avatar');
            avatar.textContent = conversation.title ? conversation.title.charAt(0).toUpperCase() : 'C';
            
            // Título
            const title = clone.querySelector('.conversation-title');
            title.textContent = conversation.title || 'Conversa';
            
            // Última mensagem
            const lastMessage = clone.querySelector('.conversation-last-message');
            if (conversation.last_message) {
                const prefix = conversation.last_message.is_own ? 'Você: ' : '';
                lastMessage.textContent = prefix + (conversation.last_message.content || 'Anexo');
            } else {
                lastMessage.textContent = 'Nenhuma mensagem ainda';
            }
            
            // Tempo
            const time = clone.querySelector('.conversation-time');
            if (conversation.last_message) {
                time.textContent = formatTime(conversation.last_message.created_at);
            }
            
            // Contador de não lidas
            if (conversation.unread_count > 0) {
                const indicator = clone.querySelector('.unread-indicator');
                const count = clone.querySelector('.unread-count');
                indicator.classList.remove('hidden');
                count.textContent = conversation.unread_count > 99 ? '99+' : conversation.unread_count;
            }
            
            // Click handler
            item.addEventListener('click', () => openConversation(conversation.id));
            
            conversationsList.appendChild(clone);
        });

        lucide.createIcons();
    }

    function openNewConversationModal() {
        newConversationModal.classList.remove('hidden');
        searchUsersInput.focus();
        selectedUser = null;
        usersSearchResults.innerHTML = '';
        createConversationBtn.disabled = true;
    }

    function closeNewConversationModal() {
        newConversationModal.classList.add('hidden');
        searchUsersInput.value = '';
        usersSearchResults.innerHTML = '';
        selectedUser = null;
    }

    function handleUserSearch(e) {
        const query = e.target.value.trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            usersSearchResults.innerHTML = '';
            return;
        }
        
        searchTimeout = setTimeout(() => {
            searchUsers(query);
        }, 300);
    }

    function searchUsers(query) {
        fetch(`/api/users/search?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    renderUserSearchResults(data.data);
                }
            })
            .catch(error => {
                console.error('Erro na busca:', error);
            });
    }

    function renderUserSearchResults(users) {
        const template = document.getElementById('user-search-result-template');
        usersSearchResults.innerHTML = '';

        if (users.length === 0) {
            usersSearchResults.innerHTML = '<p class="text-center text-gray-500 dark:text-gray-400 py-4">Nenhum usuário encontrado</p>';
            return;
        }

        users.forEach(user => {
            const clone = template.content.cloneNode(true);
            const item = clone.querySelector('.user-result');
            
            item.dataset.userId = user.id;
            
            // Avatar
            const avatar = clone.querySelector('.user-avatar');
            avatar.textContent = user.name.charAt(0).toUpperCase();
            
            // Nome
            const name = clone.querySelector('.user-name');
            name.textContent = user.name;
            
            // Username
            const username = clone.querySelector('.user-username');
            username.textContent = '@' + (user.username || user.email);
            
            // Click handler
            item.addEventListener('click', () => selectUser(user, item));
            
            usersSearchResults.appendChild(clone);
        });
    }

    function selectUser(user, element) {
        // Remove seleção anterior
        usersSearchResults.querySelectorAll('.user-result').forEach(item => {
            item.classList.remove('selected');
        });
        
        // Adiciona seleção atual
        element.classList.add('selected');
        selectedUser = user;
        createConversationBtn.disabled = false;
    }

    function createConversation() {
        if (!selectedUser) return;

        createConversationBtn.disabled = true;
        createConversationBtn.textContent = 'Criando...';

        fetch('/api/conversations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                type: 'private',
                participants: [selectedUser.id]
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeNewConversationModal();
                openConversation(data.data.id);
                loadConversations(); // Recarrega a lista
            } else {
                showError(data.message || 'Erro ao criar conversa');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showError('Erro ao criar conversa');
        })
        .finally(() => {
            createConversationBtn.disabled = false;
            createConversationBtn.textContent = 'Criar Conversa';
        });
    }

    function openConversation(conversationId) {
        // Em mobile, redireciona para página da conversa
        if (window.innerWidth < 1024) {
            window.location.href = `/messages/conversation/${conversationId}`;
            return;
        }

        // Em desktop, carrega conversa na área lateral
        // Marca conversa como ativa
        document.querySelectorAll('.conversation-item').forEach(item => {
            item.classList.remove('active');
        });
        
        const activeItem = document.querySelector(`[data-conversation-id="${conversationId}"]`);
        if (activeItem) {
            activeItem.classList.add('active');
        }

        // Carrega conversa (implementar depois)
        loadConversationMessages(conversationId);
    }

    function loadConversationMessages(conversationId) {
        // Implementar carregamento de mensagens
        console.log('Carregando conversa:', conversationId);
    }

    function handleConversationSearch(e) {
        const query = e.target.value.toLowerCase().trim();
        
        if (query === '') {
            renderConversations(conversations);
            return;
        }

        const filtered = conversations.filter(conversation => {
            const title = (conversation.title || '').toLowerCase();
            const lastMessage = conversation.last_message ? 
                (conversation.last_message.content || '').toLowerCase() : '';
            
            return title.includes(query) || lastMessage.includes(query);
        });

        renderConversations(filtered);
    }

    function formatTime(dateString) {
        const date = new Date(dateString);
        const now = new Date();
        const diff = now - date;
        
        // Menos de 1 minuto
        if (diff < 60000) {
            return 'Agora';
        }
        
        // Menos de 1 hora
        if (diff < 3600000) {
            const minutes = Math.floor(diff / 60000);
            return `${minutes}m`;
        }
        
        // Menos de 24 horas
        if (diff < 86400000) {
            const hours = Math.floor(diff / 3600000);
            return `${hours}h`;
        }
        
        // Menos de 7 dias
        if (diff < 604800000) {
            const days = Math.floor(diff / 86400000);
            return `${days}d`;
        }
        
        // Mais de 7 dias
        return date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' });
    }

    function showError(message) {
        // Implementar notificação de erro
        console.error(message);
        alert(message); // Temporário
    }

    // Adicionar meta tag CSRF se não existir
    if (!document.querySelector('meta[name="csrf-token"]')) {
        const meta = document.createElement('meta');
        meta.name = 'csrf-token';
        meta.content = '{{ csrf_token() }}';
        document.head.appendChild(meta);
    }
});
</script>
@endpush

