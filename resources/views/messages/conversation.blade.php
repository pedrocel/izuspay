@extends('layouts.mobile-app')

@section('title', 'Conversa - Lux Secrets')
@section('page-title', 'Conversa')
@section('page-subtitle', 'Chat')

@section('content')
<div class="flex flex-col h-full bg-white dark:bg-gray-800">
    <!-- Header da Conversa -->
    <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
        <div class="flex items-center space-x-3">
            <button onclick="history.back()" class="lg:hidden p-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-lg">
                <i data-lucide="arrow-left" class="w-5 h-5"></i>
            </button>
            
            <div class="w-10 h-10 bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 rounded-full flex items-center justify-center">
                <span id="conversation-avatar" class="text-sm font-semibold text-primary-600">C</span>
            </div>
            
            <div>
                <h3 id="conversation-title" class="text-sm font-medium text-gray-900 dark:text-white">Carregando...</h3>
                <p id="conversation-status" class="text-xs text-gray-500 dark:text-gray-400">Online</p>
            </div>
        </div>
        
        <div class="flex items-center space-x-2">
            <button id="conversation-info-btn" class="p-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-lg">
                <i data-lucide="info" class="w-5 h-5"></i>
            </button>
        </div>
    </div>

    <!-- Área de Mensagens -->
    <div class="flex-1 overflow-y-auto p-4 space-y-4" id="messages-container">
        <div class="text-center text-gray-500 dark:text-gray-400">
            <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                <i data-lucide="message-circle" class="w-6 h-6"></i>
            </div>
            <p>Carregando mensagens...</p>
        </div>
    </div>

    <!-- Área de Input -->
    <div class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4">
        <!-- Preview de Anexos -->
        <div id="attachments-preview" class="hidden mb-3">
            <div class="flex flex-wrap gap-2" id="attachments-list">
                <!-- Previews aparecerão aqui -->
            </div>
        </div>

        <!-- Resposta -->
        <div id="reply-preview" class="hidden mb-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg border-l-4 border-primary-500">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-xs text-primary-600 dark:text-primary-400 font-medium">Respondendo a <span id="reply-user-name"></span></p>
                    <p class="text-sm text-gray-600 dark:text-gray-300 truncate" id="reply-content"></p>
                </div>
                <button id="cancel-reply-btn" class="p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <!-- Input de Mensagem -->
        <div class="flex items-end space-x-3">
            <div class="flex space-x-2">
                <button id="attach-btn" class="p-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-lg transition-colors">
                    <i data-lucide="paperclip" class="w-5 h-5"></i>
                </button>
                <input type="file" id="file-input" multiple accept="image/*,video/*,.pdf,.doc,.docx" class="hidden">
            </div>
            
            <div class="flex-1 relative">
                <textarea 
                    id="message-input" 
                    placeholder="Digite sua mensagem..." 
                    rows="1"
                    class="w-full px-4 py-2 bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent resize-none max-h-32"
                ></textarea>
            </div>
            
            <button id="send-btn" class="p-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                <i data-lucide="send" class="w-5 h-5"></i>
            </button>
        </div>
    </div>
</div>

<!-- Template para Mensagem -->
<template id="message-template">
    <div class="message-item flex" data-message-id="">
        <div class="message-avatar w-8 h-8 bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
            <span class="text-xs font-semibold text-primary-600"></span>
        </div>
        <div class="flex-1 min-w-0">
            <div class="flex items-center space-x-2 mb-1">
                <span class="message-user-name text-sm font-medium text-gray-900 dark:text-white"></span>
                <span class="message-time text-xs text-gray-500 dark:text-gray-400"></span>
                <div class="message-actions hidden space-x-1">
                    <button class="reply-btn p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" title="Responder">
                        <i data-lucide="reply" class="w-3 h-3"></i>
                    </button>
                    <button class="edit-btn p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hidden" title="Editar">
                        <i data-lucide="edit-2" class="w-3 h-3"></i>
                    </button>
                    <button class="delete-btn p-1 text-gray-400 hover:text-red-500" title="Deletar">
                        <i data-lucide="trash-2" class="w-3 h-3"></i>
                    </button>
                </div>
            </div>
            
            <!-- Resposta -->
            <div class="message-reply hidden mb-2 p-2 bg-gray-50 dark:bg-gray-700 rounded border-l-2 border-gray-300 dark:border-gray-600">
                <p class="text-xs text-gray-500 dark:text-gray-400 font-medium"></p>
                <p class="text-sm text-gray-600 dark:text-gray-300 truncate"></p>
            </div>
            
            <!-- Conteúdo -->
            <div class="message-content">
                <p class="message-text text-sm text-gray-900 dark:text-white whitespace-pre-wrap"></p>
                <div class="message-attachments space-y-2 mt-2"></div>
            </div>
            
            <!-- Status de Edição -->
            <div class="message-edited hidden mt-1">
                <span class="text-xs text-gray-400 italic">editada</span>
            </div>
        </div>
    </div>
</template>

<!-- Template para Mensagem Própria -->
<template id="own-message-template">
    <div class="message-item flex justify-end" data-message-id="">
        <div class="flex-1 min-w-0 max-w-xs sm:max-w-md">
            <div class="flex items-center justify-end space-x-2 mb-1">
                <div class="message-actions hidden space-x-1">
                    <button class="reply-btn p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" title="Responder">
                        <i data-lucide="reply" class="w-3 h-3"></i>
                    </button>
                    <button class="edit-btn p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" title="Editar">
                        <i data-lucide="edit-2" class="w-3 h-3"></i>
                    </button>
                    <button class="delete-btn p-1 text-gray-400 hover:text-red-500" title="Deletar">
                        <i data-lucide="trash-2" class="w-3 h-3"></i>
                    </button>
                </div>
                <span class="message-time text-xs text-gray-500 dark:text-gray-400"></span>
            </div>
            
            <!-- Resposta -->
            <div class="message-reply hidden mb-2 p-2 bg-primary-50 dark:bg-primary-900/20 rounded border-l-2 border-primary-300 dark:border-primary-600">
                <p class="text-xs text-primary-600 dark:text-primary-400 font-medium"></p>
                <p class="text-sm text-primary-700 dark:text-primary-300 truncate"></p>
            </div>
            
            <!-- Conteúdo -->
            <div class="message-content bg-primary-600 text-white rounded-lg p-3">
                <p class="message-text text-sm whitespace-pre-wrap"></p>
                <div class="message-attachments space-y-2 mt-2"></div>
            </div>
            
            <!-- Status de Edição -->
            <div class="message-edited hidden mt-1 text-right">
                <span class="text-xs text-gray-400 italic">editada</span>
            </div>
        </div>
    </div>
</template>

<!-- Template para Preview de Anexo -->
<template id="attachment-preview-template">
    <div class="attachment-preview relative bg-gray-100 dark:bg-gray-700 rounded-lg p-2 flex items-center space-x-2">
        <div class="attachment-icon w-8 h-8 bg-primary-100 dark:bg-primary-900/20 rounded flex items-center justify-center">
            <i data-lucide="file" class="w-4 h-4 text-primary-600"></i>
        </div>
        <div class="flex-1 min-w-0">
            <p class="attachment-name text-sm font-medium text-gray-900 dark:text-white truncate"></p>
            <p class="attachment-size text-xs text-gray-500 dark:text-gray-400"></p>
        </div>
        <button class="remove-attachment p-1 text-gray-400 hover:text-red-500">
            <i data-lucide="x" class="w-4 h-4"></i>
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
    
    .message-item.own .message-content {
        background: linear-gradient(135deg, #ff00ff 0%, #621d62 100%);
    }
    
    .attachment-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        cursor: pointer;
    }
    
    .attachment-video {
        max-width: 300px;
        border-radius: 8px;
    }
    
    #messages-container {
        scroll-behavior: smooth;
    }
    
    /* Auto-resize textarea */
    #message-input {
        field-sizing: content;
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
                <div class="text-center text-gray-500 dark:text-gray-400">
                    <div class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-lucide="message-circle" class="w-6 h-6"></i>
                    </div>
                    <p>Nenhuma mensagem ainda</p>
                    <p class="text-sm">Seja o primeiro a enviar uma mensagem!</p>
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

    function createMessageElement(message) {
        const template = message.is_own ? 
            document.getElementById('own-message-template') : 
            document.getElementById('message-template');
        
        const clone = template.content.cloneNode(true);
        const messageItem = clone.querySelector('.message-item');
        
        messageItem.dataset.messageId = message.id;
        
        // Avatar (apenas para mensagens de outros)
        if (!message.is_own) {
            const avatar = clone.querySelector('.message-avatar span');
            avatar.textContent = message.user.name.charAt(0).toUpperCase();
            
            const userName = clone.querySelector('.message-user-name');
            userName.textContent = message.user.name;
        }
        
        // Tempo
        const time = clone.querySelector('.message-time');
        time.textContent = formatTime(message.created_at);
        
        // Resposta
        if (message.reply_to) {
            const replyDiv = clone.querySelector('.message-reply');
            const replyUser = replyDiv.querySelector('p:first-child');
            const replyContent = replyDiv.querySelector('p:last-child');
            
            replyDiv.classList.remove('hidden');
            replyUser.textContent = message.reply_to.user_name;
            replyContent.textContent = message.reply_to.content;
        }
        
        // Conteúdo
        const messageText = clone.querySelector('.message-text');
        messageText.textContent = message.content || '';
        
        // Anexos
        if (message.attachments && message.attachments.length > 0) {
            const attachmentsDiv = clone.querySelector('.message-attachments');
            message.attachments.forEach(attachment => {
                const attachmentElement = createAttachmentElement(attachment);
                attachmentsDiv.appendChild(attachmentElement);
            });
        }
        
        // Status de edição
        if (message.is_edited) {
            const editedDiv = clone.querySelector('.message-edited');
            editedDiv.classList.remove('hidden');
        }
        
        // Botões de ação
        const replyBtn = clone.querySelector('.reply-btn');
        const editBtn = clone.querySelector('.edit-btn');
        const deleteBtn = clone.querySelector('.delete-btn');
        
        replyBtn.addEventListener('click', () => replyToMessage(message));
        
        if (message.is_own) {
            if (message.type === 'text') {
                editBtn.classList.remove('hidden');
                editBtn.addEventListener('click', () => editMessage(message));
            }
            deleteBtn.addEventListener('click', () => deleteMessage(message));
        } else {
            editBtn.remove();
            deleteBtn.remove();
        }
        
        return clone;
    }

    function createAttachmentElement(attachment) {
        const div = document.createElement('div');
        
        if (attachment.type === 'image') {
            div.innerHTML = `
                <img src="${attachment.url}" 
                     alt="${attachment.name}" 
                     class="attachment-image"
                     onclick="openImageModal('${attachment.url}')">
            `;
        } else if (attachment.type === 'video') {
            div.innerHTML = `
                <video controls class="attachment-video">
                    <source src="${attachment.url}" type="video/mp4">
                    Seu navegador não suporta vídeos.
                </video>
            `;
        } else {
            div.innerHTML = `
                <a href="${attachment.url}" 
                   target="_blank" 
                   class="flex items-center space-x-2 p-2 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    <i data-lucide="file" class="w-4 h-4 text-gray-600 dark:text-gray-400"></i>
                    <span class="text-sm text-gray-900 dark:text-white">${attachment.name}</span>
                    <span class="text-xs text-gray-500 dark:text-gray-400">${attachment.size}</span>
                </a>
            `;
        }
        
        return div;
    }

    function handleMessageInput() {
        const hasContent = messageInput.value.trim().length > 0;
        const hasFiles = selectedFiles.length > 0;
        sendBtn.disabled = !hasContent && !hasFiles;
        
        // Auto-resize
        messageInput.style.height = 'auto';
        messageInput.style.height = Math.min(messageInput.scrollHeight, 128) + 'px';
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
        
        if (!content && selectedFiles.length === 0) return;

        const formData = new FormData();
        formData.append('content', content);
        
        if (replyToMessage) {
            formData.append('reply_to_id', replyToMessage.id);
        }
        
        selectedFiles.forEach(file => {
            formData.append('attachments[]', file);
        });

        sendBtn.disabled = true;
        sendBtn.innerHTML = '<i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i>';

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
                
                // Adiciona mensagem à lista
                messages.push(data.data);
                const messageElement = createMessageElement(data.data);
                messagesContainer.appendChild(messageElement);
                
                lucide.createIcons();
                scrollToBottom();
            } else {
                showError(data.message || 'Erro ao enviar mensagem');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showError('Erro ao enviar mensagem');
        })
        .finally(() => {
            sendBtn.disabled = false;
            sendBtn.innerHTML = '<i data-lucide="send" class="w-5 h-5"></i>';
            lucide.createIcons();
            handleMessageInput();
        });
    }

    function handleFileSelect(e) {
        const files = Array.from(e.target.files);
        
        files.forEach(file => {
            if (selectedFiles.length < 5) { // Máximo 5 arquivos
                selectedFiles.push(file);
            }
        });
        
        updateAttachmentsPreview();
        handleMessageInput();
        
        // Limpa o input para permitir selecionar o mesmo arquivo novamente
        fileInput.value = '';
    }

    function updateAttachmentsPreview() {
        if (selectedFiles.length === 0) {
            attachmentsPreview.classList.add('hidden');
            return;
        }

        attachmentsPreview.classList.remove('hidden');
        attachmentsList.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const template = document.getElementById('attachment-preview-template');
            const clone = template.content.cloneNode(true);
            
            const name = clone.querySelector('.attachment-name');
            const size = clone.querySelector('.attachment-size');
            const icon = clone.querySelector('.attachment-icon i');
            const removeBtn = clone.querySelector('.remove-attachment');
            
            name.textContent = file.name;
            size.textContent = formatFileSize(file.size);
            
            // Ícone baseado no tipo
            if (file.type.startsWith('image/')) {
                icon.setAttribute('data-lucide', 'image');
            } else if (file.type.startsWith('video/')) {
                icon.setAttribute('data-lucide', 'video');
            } else {
                icon.setAttribute('data-lucide', 'file');
            }
            
            removeBtn.addEventListener('click', () => removeAttachment(index));
            
            attachmentsList.appendChild(clone);
        });

        lucide.createIcons();
    }

    function removeAttachment(index) {
        selectedFiles.splice(index, 1);
        updateAttachmentsPreview();
        handleMessageInput();
    }

    function clearAttachments() {
        selectedFiles = [];
        updateAttachmentsPreview();
    }

    function replyToMessage(message) {
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

    function markMessagesAsRead() {
        const unreadMessages = messages.filter(m => !m.is_read && !m.is_own);
        
        if (unreadMessages.length === 0) return;

        fetch(`/api/conversations/${conversationId}/messages/mark-read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .catch(error => {
            console.error('Erro ao marcar como lida:', error);
        });
    }

    function scrollToBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    function formatTime(dateString) {
        const date = new Date(dateString);
        return date.toLocaleTimeString('pt-BR', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
    }

    function formatFileSize(bytes) {
        const units = ['B', 'KB', 'MB', 'GB'];
        let size = bytes;
        let unitIndex = 0;
        
        while (size >= 1024 && unitIndex < units.length - 1) {
            size /= 1024;
            unitIndex++;
        }
        
        return `${size.toFixed(1)} ${units[unitIndex]}`;
    }

    function showError(message) {
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

