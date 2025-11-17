<!--- Modal Chatbot Component -->
<style>
    .chat-fade-in {
      animation: fadeInUp 0.3s ease-out forwards;
    }

    .chat-fade-out {
      animation: fadeOutDown 0.3s ease-out forwards;
    }

    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeOutDown {
      0% { opacity: 1; transform: translateY(0); }
      100% { opacity: 0; transform: translateY(20px); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    @keyframes blink-dots {
      0%, 20% { content: '.'; }
      40% { content: '..'; }
      60%, 100% { content: '...'; }
    }

    .animate-spin-btn {
      animation: spin 1s linear infinite;
    }

    .thinking-dots::after {
      content: '.';
      animation: blink-dots 1.5s steps(4, end) infinite;
    }

    /* Smooth scroll behavior */
    #chatMessages {
      scroll-behavior: smooth;
    }

    .quick-question-box.clicked {
      opacity: 0;
      transform: scale(0.8);
      pointer-events: none;
      transition: all 0.3s ease;
    }
  </style>

  <!-- Include Modal Informasi Teks Kosong -->
  @include('frontend.sections.partials.modalinformasitextkosong')

  <!-- Chatbot Modal -->
  <div id="chatbotModal" class="hidden fixed bottom-8 right-8 w-[400px] h-[520px] bg-gray-100 rounded-xl shadow-2xl flex flex-col overflow-hidden border border-gray-300 z-50 chat-fade-in">

    <!-- Header -->
    <div class="bg-gray-700 text-white flex items-center justify-between px-4 py-3">
      <div class="flex items-center">
        <img src="{{ asset('img/logo/Hoci_Logo.svg') }}" class="w-9 h-9 rounded-full border-2 border-white mr-3" alt="Hoci Logo">
        <span class="font-semibold text-base">HociAI</span>
      </div>
      <button onclick="closeChatModal()" class="text-xl hover:text-gray-300 transition">&times;</button>
    </div>

    <!-- Body -->
    <div id="chatMessages" class="flex-1 overflow-y-auto px-4 py-3 space-y-3 text-sm text-gray-800">
      <!-- Initial greeting -->
      <div class="bg-white border border-gray-300 p-3 rounded-md max-w-[85%] break-words shadow-sm">
        <div class="flex items-start gap-2">
          <i class="fas fa-robot text-gray-600 mt-1"></i>
          <div>
            <p class="font-semibold text-gray-800 mb-1">Halo! 👋</p>
            <p class="text-gray-700 text-xs">Saya <strong>HociAI</strong>, asisten virtual yang siap membantu kamu.</p>
            <p class="text-gray-600 text-xs mt-2">Ada yang bisa saya bantu hari ini?</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Input Area -->
    <form id="chatForm" class="px-4 py-3 border-t bg-gray-50 flex items-center space-x-2" onsubmit="event.preventDefault(); sendMessage();">
      <input id="chatInput" type="text" placeholder="Ketik pesan Anda..." maxlength="250"
        class="flex-grow max-w-[calc(100%-50px)] px-3 py-2 border-0 rounded-md text-sm bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 transition" autocomplete="off" />
      <button id="sendBtn" type="submit" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded-md text-sm transition flex items-center justify-center">
        <span id="sendIcon">➤</span>
      </button>
    </form>

    <!-- Footer -->
    <div class="text-center px-4 py-2 bg-gray-50 text-[10px] text-gray-500 select-none">
      Powered by Hosting Ciamis <a href="#" class="underline hover:text-gray-600">AI Terms</a>.
    </div>
  </div>
  <script>
    // Open Chat Modal
    function openChatModal() {
      const modal = document.getElementById('chatbotModal');
      const chatButton = document.getElementById('chatButton');
      
      modal.classList.remove('hidden', 'chat-fade-out');
      modal.classList.add('chat-fade-in');
      
      if (chatButton) {
        chatButton.style.opacity = '0';
        chatButton.style.pointerEvents = 'none';
        setTimeout(() => {
          chatButton.classList.add('hidden');
        }, 300);
      }
      
      document.getElementById('chatInput').focus();
    }

    // Close Chat Modal
    function closeChatModal() {
      const modal = document.getElementById('chatbotModal');
      const chatButton = document.getElementById('chatButton');
      
      modal.classList.remove('chat-fade-in');
      modal.classList.add('chat-fade-out');
      
      if (chatButton) {
        chatButton.classList.remove('hidden');
        chatButton.style.opacity = '0';
        chatButton.style.pointerEvents = 'auto';
        
        chatButton.offsetHeight;
        
        setTimeout(() => {
          chatButton.style.transition = 'opacity 0.3s ease-out';
          chatButton.style.opacity = '1';
        }, 10);
      }
      
      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('chat-fade-out');
      }, 300);
    }

    // Smooth scroll to bottom
    function scrollToBottom() {
      const chatBox = document.getElementById('chatMessages');
      chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Store conversation history
    let conversationHistory = [];

    // Send Message
    async function sendMessage() {
      const input = document.getElementById('chatInput');
      const message = input.value.trim();
      
      // Check if message is empty
      if (!message) {
        const infoModal = document.getElementById('infoModal');
        if (infoModal) {
          infoModal.classList.remove('hidden');
        }
        return;
      }

      // Check if user wants to close chat (detect keywords)
      const closeKeywords = ['close', 'tutup', 'keluar', 'exit', 'bye', 'selesai', 'cukup', 'stop', 'sudah', 'oke cukup', 'udah ah'];
      const messageLower = message.toLowerCase();
      
      // Flag to auto-close after AI responds
      const shouldAutoClose = closeKeywords.some(keyword => messageLower.includes(keyword));

      const chatBox = document.getElementById('chatMessages');
      const sendBtn = document.getElementById('sendBtn');
      const sendIcon = document.getElementById('sendIcon');

      input.disabled = true;
      sendBtn.disabled = true;
      sendIcon.textContent = '⟳';
      sendIcon.classList.add('animate-spin-btn');

      // User message
      const userMsg = document.createElement('div');
      userMsg.className = 'bg-gray-700 text-white p-3 rounded-lg self-end break-words ml-auto max-w-xs';
      userMsg.style.width = 'fit-content';
      userMsg.textContent = message;
      chatBox.appendChild(userMsg);

      // Add to conversation history
      conversationHistory.push({
        role: 'user',
        content: message
      });

      input.value = '';
      scrollToBottom();

      // Thinking animation
      const thinking = document.createElement('div');
      thinking.className = 'text-xs text-gray-500 italic thinking-dots';
      thinking.textContent = 'HociAI sedang memproses';
      thinking.id = 'thinking';
      chatBox.appendChild(thinking);
      scrollToBottom();

      try {
        // Send to OpenAI API via Laravel backend
        const response = await fetch('/api/chatbot/send', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
          },
          body: JSON.stringify({
            message: message,
            conversation_history: conversationHistory.slice(-10) // Keep last 10 messages for context
          })
        });

        const data = await response.json();

        // Remove thinking animation
        const thinkingNode = document.getElementById('thinking');
        if (thinkingNode) thinkingNode.remove();

        // Display AI response
        const botReply = document.createElement('div');
        botReply.className = 'bg-white border border-gray-300 p-3 rounded-md max-w-[85%] break-words';
        
        if (data.success) {
          botReply.innerHTML = data.message.replace(/\n/g, '<br>');
          
          // Add to conversation history
          conversationHistory.push({
            role: 'assistant',
            content: data.message
          });
        } else {
          botReply.innerHTML = '<span class="text-red-600">⚠️ Maaf, terjadi kesalahan. Silakan coba lagi.</span>';
          console.error('API Error:', data.error);
        }

        chatBox.appendChild(botReply);
        scrollToBottom();
        
        // Auto-close modal after 3 seconds if user said goodbye
        if (shouldAutoClose) {
          setTimeout(() => {
            closeChatModal();
          }, 3000);
        }

      } catch (error) {
        console.error('Fetch Error:', error);
        
        const thinkingNode = document.getElementById('thinking');
        if (thinkingNode) thinkingNode.remove();

        const errorMsg = document.createElement('div');
        errorMsg.className = 'bg-red-50 border border-red-300 p-3 rounded-md max-w-[85%] break-words';
        errorMsg.innerHTML = '<span class="text-red-600">⚠️ Koneksi bermasalah. Pastikan API OpenAI sudah dikonfigurasi dengan benar.</span>';
        chatBox.appendChild(errorMsg);
        scrollToBottom();
      } finally {
        input.disabled = false;
        sendBtn.disabled = false;
        sendIcon.textContent = '➤';
        sendIcon.classList.remove('animate-spin-btn');
        input.focus();
      }
    }
  </script>
