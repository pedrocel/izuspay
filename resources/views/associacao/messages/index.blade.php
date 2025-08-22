@extends('layouts.app')

@section('title', 'Mensagens - Lux Secrets')
@section('page-title', 'Mensagens')
@section('page-subtitle', 'Suas conversas e mensagens')

@section('content')
<div class="flex h-full">
    <!-- Lista de Conversas -->
    <div class="w-full lg:w-1/3 bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-purple-900/20 border-r border-purple-200 dark:border-purple-500/30 flex flex-col shadow-xl">
        <!-- Header da Lista -->
        <div class="p-6 border-b border-purple-200 dark:border-purple-500/30 bg-gradient-to-r from-purple-900 via-purple-800 to-black">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">Conversas</h2>
                <button id="new-conversation-btn" class="p-3 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                    <i data-lucide="plus" class="w-5 h-5"></i>
                </button>
            </div>
            
            <!-- Busca -->
            <div class="relative">
                <input type="text" 
                       id="search-conversations" 
                       placeholder="Buscar conversas..." 
                       class="w-full px-4 py-3 pl-12 bg-white/10 backdrop-blur-sm border border-purple-300/30 rounded-xl text-white placeholder-purple-200 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300">
                <i data-lucide="search" class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-purple-300"></i>
            </div>
        </div>

        <!-- Lista de Conversas -->
        <div class="flex-1 overflow-y-auto" id="conversations-list">
            <div class="p-6 text-center text-purple-600 dark:text-purple-400">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                    <i data-lucide="message-circle" class="w-8 h-8 text-white"></i>
                </div>
                <p class="font-medium">Carregando conversas...</p>
            </div>
        </div>
    </div>

    <!-- Área de Conversa -->
    <div class="hidden lg:flex flex-1 flex-col bg-gradient-to-br from-gray-50 to-purple-50 dark:from-gray-900 dark:to-purple-900/20" id="conversation-area">
        <div class="flex-1 flex items-center justify-center">
            <div class="text-center text-purple-600 dark:text-purple-400">
                <div class="w-24 h-24 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-2xl">
                    <i data-lucide="message-circle" class="w-12 h-12 text-white"></i>
                </div>
                <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent mb-3">Selecione uma conversa</h3>
                <p class="text-lg text-gray-600 dark:text-gray-400">Escolha uma conversa da lista para começar a conversar</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nova Conversa -->
<div id="new-conversation-modal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-purple-900/20 rounded-3xl shadow-2xl w-full max-w-md border border-purple-200 dark:border-purple-500/30">
        <div class="p-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold bg-gradient-to-r from-purple-600 to-pink-500 bg-clip-text text-transparent">Nova Conversa</h3>
                <button id="close-modal-btn" class="p-2 text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 rounded-xl transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Buscar Usuários -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-purple-700 dark:text-purple-300 mb-3">Buscar usuário</label>
                <div class="relative">
                    <input type="text" 
                           id="search-users" 
                           placeholder="Digite o nome ou username..." 
                           class="w-full px-4 py-3 pl-12 bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-500/30 rounded-xl text-gray-900 dark:text-white placeholder-purple-400 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent transition-all duration-300">
                    <i data-lucide="search" class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-purple-400"></i>
                </div>
            </div>

            <!-- Resultados da Busca -->
            <div id="users-search-results" class="space-y-3 max-h-60 overflow-y-auto mb-6">
                <!-- Resultados aparecerão aqui -->
            </div>

            <!-- Botões -->
            <div class="flex space-x-4">
                <button id="cancel-conversation-btn" class="flex-1 px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300 font-medium">
                    Cancelar
                </button>
                <button id="create-conversation-btn" class="flex-1 px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-xl transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed font-medium shadow-lg hover:shadow-xl" disabled>
                    Criar Conversa
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Template para Item de Conversa -->
<template id="conversation-item-template">
    <div class="conversation-item flex items-center p-4 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 dark:hover:from-purple-900/20 dark:hover:to-pink-900/20 cursor-pointer border-b border-purple-100 dark:border-purple-500/20 transition-all duration-300 group" data-conversation-id="">
        <div class="relative flex-shrink-0 mr-4">
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300">
                <span class="conversation-avatar text-lg font-bold text-white"></span>
            </div>
            <div class="unread-indicator absolute -top-1 -right-1 w-6 h-6 bg-gradient-to-r from-pink-500 to-red-500 text-white text-xs rounded-full flex items-center justify-center hidden shadow-lg">
                <span class="unread-count font-bold"></span>
            </div>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-2">
                <h4 class="conversation-title text-base font-semibold text-gray-900 dark:text-white truncate group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors"></h4>
                <span class="conversation-time text-sm text-purple-500 dark:text-purple-400 font-medium"></span>
            </div>
            <p class="conversation-last-message text-sm text-gray-600 dark:text-gray-400 truncate"></p>
        </div>
    </div>
</template>

<!-- Template para Resultado de Busca de Usuário -->
<template id="user-search-result-template">
    <div class="user-result flex items-center p-4 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 dark:hover:from-purple-900/20 dark:hover:to-pink-900/20 rounded-xl cursor-pointer transition-all duration-300 border border-transparent hover:border-purple-200 dark:hover:border-purple-500/30" data-user-id="">
        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-4 shadow-lg">
            <span class="user-avatar text-sm font-bold text-white"></span>
        </div>
        <div class="flex-1 min-w-0">
            <h4 class="user-name text-base font-semibold text-gray-900 dark:text-white"></h4>
            <p class="user-username text-sm text-purple-500 dark:text-purple-400"></p>
        </div>
        <div class="user-select-indicator w-6 h-6 border-2 border-purple-300 dark:border-purple-600 rounded-full flex items-center justify-center transition-all duration-300">
            <div class="w-4 h-4 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full hidden"></div>
        </div>
    </div>
</template>
@endsection

@push('styles')
<style>
    .conversation-item.active {
        background: linear-gradient(135deg, rgba(168, 85, 247, 0.15) 0%, rgba(236, 72, 153, 0.15) 100%);
        border-left: 4px solid;
        border-image: linear-gradient(135deg, #a855f7, #ec4899) 1;
        box-shadow: 0 10px 25px rgba(168, 85, 247, 0.2);
    }
    
    .user-result.selected {
        background: linear-gradient(135deg, rgba(168, 85, 247, 0.15) 0%, rgba(236, 72, 153, 0.15) 100%);
        border-color: rgba(168, 85, 247, 0.3);
        box-shadow: 0 8px 20px rgba(168, 85, 247, 0.2);
    }
    
    .user-result.selected .user-select-indicator div {
        display: block;
    }
    
    @media (max-width: 1024px) {
        .conversation-item.active {
            border-left: none;
        }
    }

    /* Scrollbar personalizada */
    #conversations-list::-webkit-scrollbar,
    #users-search-results::-webkit-scrollbar {
        width: 6px;
    }
    
    #conversations-list::-webkit-scrollbar-track,
    #users-search-results::-webkit-scrollbar-track {
        background: rgba(168, 85, 247, 0.1);
        border-radius: 3px;
    }
    
    #conversations-list::-webkit-scrollbar-thumb,
    #users-search-results::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #a855f7, #ec4899);
        border-radius: 3px;
    }
    
    #conversations-list::-webkit-scrollbar-thumb:hover,
    #users-search-results::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #9333ea, #db2777);
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
        console.log('ruim');
        const template = document.getElementById('conversation-item-template');
        conversationsList.innerHTML = '';

        if (conversationsToRender.length === 0) {
            conversationsList.innerHTML = `
                <div class="p-6 text-center text-purple-600 dark:text-purple-400">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-2xl">
                        <i data-lucide="message-circle" class="w-10 h-10 text-white"></i>
                    </div>
                    <p class="text-lg font-semibold mb-2">Nenhuma conversa encontrada</p>
                    <button class="mt-4 px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-300 shadow-lg hover:shadow-xl" onclick="document.getElementById('new-conversation-btn').click()">
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
            usersSearchResults.innerHTML = '<p class="text-center text-purple-500 dark:text-purple-400 py-6 font-medium">Nenhum usuário encontrado</p>';
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
                window.location.href = `/associacao/messages/conversation/${data.data.id}`;
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

    function handleConversationSearch(e) {
        const query = e.target.value.toLowerCase().trim();
        
        if (query === '') {
            renderConversations(conversations);
            return;
        }
        
        const filtered = conversations.filter(conversation => {
            return conversation.title.toLowerCase().includes(query) ||
                   (conversation.last_message && conversation.last_message.content.toLowerCase().includes(query));
        });
        
        renderConversations(filtered);
    }

    function openConversation(conversationId) {
        window.location.href = `/associacao/messages/conversation/${conversationId}`;
    }

    function formatTime(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const diff = now - date;
        
        if (diff < 60000) { // menos de 1 minuto
            return 'agora';
        } else if (diff < 3600000) { // menos de 1 hora
            return Math.floor(diff / 60000) + 'm';
        } else if (diff < 86400000) { // menos de 1 dia
            return Math.floor(diff / 3600000) + 'h';
        } else if (diff < 604800000) { // menos de 1 semana
            return Math.floor(diff / 86400000) + 'd';
        } else {
            return date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit' });
        }
    }

    function showError(message) {
        // Implementar sistema de notificação de erro
        console.error(message);
        alert(message); // Temporário
    }
});
</script>
@endpush

