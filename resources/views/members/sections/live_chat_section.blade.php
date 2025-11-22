{{-- Live Chat Section --}}
<section id="live-chat" class="fixed inset-0 bg-gray-50 flex" style="padding-top: 80px;">
    
    {{-- Include Sidebar --}}
    @include('members.sections.partials.sidebar_chat_section')
    
    {{-- Chat Window --}}
    <div class="flex-1 flex flex-col" style="margin-left: 260px;">
        {{-- Chat Area --}}
        <div class="flex-1 overflow-y-auto px-6 py-4" id="chat-messages" style="padding-bottom: 200px;">
            <div class="max-w-7xl mx-auto">
            {{-- Welcome Message --}}
            <div class="flex items-center gap-3 animate-fade-in mb-4">
                <img src="{{ asset('img/logo/Hoci_Logo.svg') }}" alt="Hoci" class="w-8 h-8 flex-shrink-0 drop-shadow-md">
                <div class="flex flex-col gap-1 max-w-[85%]">
                    <div class="bg-white border border-gray-200 rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm">
                        <p class="font-semibold text-gray-900 mb-1 text-sm">Halo! 👋</p>
                        <p class="text-gray-700 text-sm">Saya <strong>HociAI</strong>, asisten virtual yang siap membantu.</p>
                        <p class="text-gray-600 text-sm mt-2">Ada yang bisa saya bantu hari ini?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Input Area --}}
    <div class="fixed bottom-[32px] z-40 bg-white border-t border-gray-200 px-6 py-4" style="left: 260px; right: 0;">
        <div class="container mx-auto max-w-7xl">
            <form id="chat-form" class="flex items-center gap-3">
                <div class="flex-1 relative">
                    <textarea 
                        id="chat-input" 
                        rows="1"
                        placeholder="Ketik pesan Anda..."
                        maxlength="250"
                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-2xl focus:border-gray-400 focus:outline-none transition-all resize-none overflow-hidden text-sm text-gray-700"
                        style="min-height: 44px; max-height: 120px;"
                        autocomplete="off"
                    ></textarea>
                </div>
                <button 
                    type="submit" 
                    id="send-button"
                    class="w-11 h-11 bg-gray-700 hover:bg-gray-800 text-white rounded-full flex items-center justify-center transition-all disabled:opacity-50 disabled:cursor-not-allowed flex-shrink-0 mb-1"
                    disabled
                >
                    <span id="send-icon" class="text-base leading-none">➤</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Footer --}}
    <div class="fixed bottom-0 z-30 bg-gray-50 border-t border-gray-200 px-6 py-2" style="left: 260px; right: 0;">
        <div class="container mx-auto max-w-7xl text-center text-[10px] text-gray-500 select-none">
            Powered by Hosting Ciamis <a href="#" class="underline hover:text-gray-600">AI Terms</a>.
        </div>
    </div>
    </div>
</section>

<!-- Info Modal for Empty Message -->
<div id="infoModal" class="hidden fixed inset-0 bg-gradient-to-br from-black/40 to-black/60 flex items-center justify-center z-[99999] backdrop-blur-sm" onclick="if(event.target === this) { closeInfoModal(); }">
  <div class="bg-white rounded-2xl shadow-2xl max-w-sm mx-4 overflow-hidden" onclick="event.stopPropagation();">
    
    <!-- Header dengan icon -->
    <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-center">
      <div class="bg-red-100 p-3 rounded-full">
        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
      </div>
      <div class="ml-3">
        <h3 class="text-base font-bold text-gray-900">Pesan Kosong</h3>
      </div>
    </div>

    <!-- Body -->
    <div class="px-8 py-6">
      <p class="text-sm text-gray-600 leading-relaxed mb-4">
        Silakan ketik pesan Anda terlebih dahulu sebelum mengirim.
      </p>
      
      <!-- Tips box -->
      <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
        <p class="text-xs text-gray-700 font-medium">Tip: Tanyakan tentang layanan hosting, VPS, domain, atau informasi lainnya.</p>
      </div>
    </div>

    <!-- Footer dengan button -->
    <div class="px-8 py-4 bg-white border-t border-gray-100 flex gap-3">
      <button 
        type="button" 
        class="flex-1 bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-semibold cursor-pointer transition-all duration-300 hover:bg-blue-700 hover:shadow-lg active:scale-95 focus:outline-none focus:ring-2 focus:ring-blue-400" 
        onclick="closeInfoModal();">
        Mengerti
      </button>
    </div>
  </div>
</div>

<!-- Include Modal Informasi Teks Kosong -->
@include('frontend.sections.partials.modalinformasitextkosong')

{{-- Include Chat History Modals (Rename & Delete) --}}
@include('members.sections.partials.ditlet_history_chat_section')

{{-- JavaScript for Chat Functionality --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Clear chat history on page load (since no auth/database yet)
    localStorage.removeItem('chatHistory');
    localStorage.removeItem('currentChatId');
    
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');
    const chatMessages = document.getElementById('chat-messages');
    
    // Store conversation history
    let conversationHistory = [];

    // Auto-grow textarea
    chatInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 120) + 'px';
        
        // Enable/disable send button
        sendButton.disabled = this.value.trim() === '';
    });

    // Handle Enter key
    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            if (this.value.trim() !== '') {
                chatForm.dispatchEvent(new Event('submit'));
            } else {
                // Show modal if empty
                const infoModal = document.getElementById('infoModal');
                if (infoModal) {
                    infoModal.classList.remove('hidden');
                }
            }
        }
    });

    // Handle form submission
    chatForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const message = chatInput.value.trim();
        
        // Check if message is empty - show modal
        if (!message) {
            const infoModal = document.getElementById('infoModal');
            if (infoModal) {
                infoModal.classList.remove('hidden');
            }
            return;
        }

        // Disable input while processing
        chatInput.disabled = true;
        sendButton.disabled = true;
        
        // Change send button icon to loading spinner
        const sendIcon = document.getElementById('send-icon');
        sendIcon.textContent = '⟳';
        sendIcon.classList.add('animate-spin-btn');

        // Add user message
        addUserMessage(message);
        
        // Save to chat history (first message creates new chat)
        if (conversationHistory.length === 0) {
            saveChatToHistory(message);
        }
        
        // Add to conversation history
        conversationHistory.push({
            role: 'user',
            content: message
        });
        
        // Clear input
        chatInput.value = '';
        chatInput.style.height = 'auto';

        // Show typing indicator
        showTypingIndicator();

        try {
            // Send to backend API
            const response = await fetch('/api/chatbot/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    message: message,
                    conversation_history: conversationHistory.slice(-10) // Keep last 10 messages
                })
            });

            const data = await response.json();

            // Hide typing indicator
            hideTypingIndicator();

            if (data.success) {
                addBotMessage(data.message);
                
                // Add to conversation history
                conversationHistory.push({
                    role: 'assistant',
                    content: data.message
                });
                
                // Update current chat
                updateCurrentChat();
            } else {
                addBotMessage('⚠️ Maaf, terjadi kesalahan. Silakan coba lagi.');
                console.error('API Error:', data.error);
            }

        } catch (error) {
            console.error('Fetch Error:', error);
            hideTypingIndicator();
            addBotMessage('⚠️ Koneksi bermasalah. Pastikan API sudah dikonfigurasi dengan benar.');
        } finally {
            // Re-enable input
            chatInput.disabled = false;
            sendButton.disabled = false;
            sendIcon.textContent = '➤';
            sendIcon.classList.remove('animate-spin-btn');
            chatInput.focus();
        }
    });

    function addUserMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-center gap-3 justify-end animate-fade-in mb-4';
        messageDiv.innerHTML = `
            <div class="bg-gray-700 text-white rounded-2xl rounded-tr-sm px-4 py-3 shadow-sm max-w-[75%] break-words" style="width: fit-content; margin-left: auto;">
                <p class="leading-relaxed text-sm">${escapeHtml(message)}</p>
            </div>
            <div class="w-10 h-10 bg-gradient-to-br from-gray-600 to-gray-800 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                U
            </div>
        `;
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }

    function addBotMessage(message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = 'flex items-center gap-3 animate-fade-in mb-4';
        
        // Format message with line breaks
        const formattedMessage = message.replace(/\n/g, '<br>');
        
        messageDiv.innerHTML = `
            <img src="{{ asset('img/logo/Hoci_Logo.svg') }}" alt="AI" class="w-8 h-8 flex-shrink-0 drop-shadow-md">
            <div class="bg-white border border-gray-300 rounded-2xl rounded-tl-sm px-4 py-3 shadow-sm max-w-[85%] break-words">
                <p class="text-gray-900 leading-relaxed text-sm">${formattedMessage}</p>
            </div>
        `;
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }

    function showTypingIndicator() {
        const thinking = document.createElement('div');
        thinking.className = 'flex items-center gap-3 py-2 mb-4';
        thinking.id = 'typing-indicator';
        thinking.innerHTML = `
            <img src="{{ asset('img/logo/Hoci_Logo.svg') }}" alt="AI" class="w-8 h-8 flex-shrink-0 drop-shadow-md">
            <div class="flex items-center gap-2 px-4 py-3 bg-white border border-gray-200 rounded-2xl rounded-tl-sm shadow-sm">
                <span class="text-xs text-gray-500 italic mr-2">AI sedang memproses</span>
                <div class="flex gap-1">
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                </div>
            </div>
        `;
        chatMessages.appendChild(thinking);
        scrollToBottom();
    }

    function hideTypingIndicator() {
        const indicator = document.getElementById('typing-indicator');
        if (indicator) {
            indicator.remove();
        }
    }

    function scrollToBottom() {
        const chatBox = document.getElementById('chat-messages');
        if (chatBox) {
            // Multiple attempts to ensure scroll happens after render
            chatBox.scrollTop = chatBox.scrollHeight;
            
            requestAnimationFrame(() => {
                chatBox.scrollTop = chatBox.scrollHeight;
            });
            
            setTimeout(() => {
                chatBox.scrollTop = chatBox.scrollHeight;
            }, 50);
            
            setTimeout(() => {
                chatBox.scrollTop = chatBox.scrollHeight;
            }, 100);
        }
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Save chat to history
    function saveChatToHistory(firstMessage) {
        const chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
        const now = new Date();
        
        const newChat = {
            id: Date.now(),
            title: firstMessage.length > 40 ? firstMessage.substring(0, 40) + '...' : firstMessage,
            timestamp: now.toISOString(),
            messages: conversationHistory
        };
        
        chatHistory.unshift(newChat);
        localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
        localStorage.setItem('currentChatId', newChat.id);
        
        // Update sidebar
        updateChatHistoryUI();
    }

    // Update chat history UI
    window.updateChatHistoryUI = function() {
        const chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
        const todayChats = document.getElementById('today-chats');
        const currentChatId = localStorage.getItem('currentChatId');
        
        console.log('updateChatHistoryUI called, chat count:', chatHistory.length);
        
        if (!todayChats) {
            console.log('todayChats element not found!');
            return;
        }
        
        todayChats.innerHTML = '';
        
        if (chatHistory.length === 0) {
            console.log('No chat history found');
            todayChats.innerHTML = '<div style="padding: 8px 12px; color: #9ca3af; font-size: 12px;">Tidak ada percakapan</div>';
            return;
        }
        
        chatHistory.forEach(chat => {
            const chatItem = document.createElement('div');
            chatItem.className = 'chat-item';
            if (chat.id == currentChatId) {
                chatItem.classList.add('active');
            }
            chatItem.dataset.chatId = chat.id;
            
            chatItem.innerHTML = `
                <i class="fas fa-message"></i>
                <span class="chat-item-text">${escapeHtml(chat.title)}</span>
                <div class="chat-actions">
                    <button class="chat-menu-btn" data-chat-id="${chat.id}">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="chat-menu-dropdown" id="chat-menu-${chat.id}">
                        <button class="chat-menu-item" data-action="rename" data-chat-id="${chat.id}">
                            <i class="fas fa-edit"></i>
                            Rename
                        </button>
                        <button class="chat-menu-item delete" data-action="delete" data-chat-id="${chat.id}">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </div>
                </div>
            `;
            
            // Click handler to load chat (but not when clicking actions)
            chatItem.addEventListener('click', function(e) {
                if (!e.target.closest('.chat-actions')) {
                    loadChat(chat);
                }
            });
            
            // Menu button click handler
            const menuBtn = chatItem.querySelector('.chat-menu-btn');
            if (menuBtn) {
                menuBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Menu button clicked, chat ID:', chat.id);
                    toggleChatMenu(chat.id);
                });
            }
            
            // Menu items click handler
            const menuItems = chatItem.querySelectorAll('.chat-menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const action = item.dataset.action;
                    const chatId = item.dataset.chatId;
                    
                    console.log('Menu item clicked:', action, 'for chat:', chatId);
                    
                    if (action === 'rename') {
                        renameChat(chatId);
                    } else if (action === 'delete') {
                        deleteChat(chatId);
                    }
                    
                    // Close dropdown
                    const dropdown = document.getElementById(`chat-menu-${chatId}`);
                    if (dropdown) dropdown.classList.remove('show');
                });
            });
            
            todayChats.appendChild(chatItem);
        });
    }

    // Load specific chat
    function loadChat(chat) {
        // Clear current messages
        const welcomeMsg = chatMessages.querySelector('.animate-fade-in');
        chatMessages.innerHTML = '';
        if (welcomeMsg) {
            chatMessages.appendChild(welcomeMsg);
        }
        
        // Set as current chat
        localStorage.setItem('currentChatId', chat.id);
        conversationHistory = chat.messages || [];
        
        // Render messages
        conversationHistory.forEach(msg => {
            if (msg.role === 'user') {
                addUserMessage(msg.content);
            } else if (msg.role === 'assistant') {
                addBotMessage(msg.content);
            }
        });
        
        // Update UI
        updateChatHistoryUI();
    }

    // Format time helper
    function formatTime(date) {
        const now = new Date();
        const diff = now - date;
        const minutes = Math.floor(diff / 60000);
        const hours = Math.floor(diff / 3600000);
        const days = Math.floor(diff / 86400000);
        
        if (minutes < 1) return 'Baru saja';
        if (minutes < 60) return `${minutes} menit lalu`;
        if (hours < 24) return `${hours} jam lalu`;
        if (days === 1) return 'Kemarin';
        if (days < 7) return `${days} hari lalu`;
        return `${Math.floor(days / 7)} minggu lalu`;
    }

    // Update current chat in localStorage
    function updateCurrentChat() {
        const currentChatId = localStorage.getItem('currentChatId');
        if (!currentChatId) return;
        
        const chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
        const chatIndex = chatHistory.findIndex(c => c.id == currentChatId);
        
        if (chatIndex !== -1) {
            chatHistory[chatIndex].messages = conversationHistory;
            localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
        }
    }

    // Load chat history on page load
    updateChatHistoryUI();
    
    // Toggle chat menu dropdown
    function toggleChatMenu(chatId) {
        console.log('toggleChatMenu called for:', chatId);
        
        const dropdown = document.getElementById(`chat-menu-${chatId}`);
        if (!dropdown) {
            console.log('Dropdown not found for chat ID:', chatId);
            return;
        }
        
        console.log('Dropdown found, current show status:', dropdown.classList.contains('show'));
        
        // Close all other dropdowns
        document.querySelectorAll('.chat-menu-dropdown').forEach(menu => {
            if (menu.id !== `chat-menu-${chatId}`) {
                menu.classList.remove('show');
            }
        });
        
        // Calculate position for fixed positioning
        if (!dropdown.classList.contains('show')) {
            const menuBtn = document.querySelector(`.chat-menu-btn[data-chat-id="${chatId}"]`);
            if (menuBtn) {
                const btnRect = menuBtn.getBoundingClientRect();
                const dropdownWidth = 120;
                
                let topPos = btnRect.bottom + 4;
                let leftPos = btnRect.right - dropdownWidth;
                
                // Adjust if dropdown would go off-screen
                if (leftPos < 10) leftPos = btnRect.left;
                if (topPos + 100 > window.innerHeight) topPos = btnRect.top - 100;
                
                dropdown.style.top = topPos + 'px';
                dropdown.style.left = leftPos + 'px';
            }
        }
        
        dropdown.classList.toggle('show');
    }
    
    // Rename chat
    function renameChat(chatId) {
        console.log('renameChat called for:', chatId);
        
        const chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
        const chat = chatHistory.find(c => c.id == chatId);
        if (!chat) {
            console.log('Chat not found in history:', chatId);
            return;
        }
        
        console.log('Chat found:', chat.title);
        
        // Open modal instead of prompt
        if (typeof window.openRenameModal === 'function') {
            console.log('Opening rename modal...');
            window.openRenameModal(chatId, chat.title);
        } else {
            console.log('Modal not available, using prompt fallback');
            // Fallback to prompt if modal not available
            const newTitle = prompt('Rename chat:', chat.title);
            if (newTitle && newTitle.trim() !== '') {
                chat.title = newTitle.trim();
                localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
                updateChatHistoryUI();
            }
        }
        
        // Close dropdown
        const dropdown = document.getElementById(`chat-menu-${chatId}`);
        if (dropdown) dropdown.classList.remove('show');
    }
    
    // Delete chat
    function deleteChat(chatId) {
        const chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
        const chat = chatHistory.find(c => c.id == chatId);
        if (!chat) return;
        
        // Open modal instead of confirm
        if (typeof window.openDeleteModal === 'function') {
            window.openDeleteModal(chatId, chat.title);
        } else {
            // Fallback to confirm if modal not available
            if (!confirm('Hapus percakapan ini?')) return;
            
            let chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
            chatHistory = chatHistory.filter(c => c.id != chatId);
            localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
            
            // If this was the current chat, clear it
            const currentChatId = localStorage.getItem('currentChatId');
            if (currentChatId == chatId) {
                localStorage.removeItem('currentChatId');
                conversationHistory = [];
                
                // Clear chat messages (except welcome message)
                const welcomeMsg = chatMessages.querySelector('.animate-fade-in');
                chatMessages.innerHTML = '';
                if (welcomeMsg) {
                    chatMessages.appendChild(welcomeMsg.cloneNode(true));
                }
            }
            
            updateChatHistoryUI();
        }
        
        // Close dropdown
        const dropdown = document.getElementById(`chat-menu-${chatId}`);
        if (dropdown) dropdown.classList.remove('show');
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.chat-actions')) {
            document.querySelectorAll('.chat-menu-dropdown').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
    
    // Global function to clear conversation
    window.clearConversationHistory = function() {
        conversationHistory = [];
        updateChatHistoryUI();
    };

    // Initial scroll to bottom
    scrollToBottom();
});

// Close Info Modal
function closeInfoModal() {
    const infoModal = document.getElementById('infoModal');
    if (infoModal) {
        infoModal.classList.add('hidden');
    }
}
</script>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-4px);
    }
}

.animate-bounce {
    animation: bounce 0.6s ease-in-out infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.animate-spin-btn {
    animation: spin 1s linear infinite;
}

/* Smooth scroll behavior */
#chat-messages {
    scroll-behavior: smooth;
}

/* Custom scrollbar for chat area */
#chat-messages::-webkit-scrollbar {
    width: 6px;
}

#chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
}

#chat-messages::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

#chat-messages::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>
