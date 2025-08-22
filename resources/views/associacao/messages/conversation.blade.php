@extends('layouts.app')

@section('title', 'Conversa - Lux Secrets')
@section('page-title', 'Conversa')
@section('page-subtitle', 'Chat')

@section('content')
<div class="flex flex-col h-full bg-gradient-to-br from-white to-purple-50 dark:from-gray-800 dark:to-purple-900/20 rounded-2xl shadow-2xl border border-purple-200 dark:border-purple-500/30 overflow-hidden">
    <!-- Header da Conversa -->
    <div class="flex items-center justify-between p-6 border-b border-purple-200 dark:border-purple-500/30 bg-gradient-to-r from-purple-900 via-purple-800 to-black">
        <div class="flex items-center space-x-4">
            <button onclick="history.back()" class="lg:hidden p-3 text-purple-200 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </button>
            
            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg">
                <span id="conversation-avatar" class="text-lg font-bold text-white">C</span>
            </div>
            
            <div>
                <h3 id="conversation-title" class="text-xl font-bold text-white">Carregando...</h3>
                <p id="conversation-status" class="text-sm text-purple-200 flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                    Online
                </p>
            </div>
        </div>
        
        <div class="flex items-center space-x-3">
            <button id="conversation-info-btn" class="p-3 text-purple-200 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300">
                <i data-lucide="info" class="w-6 h-6"></i>
            </button>
            <button id="conversation-settings-btn" class="p-3 text-purple-200 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-300">
                <i data-lucide="settings" class="w-6 h-6"></i>
            </button>
        </div>
    </div>

    <!-- Área de Mensagens -->
    <div class="flex-1 overflow-y-auto p-6 space-y-6" id="messages-container">
        <div class="text-center text-purple-600 dark:text-purple-400">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl flex items-center justify-center mx-auto mb-4 shadow-xl">
                <i data-lucide="message-circle" class="w-8 h-8 text-white"></i>
            </div>
            <p class="text-lg font-semibold">Carregando mensagens...</p>
        </div>
    </div>

    <!-- Área de Input -->
    <div class="border-t border-purple-200 dark:border-purple-500/30 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 p-6">
        <!-- Preview de Anexos -->
        <div id="attachments-preview" class="hidden mb-4">
            <div class="flex flex-wrap gap-3" id="attachments-list">
                <!-- Previews aparecerão aqui -->
            </div>
        </div>

        <!-- Resposta -->
        <div id="reply-preview" class="hidden mb-4 p-4 bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-xl border-l-4 border-gradient-to-b from-purple-500 to-pink-500 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm text-purple-700 dark:text-purple-300 font-semibold">Respondendo a <span id="reply-user-name" class="font-bold"></span></p>
                    <p class="text-sm text-gray-700 dark:text-gray-300 truncate mt-1" id="reply-content"></p>
                </div>
                <button id="cancel-reply-btn" class="p-2 text-purple-400 hover:text-purple-600 dark:hover:text-purple-300 hover:bg-white/50 rounded-lg transition-all duration-300">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Input de Mensagem -->
        <div class="flex items-end space-x-4">
            <div class="flex space-x-2">
                <button id="attach-btn" class="p-3 text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-200 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-xl transition-all duration-300">
                    <i data-lucide="paperclip" class="w-6 h-6"></i>
                </button>
                <input type="file" id="file-input" multiple accept="image/*,video/*,.pdf,.doc,.docx" class="hidden">
                
                <button id="emoji-btn" class="p-3 text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-200 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-xl transition-all duration-300">
                    <i data-lucide="smile" class="w-6 h-6"></i>
                </button>
            </div>
            
            <div class="flex-1 relative">
                <textarea 
                    id="message-input" 
                    placeholder="Digite sua mensagem..." 
                    rows="1"
                    class="w-full px-6 py-4 bg-white dark:bg-gray-800 border-2 border-purple-200 dark:border-purple-500/30 rounded-2xl text-gray-900 dark:text-white placeholder-purple-400 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent resize-none max-h-32 transition-all duration-300 shadow-lg"
                ></textarea>
            </div>
            
            <button id="send-btn" class="p-4 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white rounded-2xl transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg hover:shadow-xl hover:scale-105" disabled>
                <i data-lucide="send" class="w-6 h-6"></i>
            </button>
        </div>
    </div>
</div>

<!-- Template para Mensagem -->
<template id="message-template">
    <div class="message-item flex group" data-message-id="">
        <div class="message-avatar w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mr-4 flex-shrink-0 shadow-lg">
            <span class="text-sm font-bold text-white"></span>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center space-x-3 mb-2">
                <span class="message-user-name text-base font-semibold text-gray-900 dark:text-white"></span>
                <span class="message-time text-sm text-purple-500 dark:text-purple-400 font-medium"></span>
                <div class="message-actions hidden space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button class="reply-btn p-2 text-purple-400 hover:text-purple-600 dark:hover:text-purple-300 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-lg transition-all duration-300" title="Responder">
                        <i data-lucide="reply" class="w-4 h-4"></i>
                    </button>
                    <button class="edit-btn p-2 text-purple-400 hover:text-purple-600 dark:hover:text-purple-300 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-lg transition-all duration-300 hidden" title="Editar">
                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                    </button>
                    <button class="delete-btn p-2 text-purple-400 hover:text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-all duration-300" title="Deletar">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
            
            <!-- Resposta -->
            <div class="message-reply hidden mb-3 p-3 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-xl border-l-4 border-purple-300 dark:border-purple-600">
                <p class="text-sm text-purple-600 dark:text-purple-400 font-semibold"></p>
                <p class="text-sm text-gray-700 dark:text-gray-300 truncate mt-1"></p>
            </div>
            
            <!-- Conteúdo -->
            <div class="message-content bg-white dark:bg-gray-800 rounded-2xl p-4 shadow-lg border border-purple-100 dark:border-purple-500/20">
                <p class="message-text text-base text-gray-900 dark:text-white whitespace-pre-wrap"></p>
                <div class="message-attachments space-y-3 mt-3"></div>
            </div>
            
            <!-- Status de Edição -->
            <div class="message-edited hidden mt-2">
                <span class="text-sm text-purple-400 italic">editada</span>
            </div>
        </div>
    </div>
</template>

<!-- Template para Mensagem Própria -->
<template id="own-message-template">
    <div class="message-item flex justify-end group" data-message-id="">
        <div class="min-w-0 max-w-xs sm:max-w-md flex flex-col items-end">
            <div class="flex items-center justify-end space-x-3 mb-2">
                <div class="message-actions hidden space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button class="reply-btn p-2 text-purple-400 hover:text-purple-600 dark:hover:text-purple-300 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-lg transition-all duration-300" title="Responder">
                        <i data-lucide="reply" class="w-4 h-4"></i>
                    </button>
                    <button class="edit-btn p-2 text-purple-400 hover:text-purple-600 dark:hover:text-purple-300 hover:bg-purple-100 dark:hover:bg-purple-900/30 rounded-lg transition-all duration-300" title="Editar">
                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                    </button>
                    <button class="delete-btn p-2 text-purple-400 hover:text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-all duration-300" title="Deletar">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </div>
                <span class="message-time text-sm text-purple-500 dark:text-purple-400 font-medium"></span>
            </div>
            
            <!-- Resposta -->
            <div class="message-reply hidden mb-3 p-3 bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-xl border-l-4 border-purple-400 dark:border-purple-500">
                <p class="text-sm text-purple-700 dark:text-purple-300 font-semibold"></p>
                <p class="text-sm text-purple-800 dark:text-purple-200 truncate mt-1"></p>
            </div>
            
            <!-- Conteúdo -->
            <div class="message-content bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-2xl p-4 shadow-xl">
                <p class="message-text text-base whitespace-pre-wrap"></p>
                <div class="message-attachments space-y-3 mt-3"></div>
            </div>
            
            <!-- Status de Edição -->
            <div class="message-edited hidden mt-2 text-right">
                <span class="text-sm text-purple-400 italic">editada</span>
            </div>
        </div>
    </div>
</template>

<!-- Template para Preview de Anexo -->
<template id="attachment-preview-template">
    <div class="attachment-preview relative bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-xl p-4 flex items-center space-x-3 border border-purple-200 dark:border-purple-500/30 shadow-lg">
        <div class="attachment-icon w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg">
            <i data-lucide="file" class="w-6 h-6 text-white"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="attachment-name text-base font-semibold text-gray-900 dark:text-white truncate"></p>
            <p class="attachment-size text-sm text-purple-600 dark:text-purple-400"></p>
        </div>
        <button class="remove-attachment p-2 text-purple-400 hover:text-red-500 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-lg transition-all duration-300">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>
</template>
@endsection

@push('styles')
<style>
    .message-item:hover .message-actions {
        display: flex !important;
    }
    
    .message-item.own {
        justify-content: flex-end;
    }
    
    .attachment-image {
        max-width: 250px;
        max-height: 250px;
        border-radius: 12px;
        cursor: pointer;
        box-shadow: 0 8px 25px rgba(168, 85, 247, 0.2);
        transition: all 0.3s ease;
    }
    
    .attachment-image:hover {
        transform: scale(1.02);
        box-shadow: 0 12px 35px rgba(168, 85, 247, 0.3);
    }
    
    .attachment-video {
        max-width: 350px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(168, 85, 247, 0.2);
    }
    
    #messages-container {
        scroll-behavior: smooth;
    }
    
    /* Auto-resize textarea */
    #message-input {
        field-sizing: content;
    }

    /* Scrollbar personalizada */
    #messages-container::-webkit-scrollbar {
        width: 8px;
    }
    
    #messages-container::-webkit-scrollbar-track {
        background: rgba(168, 85, 247, 0.1);
        border-radius: 4px;
    }
    
    #messages-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #a855f7, #ec4899);
        border-radius: 4px;
    }
    
    #messages-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #9333ea, #db2777);
    }

    /* Animações */
    .message-item {
        animation: slideInMessage 0.3s ease-out;
    }
    
    @keyframes slideInMessage {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Efeito de digitação */
    .typing-indicator {
        display: flex;
        align-items: center;
        space-x-2;
        padding: 12px 16px;
        background: linear-gradient(135deg, rgba(168, 85, 247, 0.1), rgba(236, 72, 153, 0.1));
        border-radius: 16px;
        margin: 8px 0;
    }
    
    .typing-dots {
        display: flex;
        space-x-1;
    }
    
    .typing-dot {
        width: 8px;
        height: 8px;
        background: linear-gradient(135deg, #a855f7, #ec4899);
        border-radius: 50%;
        animation: typingBounce 1.4s infinite ease-in-out;
    }
    
    .typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .typing-dot:nth-child(2) { animation-delay: -0.16s; }
    
    @keyframes typingBounce {
        0%, 80%, 100% {
            transform: scale(0);
        }
        40% {
            transform: scale(1);
        }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const conversationId = {{ $conversation ?? 'null' }};
    const messagesContainer = document.getElementById('messages-container');
    const messageInput = document.getElementById('message-input');
    const sendBtn = document.getElementById('send-btn');
    const attachBtn = document.getElementById('attach-btn');
    const fileInput = document.getElementById('file-input');
    const attachmentsPreview = document.getElementById('attachments-preview');
    const attachmentsList = document.getElementById('attachments-list');
    const replyPreview = document.getElementById('reply-preview');
    const cancelReplyBtn = document.getElementById('cancel-reply-btn');
    
    let messages = [];
    let selectedFiles = [];
    let replyToMessage = null;
    let currentUser = null;

    // Inicialização
    if (conversationId) {
        loadConversation();
        loadMessages();
    } else {
        showError('ID da conversa não fornecido');
    }

    // Event Listeners
    messageInput.addEventListener('input', handleMessageInput);
    messageInput.addEventListener('keydown', handleKeyDown);
    sendBtn.addEventListener('click', sendMessage);
    attachBtn.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', handleFileSelect);
    cancelReplyBtn.addEventListener('click', cancelReply);

    function loadConversation() {
        fetch(`/api/conversations/${conversationId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const conversation = data.data;
                    updateConversationHeader(conversation);
                } else {
                    showError('Erro ao carregar conversa');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                showError('Erro ao carregar conversa');
            });
    }

    function updateConversationHeader(conversation) {
        const avatar = document.getElementById('conversation-avatar');
        const title = document.getElementById('conversation-title');
        
        if (conversation.type === 'private') {
            const otherParticipant = conversation.participants.find(p => p.id !== currentUser?.id);
            if (otherParticipant) {
                avatar.textContent = otherParticipant.name.charAt(0).toUpperCase();
                title.textContent = otherParticipant.name;
            }
        } else {
            avatar.textContent = conversation.title.charAt(0).toUpperCase();
            title.textContent = conversation.title;
        }
    }

    function loadMessages() {
        fetch(`/api/conversations/${conversationId}/messages`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messages = data.data;
                    renderMessages();
                    scrollToBottom();
                    markMessagesAsRead();
                } else {
                    showError('Erro ao carregar mensagens');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                showError('Erro ao carregar mensagens');
            });
    }

    function renderMessages() {
        messagesContainer.innerHTML = '';

        if (messages.length === 0) {
            messagesContainer.innerHTML = `
                <div class="text-center text-purple-600 dark:text-purple-400">
                    <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-2xl">
                        <i data-lucide="message-circle" class="w-10 h-10 text-white"></i>
                    </div>
                    <p class="text-xl font-bold mb-2">Nenhuma mensagem ainda</p>
                    <p class="text-lg">Seja o primeiro a enviar uma mensagem!</p>
                </div>
            `;
            lucide.createIcons();
            return;
        }

        messages.forEach(message => {
            const messageElement = createMessageElement(message);
            messagesContainer.appendChild(messageElement);
        });

        lucide.createIcons();
    }

    // Substitua também a função createMessageElement
function createMessageElement(message) {
    const template = message.is_own ? 
        document.getElementById('own-message-template') : 
        document.getElementById('message-template');
    
    const clone = template.content.cloneNode(true);
    const messageItem = clone.querySelector('.message-item');
    
    messageItem.dataset.messageId = message.id;
    
    if (!message.is_own) {
        const avatar = clone.querySelector('.message-avatar span');
        avatar.textContent = message.user.name.charAt(0).toUpperCase();
        
        const userName = clone.querySelector('.message-user-name');
        userName.textContent = message.user.name;
    }
    
    const time = clone.querySelector('.message-time');
    time.textContent = formatTime(message.created_at);
    
    if (message.reply_to) {
        const replyDiv = clone.querySelector('.message-reply');
        const replyUser = replyDiv.querySelector('p:first-child');
        const replyContent = replyDiv.querySelector('p:last-child');
        
        replyDiv.classList.remove('hidden');
        replyUser.textContent = `Respondendo a ${message.reply_to.user_name}`;
        replyContent.textContent = message.reply_to.content;
    }
    
    const messageText = clone.querySelector('.message-text');
    const hasContent = message.content && message.content.trim().length > 0;
    
    if (hasContent) {
        messageText.textContent = message.content;
    } else {
        messageText.remove(); // Remove o parágrafo se não houver texto
    }
    
    if (message.attachments && message.attachments.length > 0) {
        const attachmentsDiv = clone.querySelector('.message-attachments');
        message.attachments.forEach(attachment => {
            // ✅ AQUI: Passamos o contexto para a função
            const attachmentElement = createAttachmentElement.call({ messageHasContent: hasContent }, attachment);
            attachmentsDiv.appendChild(attachmentElement);
        });
    }
    
    if (message.edited_at) {
        const editedDiv = clone.querySelector('.message-edited');
        editedDiv.classList.remove('hidden');
    }
    
    const replyBtn = clone.querySelector('.reply-btn');
    const editBtn = clone.querySelector('.edit-btn');
    const deleteBtn = clone.querySelector('.delete-btn');
    
    replyBtn.addEventListener('click', () => handleReplyToMessage(message));
    
    if (message.is_own) {
        editBtn.classList.remove('hidden');
        editBtn.addEventListener('click', () => editMessage(message));
    }
    
    deleteBtn.addEventListener('click', () => deleteMessage(message.id));
    
    return clone;
}


    // ✅ ALTERAÇÃO: Esta função agora renderiza a imagem/vídeo diretamente na mensagem
    // Substitua esta função no seu script
function createAttachmentElement(attachment) {
    const div = document.createElement('div');
    // Adiciona uma margem se houver texto na mensagem
    if (this.messageHasContent) {
        div.classList.add('mt-3');
    }

    console.log(attachment);
    // Verifica se o anexo é uma imagem
    if (attachment.type.startsWith('image')) {
        div.innerHTML = `
            <img src="${attachment.url}" 
                 alt="${attachment.name || 'Imagem anexa'}" 
                 class="attachment-image"
                 onclick="openImageModal('${attachment.url}')">
        `;
    // Verifica se é um vídeo
    } else if (attachment.type.startsWith('video')) {
        div.innerHTML = `
            <video controls class="attachment-video">
                <source src="${attachment.url}" type="${attachment.type}">
                Seu navegador não suporta a tag de vídeo.
            </video>
        `;
    // Para todos os outros tipos de arquivo, mostra um link
    } else {
        div.innerHTML = `
            <a href="${attachment.url}" 
               target="_blank" 
               class="flex items-center space-x-3 p-3 bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-xl border border-purple-200 dark:border-purple-500/30 hover:shadow-lg transition-all duration-300">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center flex-shrink-0">
                    <i data-lucide="file" class="w-5 h-5 text-white"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">${attachment.name}</p>
                    <p class="text-xs text-purple-600 dark:text-purple-400">${formatFileSize(attachment.size)}</p>
                </div>
            </a>
        `;
    }
    
    return div;
}


    // ✅ ALTERAÇÃO: Lógica do botão de envio ajustada
    function handleMessageInput() {
        const hasText = messageInput.value.trim().length > 0;
        // O botão só é habilitado se houver texto.
        sendBtn.disabled = !hasText;
        
        messageInput.style.height = 'auto';
        messageInput.style.height = messageInput.scrollHeight + 'px';
    }

    function handleKeyDown(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (!sendBtn.disabled) {
                sendMessage();
            }
        }
    }

    function sendMessage() {
        const content = messageInput.value.trim();
        
        // A verificação agora é apenas no `content`, pois o botão já estaria desabilitado
        if (!content) return;

        const formData = new FormData();
        formData.append('content', content);
        
        if (replyToMessage) {
            formData.append('reply_to_id', replyToMessage.id);
        }
        
        selectedFiles.forEach(file => {
            formData.append('attachments[]', file);
        });

        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i data-lucide="loader-2" class="w-6 h-6 animate-spin"></i>';
        lucide.createIcons();

        fetch(`/api/conversations/${conversationId}/messages`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messageInput.value = '';
                clearAttachments();
                cancelReply();
                // Adiciona a nova mensagem diretamente em vez de recarregar tudo
                const newMessageElement = createMessageElement(data.data);
                messagesContainer.appendChild(newMessageElement);
                scrollToBottom();
                lucide.createIcons();
            } else {
                showError(data.message || 'Erro ao enviar mensagem');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showError('Erro ao enviar mensagem');
        })
        .finally(() => {
            sendBtn.innerHTML = '<i data-lucide="send" class="w-6 h-6"></i>';
            lucide.createIcons();
            handleMessageInput();
        });
    }

    // ✅ ALTERAÇÃO: Agora lida com múltiplos arquivos
    function handleFileSelect(e) {
        const newFiles = Array.from(e.target.files);
        selectedFiles = [...selectedFiles, ...newFiles];
        renderAttachmentPreviews();
        handleMessageInput(); // Atualiza o estado do botão
    }

    // ✅ ALTERAÇÃO: Renderiza o preview da imagem selecionada
    function renderAttachmentPreviews() {
        if (selectedFiles.length === 0) {
            attachmentsPreview.classList.add('hidden');
            return;
        }

        attachmentsPreview.classList.remove('hidden');
        attachmentsList.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const previewContainer = document.createElement('div');
            previewContainer.className = 'relative w-24 h-24';

            let previewElement;
            if (file.type.startsWith('image/')) {
                const imageURL = URL.createObjectURL(file);
                previewElement = document.createElement('img');
                previewElement.src = imageURL;
                previewElement.className = 'w-full h-full rounded-lg object-cover shadow-lg';
                previewElement.onload = () => URL.revokeObjectURL(imageURL); // Libera memória
            } else {
                // Para outros tipos de arquivo, mostra um ícone
                previewElement = document.createElement('div');
                previewElement.className = 'w-full h-full rounded-lg bg-gradient-to-br from-purple-200 to-pink-200 flex flex-col items-center justify-center p-2';
                previewElement.innerHTML = `
                    <i data-lucide="file" class="w-8 h-8 text-purple-600"></i>
                    <span class="text-xs text-purple-800 text-center truncate w-full mt-1">${file.name}</span>
                `;
            }
            
            const removeBtn = document.createElement('button');
            removeBtn.className = 'absolute -top-2 -right-2 p-1 bg-red-500 text-white rounded-full shadow-md hover:bg-red-600 transition-all';
            removeBtn.innerHTML = '<i data-lucide="x" class="w-4 h-4"></i>';
            removeBtn.onclick = () => {
                selectedFiles.splice(index, 1);
                renderAttachmentPreviews();
                handleMessageInput();
            };
            
            previewContainer.appendChild(previewElement);
            previewContainer.appendChild(removeBtn);
            attachmentsList.appendChild(previewContainer);
        });

        lucide.createIcons();
    }

    function clearAttachments() {
        selectedFiles = [];
        attachmentsPreview.classList.add('hidden');
        attachmentsList.innerHTML = '';
        fileInput.value = ''; // Limpa o input para permitir selecionar o mesmo arquivo novamente
    }

    function handleReplyToMessage(message) {
        replyToMessage = message;
        
        const replyUserName = document.getElementById('reply-user-name');
        const replyContent = document.getElementById('reply-content');
        
        replyUserName.textContent = message.user.name;
        replyContent.textContent = message.content || 'Anexo';
        
        replyPreview.classList.remove('hidden');
        messageInput.focus();
    }

    function cancelReply() {
        replyToMessage = null;
        replyPreview.classList.add('hidden');
    }

    function editMessage(message) {
        console.log('Editar mensagem:', message);
        alert('Funcionalidade de edição ainda não implementada.');
    }

    function deleteMessage(messageId) {
        if (!confirm('Tem certeza que deseja deletar esta mensagem?')) return;

        fetch(`/api/messages/${messageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const messageElement = messagesContainer.querySelector(`[data-message-id='${messageId}']`);
                if (messageElement) {
                    messageElement.remove();
                }
            } else {
                showError(data.message || 'Erro ao deletar mensagem');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showError('Erro ao deletar mensagem');
        });
    }

    function markMessagesAsRead() {
        fetch(`/api/conversations/${conversationId}/mark-read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
    }

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function formatTime(timestamp) {
        const date = new Date(timestamp);
        return date.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    function showError(message) {
        console.error(message);
        alert(message); // Substituir por um sistema de notificação mais elegante
    }

    function openImageModal(imageUrl) {
        window.open(imageUrl, '_blank');
    }

    lucide.createIcons();
});
</script>
@endpush


