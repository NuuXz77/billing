{{-- Chat History Section Modals --}}

<!-- Rename Modal -->
<div id="renameModal" class="modal-overlay">
    <div class="modal-content" style="max-width: 400px;">
        <div class="modal-header">
            <div class="modal-title">
                <i class="fas fa-edit"></i>
                <span>Rename Chat</span>
            </div>
            <button class="modal-close" onclick="closeRenameModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label" for="chatTitleInput">
                    <i class="fas fa-heading mr-2"></i>
                    Chat Title
                </label>
                <input 
                    type="text" 
                    id="chatTitleInput" 
                    class="form-input" 
                    placeholder="Enter new chat title..."
                >
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" onclick="closeRenameModal()" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                Cancel
            </button>
            <button type="button" onclick="confirmRename()" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Save
            </button>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content" style="max-width: 400px;">
        <div class="modal-header">
            <div class="modal-title">
                <i class="fas fa-trash"></i>
                <span>Delete Chat</span>
            </div>
            <button class="modal-close" onclick="closeDeleteModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <p style="color: #374151; margin-bottom: 12px; font-size: 14px;">
                Are you sure you want to delete this chat?
            </p>
            <p id="deleteChatTitle" style="color: #6b7280; font-size: 13px; font-weight: 500;"></p>
            <p style="color: #ef4444; font-size: 12px; margin-top: 12px;">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                This action cannot be undone.
            </p>
        </div>

        <div class="modal-footer">
            <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                Cancel
            </button>
            <button type="button" onclick="confirmDelete()" class="btn btn-danger">
                <i class="fas fa-trash"></i>
                Delete
            </button>
        </div>
    </div>
</div>

<style>
/* Modal Styles - Light Theme */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 10000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.modal-overlay.show {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    width: 90%;
    max-width: 500px;
    overflow: hidden;
    transform: scale(0.9) translateY(20px);
    transition: all 0.3s ease;
}

.modal-overlay.show .modal-content {
    transform: scale(1) translateY(0);
}

.modal-header {
    background: #f9fafb;
    padding: 16px 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.modal-title {
    font-size: 16px;
    font-weight: 600;
    color: #111827;
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-close {
    background: none;
    border: none;
    color: #6b7280;
    font-size: 20px;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.modal-close:hover {
    background: #e5e7eb;
    color: #111827;
}

.modal-body {
    padding: 20px;
}

.form-group {
    margin-bottom: 0;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #374151;
    font-size: 13px;
}

.form-input {
    width: 100%;
    padding: 10px 12px;
    background: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    color: #111827;
    font-size: 14px;
    transition: all 0.2s ease;
}

.form-input:focus {
    outline: none;
    border-color: #374151;
    box-shadow: 0 0 0 3px rgba(55, 65, 81, 0.1);
}

.modal-footer {
    padding: 12px 20px;
    border-top: 1px solid #e5e7eb;
    background: #f9fafb;
    display: flex;
    gap: 8px;
    justify-content: flex-end;
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-primary {
    background: #374151;
    color: #ffffff;
}

.btn-primary:hover {
    background: #1f2937;
    transform: translateY(-1px);
}

.btn-secondary {
    background: #e5e7eb;
    color: #374151;
}

.btn-secondary:hover {
    background: #d1d5db;
}

.btn-danger {
    background: #ef4444;
    color: #ffffff;
}

.btn-danger:hover {
    background: #dc2626;
    transform: translateY(-1px);
}
</style>

<script>
// Global variables for modal management
let currentEditChatId = null;

// Open rename modal
window.openRenameModal = function(chatId, currentTitle) {
    currentEditChatId = chatId;
    const modal = document.getElementById('renameModal');
    const input = document.getElementById('chatTitleInput');
    
    if (!modal || !input) return;
    
    input.value = currentTitle;
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
    
    // Focus and select input
    setTimeout(() => {
        input.focus();
        input.select();
    }, 100);
};

// Close rename modal
window.closeRenameModal = function() {
    const modal = document.getElementById('renameModal');
    if (!modal) return;
    
    modal.classList.remove('show');
    document.body.style.overflow = 'auto';
    currentEditChatId = null;
};

// Confirm rename
window.confirmRename = function() {
    const input = document.getElementById('chatTitleInput');
    if (!input) return;
    
    const newTitle = input.value.trim();
    
    if (!newTitle) {
        alert('Chat title cannot be empty!');
        return;
    }
    
    if (currentEditChatId) {
        const chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
        const chat = chatHistory.find(c => c.id == currentEditChatId);
        
        if (chat) {
            chat.title = newTitle;
            localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
            
            // Force update UI immediately
            if (typeof window.updateChatHistoryUI === 'function') {
                window.updateChatHistoryUI();
            } else if (typeof updateChatHistoryUI === 'function') {
                updateChatHistoryUI();
            }
            
            // If this chat is currently loaded, update the display
            const currentChatId = localStorage.getItem('currentChatId');
            if (currentChatId == currentEditChatId) {
                // Could update page title or other elements here if needed
                console.log('Renamed current active chat to:', newTitle);
            }
        }
    }
    
    closeRenameModal();
};

// Open delete modal
window.openDeleteModal = function(chatId, chatTitle) {
    currentEditChatId = chatId;
    const modal = document.getElementById('deleteModal');
    const titleElement = document.getElementById('deleteChatTitle');
    
    if (!modal || !titleElement) return;
    
    titleElement.textContent = `"${chatTitle}"`;
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
};

// Close delete modal
window.closeDeleteModal = function() {
    const modal = document.getElementById('deleteModal');
    if (!modal) return;
    
    modal.classList.remove('show');
    document.body.style.overflow = 'auto';
    currentEditChatId = null;
};

// Confirm delete
window.confirmDelete = function() {
    if (!currentEditChatId) return;
    
    let chatHistory = JSON.parse(localStorage.getItem('chatHistory') || '[]');
    chatHistory = chatHistory.filter(c => c.id != currentEditChatId);
    localStorage.setItem('chatHistory', JSON.stringify(chatHistory));
    
    // Check if deleted chat was active
    const currentChatId = localStorage.getItem('currentChatId');
    if (currentChatId == currentEditChatId) {
        localStorage.removeItem('currentChatId');
        
        // Clear conversation if function exists
        if (typeof window.clearConversationHistory === 'function') {
            window.clearConversationHistory();
        }
        
        // Clear chat messages
        const chatMessages = document.getElementById('chat-messages');
        if (chatMessages) {
            const welcomeMsg = chatMessages.querySelector('.animate-fade-in');
            chatMessages.innerHTML = '';
            if (welcomeMsg) {
                chatMessages.appendChild(welcomeMsg.cloneNode(true));
            }
        }
    }
    
    // Force update UI immediately
    if (typeof window.updateChatHistoryUI === 'function') {
        window.updateChatHistoryUI();
    } else if (typeof updateChatHistoryUI === 'function') {
        updateChatHistoryUI();
    }
    
    closeDeleteModal();
};

// Close modals when clicking outside
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        if (e.target.id === 'renameModal') {
            closeRenameModal();
        } else if (e.target.id === 'deleteModal') {
            closeDeleteModal();
        }
    }
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // ESC to close modals
    if (e.key === 'Escape') {
        closeRenameModal();
        closeDeleteModal();
    }
    
    // Enter to confirm in rename modal
    if (e.key === 'Enter') {
        const renameModal = document.getElementById('renameModal');
        if (renameModal && renameModal.classList.contains('show')) {
            e.preventDefault();
            confirmRename();
        }
    }
});
</script>
