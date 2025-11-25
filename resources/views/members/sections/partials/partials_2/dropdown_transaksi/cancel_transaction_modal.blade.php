{{-- Cancel Transaction Modal --}}
<div id="cancelTransactionModal-{{ $transaction->id }}" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[99999] flex items-center justify-center p-4" onclick="if(event.target === this) closeModal('cancelTransactionModal-{{ $transaction->id }}')">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all" onclick="event.stopPropagation();">
        {{-- Modal Header --}}
        <div class="bg-red-600 px-6 py-4 rounded-t-xl">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-white/20 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-white">Cancel Transaction</h3>
                    <p class="text-sm text-red-100">Are you sure you want to cancel this transaction?</p>
                </div>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="p-6 space-y-4">
            {{-- Transaction Details --}}
            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                <div>
                    <p class="text-xs text-gray-500 mb-1">Transaction ID</p>
                    <p class="font-mono font-bold text-gray-900">{{ $transaction->transaction_code }}</p>
                </div>
                
                <div class="border-t border-gray-200 pt-3 space-y-2">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Product</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $transaction->product->name_product }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-600">Amount</span>
                        <span class="text-sm font-bold text-gray-900">Rp {{ number_format($transaction->total_payment, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            {{-- Warning Message --}}
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <div class="flex gap-2">
                    <svg class="w-5 h-5 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div class="text-sm text-gray-700">
                        <p class="font-semibold mb-1">Please Note:</p>
                        <ul class="list-disc list-inside space-y-0.5 text-xs">
                            <li>This action cannot be undone</li>
                            <li>You will need to create a new order if you change your mind</li>
                            <li>Any uploaded payment proof will be discarded</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Cancellation Reason --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Reason for Cancellation <span class="text-gray-400">(Optional)</span>
                </label>
                <textarea id="cancelReason-{{ $transaction->id }}" 
                          rows="3" 
                          placeholder="Tell us why you're cancelling this transaction..."
                          class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent resize-none"></textarea>
                <p class="text-xs text-gray-500 mt-1">Your feedback helps us improve our service</p>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="border-t border-gray-200 px-6 py-4 flex items-center justify-end gap-3 bg-gray-50 rounded-b-xl">
            <button onclick="closeModal('cancelTransactionModal-{{ $transaction->id }}')" class="px-5 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors text-gray-700 font-medium text-sm">
                Keep Transaction
            </button>
            <button onclick="showConfirmCancelModal('{{ $transaction->id }}')" class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors font-medium text-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Yes, Cancel Transaction
            </button>
        </div>
    </div>
</div>

{{-- Confirmation Modal --}}
<div id="confirmCancelModal-{{ $transaction->id }}" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-[10000] flex items-center justify-center p-4" onclick="if(event.target === this) closeConfirmCancelModal('{{ $transaction->id }}')">
    <div class="bg-white rounded-xl shadow-2xl max-w-sm w-full transform transition-all" onclick="event.stopPropagation();">
        {{-- Modal Icon --}}
        <div class="pt-6 px-6 flex justify-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
        </div>

        {{-- Modal Content --}}
        <div class="p-6 text-center">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Are you absolutely sure?</h3>
            <p class="text-sm text-gray-600 mb-4">This will permanently cancel transaction <span class="font-mono font-semibold">{{ $transaction->transaction_code }}</span></p>
            
            <div id="cancelLoading-{{ $transaction->id }}" class="hidden mb-4">
                <div class="flex items-center justify-center gap-2 text-red-600">
                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-sm font-medium">Cancelling transaction...</span>
                </div>
            </div>

            <div id="cancelButtons-{{ $transaction->id }}" class="flex gap-3">
                <button onclick="closeConfirmCancelModal('{{ $transaction->id }}')" class="flex-1 px-4 py-2.5 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 font-medium text-sm">
                    No, Keep It
                </button>
                <button onclick="executeCancelTransaction('{{ $transaction->id }}')" class="flex-1 px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors font-medium text-sm">
                    Yes, Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function showConfirmCancelModal(transactionId) {
    document.getElementById('confirmCancelModal-' + transactionId).classList.remove('hidden');
}

function closeConfirmCancelModal(transactionId) {
    document.getElementById('confirmCancelModal-' + transactionId).classList.add('hidden');
}

function executeCancelTransaction(transactionId) {
    const reason = document.getElementById('cancelReason-' + transactionId).value;
    const loadingDiv = document.getElementById('cancelLoading-' + transactionId);
    const buttonsDiv = document.getElementById('cancelButtons-' + transactionId);
    
    // Show loading, hide buttons
    loadingDiv.classList.remove('hidden');
    buttonsDiv.classList.add('hidden');
    
    fetch('/members/transactions/' + transactionId + '/cancel', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ reason: reason })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close both modals
            closeConfirmCancelModal(transactionId);
            closeModal('cancelTransactionModal-' + transactionId);
            
            // Show success message with custom modal (you can create one) or just reload
            location.reload();
        } else {
            // Hide loading, show buttons
            loadingDiv.classList.add('hidden');
            buttonsDiv.classList.remove('hidden');
            
            alert('Failed to cancel transaction: ' + (data.message || 'Please try again.'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        
        // Hide loading, show buttons
        loadingDiv.classList.add('hidden');
        buttonsDiv.classList.remove('hidden');
        
        alert('An error occurred. Please try again.');
    });
}
</script>
