{{-- Sidebar Chat History --}}
<div id="chat-sidebar" class="sidebar" style="top: 64px; height: calc(100vh - 64px); background: #ffffff;">
    
    {{-- Sidebar Header --}}
    <div class="sidebar-header">
        <h1 class="sidebar-title">Hoci Assistant</h1>
        <button class="new-chat-btn" id="new-chat-btn">
            <i class="fas fa-plus"></i>
            Chat Baru
        </button>
    </div>

    {{-- Sidebar Content --}}
    <div class="sidebar-content">

        {{-- Search Bar --}}
        <div class="sidebar-section">
            <div class="search-container">
                <i class="fas fa-search search-icon"></i>
                <input 
                    type="text" 
                    id="search-chat" 
                    placeholder="Cari percakapan..." 
                    class="search-input"
                >
            </div>
        </div>

        {{-- Chat History Section --}}
        <div class="sidebar-section">
            <div class="sidebar-section-title">Chat History</div>
            <div id="today-chats"></div>
        </div>
    </div>

    {{-- Sidebar Footer --}}
    <div class="sidebar-footer">
        <div>Hoci Assistant v1.0</div>
    </div>
</div>

{{-- Sidebar Toggle Button (Mobile) --}}
<button 
    id="sidebar-toggle" 
    class="sidebar-toggle-btn"
>
    <i class="fas fa-bars"></i>
</button>

<style>
/* Sidebar Styles */
.sidebar {
    width: 260px;
    background: #ffffff;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 1000;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
}

.sidebar-header {
    padding: 12px 16px;
    border-bottom: 1px solid #e5e7eb;
    background: #ffffff;
}

.sidebar-title {
    color: #111827;
    font-size: 18px;
    font-weight: 700;
    margin: 0 0 12px 0;
    text-align: center;
}

.new-chat-btn {
    width: 100%;
    background: #374151;
    border: none;
    color: #ffffff;
    padding: 10px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.new-chat-btn:hover {
    background: #4b5563;
    transform: translateY(-1px);
}

.sidebar-content {
    flex: 1;
    overflow-y: auto;
    padding: 12px;
    background: #ffffff;
}

.sidebar-section {
    margin-bottom: 20px;
}

.sidebar-section-title {
    font-size: 11px;
    color: #6b7280;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    padding-left: 4px;
}

.sidebar-footer {
    padding: 16px;
    border-top: 1px solid #e5e7eb;
    text-align: center;
    font-size: 11px;
    color: #6b7280;
    background: #ffffff;
}

.footer-info {
    margin-top: 4px;
    font-size: 10px;
}

.footer-count {
    font-weight: 600;
}

/* Navigation Menu Styles */
.nav-menu {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 16px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    color: #6b7280;
    text-decoration: none;
    border-radius: 6px;
    font-size: 13px;
    transition: all 0.2s ease;
    cursor: pointer;
}

.nav-item:hover {
    background: #f3f4f6;
    color: #111827;
}

.nav-item.active {
    background: #374151;
    color: #ffffff;
    font-weight: 500;
}

.nav-item i {
    font-size: 12px;
    width: 16px;
    text-align: center;
}

/* Search Styles */
.search-container {
    position: relative;
    margin-bottom: 8px;
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    font-size: 12px;
}

.search-input {
    width: 100%;
    padding: 8px 12px 8px 36px;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    color: #111827;
    font-size: 13px;
    outline: none;
    transition: all 0.2s ease;
}

.search-input::placeholder {
    color: #9ca3af;
}

.search-input:focus {
    background: #ffffff;
    border-color: #9ca3af;
    box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.1);
}

/* Chat History List */
.chat-history-list {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

/* Chat Item Styles */
.chat-item {
    padding: 10px 12px;
    margin-bottom: 6px;
    border-radius: 8px;
    cursor: pointer;
    color: #6b7280;
    font-size: 13px;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    position: relative;
}

.chat-item:hover {
    background: #374151;
    color: #ffffff;
}

.chat-item:hover .chat-actions {
    opacity: 1;
    visibility: visible;
}

.chat-item.active {
    background: #374151;
    color: #ffffff;
}

.chat-item i {
    font-size: 12px;
    flex-shrink: 0;
}

.chat-item-text {
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.chat-actions {
    position: absolute;
    right: 8px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.2s ease;
    z-index: 10;
}

.chat-menu-btn {
    background: none;
    border: none;
    color: #9ca3af;
    cursor: pointer;
    padding: 4px 6px;
    border-radius: 4px;
    font-size: 12px;
    transition: all 0.2s ease;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
}

.chat-item:hover .chat-menu-btn {
    color: #ffffff;
}

.chat-menu-btn:hover {
    background: rgba(255, 255, 255, 0.15);
    color: #ffffff;
}

.chat-menu-dropdown {
    position: fixed;
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    z-index: 9999;
    min-width: 120px;
    display: none;
    overflow: hidden;
}

.chat-menu-dropdown.show {
    display: block;
}

.chat-menu-item {
    padding: 8px 12px;
    color: #374151;
    cursor: pointer;
    font-size: 12px;
    transition: background-color 0.2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
}

.chat-menu-item:hover {
    background: #f3f4f6;
}

.chat-menu-item.delete:hover {
    background: #ef4444;
    color: #ffffff;
}

/* Sidebar Toggle Button */
.sidebar-toggle-btn {
    position: fixed;
    left: 16px;
    top: 96px;
    z-index: 1001;
    background: #374151;
    border: 1px solid #4b5563;
    color: #ffffff;
    padding: 10px 12px;
    border-radius: 8px;
    cursor: pointer;
    display: none;
    transition: all 0.2s ease;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.sidebar-toggle-btn:hover {
    background: #4b5563;
    transform: translateY(-1px);
}

/* Custom scrollbar */
.sidebar-content::-webkit-scrollbar,
.chat-history-list::-webkit-scrollbar {
    width: 6px;
}

.sidebar-content::-webkit-scrollbar-track,
.chat-history-list::-webkit-scrollbar-track {
    background: #f9fafb;
}

.sidebar-content::-webkit-scrollbar-thumb,
.chat-history-list::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
}

.sidebar-content::-webkit-scrollbar-thumb:hover,
.chat-history-list::-webkit-scrollbar-thumb:hover {
    background: #9ca3af;
}

/* Responsive */
@media (max-width: 1024px) {
    .sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }

    .sidebar.show {
        transform: translateX(0);
    }

    .sidebar-toggle-btn {
        display: block;
    }
    
    /* Adjust chat window on mobile */
    #live-chat > div[style*="margin-left"] {
        margin-left: 0 !important;
    }
    
    /* Adjust input and footer on mobile */
    #live-chat [style*="left: 260px"] {
        left: 0 !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar toggle for mobile
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const chatSidebar = document.getElementById('chat-sidebar');
    
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            chatSidebar.classList.toggle('show');
        });
    }

    // Chat item click
    const chatItems = document.querySelectorAll('.chat-item');
    chatItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active from all items
            chatItems.forEach(i => i.classList.remove('active'));
            // Add active to clicked item
            this.classList.add('active');
            
            // Hide sidebar on mobile after selection
            if (window.innerWidth < 1024) {
                chatSidebar.classList.remove('show');
            }
            
            // TODO: Load chat history for this chat ID
            const chatId = this.dataset.chatId;
            console.log('Loading chat:', chatId);
        });
    });

    // Search functionality
    const searchInput = document.getElementById('search-chat');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            chatItems.forEach(item => {
                const title = item.querySelector('h3').textContent.toLowerCase();
                const preview = item.querySelector('p').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || preview.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }

    // New chat button
    const newChatBtn = document.getElementById('new-chat-btn');
    if (newChatBtn) {
        newChatBtn.addEventListener('click', function() {
            // Remove active from all items
            chatItems.forEach(i => i.classList.remove('active'));
            
            // Clear current chat and start new conversation
            console.log('Starting new chat...');
            
            // Clear localStorage current chat
            localStorage.removeItem('currentChatId');
            
            // Clear chat messages (except welcome message)
            const chatMessages = document.getElementById('chat-messages');
            if (chatMessages) {
                const welcomeMsg = chatMessages.querySelector('.animate-fade-in');
                chatMessages.innerHTML = '';
                if (welcomeMsg) {
                    chatMessages.appendChild(welcomeMsg.cloneNode(true));
                }
            }
            
            // Clear conversation history (from parent scope if available)
            if (typeof window.clearConversationHistory === 'function') {
                window.clearConversationHistory();
            }
        });
    }
});
</script>
