{{-- Modal Scripts for Transaction Dropdown Actions --}}
<style>
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes slideUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .modal-backdrop-fade {
        animation: fadeIn 0.4s ease-out;
    }

    .modal-slideup {
        animation: slideUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    /* Smooth scrollbar */
    .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
    // Open Modal Function
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        const navbar = document.querySelector('nav');
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (navbar) {
                navbar.style.zIndex = '0';
            }
        }
    }

    // Close Modal Function
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const navbar = document.querySelector('nav');
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            if (navbar) {
                navbar.style.zIndex = '50';
            }
        }
    }

    // Open Pay Now Modal
    function openPayNowModal(transactionId) {
        openModal('payNowModal-' + transactionId);
    }

    // Open Upload Proof Modal (from Pay Now modal)
    function openUploadProofModal(transactionId) {
        closeModal('payNowModal-' + transactionId);
        setTimeout(() => {
            openModal('uploadProofModal-' + transactionId);
        }, 300);
    }

    // Handle File Selection for Upload Proof
    function handleFileSelect(event, transactionId) {
        const file = event.target.files[0];
        if (!file) return;

        // Validate file size (5MB max)
        if (file.size > 5 * 1024 * 1024) {
            showInfoModal('error', 'File Terlalu Besar', 'Ukuran file maksimal 5MB. Silakan pilih file yang lebih kecil.');
            event.target.value = '';
            return;
        }

        // Validate file type
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!validTypes.includes(file.type)) {
            showInfoModal('error', 'Format File Tidak Valid', 'Hanya file gambar (JPG, PNG, JPEG) yang diperbolehkan.');
            event.target.value = '';
            return;
        }

        // Show preview
        const placeholder = document.getElementById('uploadPlaceholder-' + transactionId);
        const preview = document.getElementById('uploadPreview-' + transactionId);
        const previewImage = document.getElementById('previewImage-' + transactionId);
        const fileName = document.getElementById('previewFileName-' + transactionId);

        placeholder.classList.add('hidden');
        preview.classList.remove('hidden');

        // Load image preview
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.classList.remove('hidden');
        };
        reader.readAsDataURL(file);

        fileName.textContent = file.name;
    }

    // Submit Payment Proof
    function submitPaymentProof(transactionId) {
        const form = document.getElementById('uploadProofForm-' + transactionId);
        const fileInput = document.getElementById('paymentProofFile-' + transactionId);
        const senderName = document.getElementById('senderName-' + transactionId);

        // Validate file upload
        if (!fileInput.files[0]) {
            showInfoModal('warning', 'Bukti Pembayaran Kosong', 'Silakan upload bukti pembayaran terlebih dahulu.');
            return;
        }

        // Validate sender name
        if (!senderName.value.trim()) {
            showInfoModal('warning', 'Data Tidak Lengkap', 'Silakan masukkan nama pemilik rekening pengirim.');
            senderName.focus();
            return;
        }

        // Set current date and time automatically
        const now = new Date();
        const transferDate = now.toISOString().split('T')[0]; // YYYY-MM-DD
        const transferTime = now.toTimeString().split(' ')[0].substring(0, 5); // HH:MM

        document.getElementById('transferDate-' + transactionId).value = transferDate;
        document.getElementById('transferTime-' + transactionId).value = transferTime;

        const formData = new FormData(form);
        formData.append('payment_proof', fileInput.files[0]);
        formData.append('sender_name', senderName.value.trim());

        // Show loading state
        const submitBtn = event.target;
        const originalContent = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="animate-spin w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span class="ml-2">Uploading...</span>';

        // Submit form via AJAX
        fetch('/members/transactions/' + transactionId + '/upload-proof', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                closeModal('uploadProofModal-' + transactionId);
                showInfoModal('success', 'Upload Berhasil', 'Bukti pembayaran berhasil diupload! Silakan tunggu konfirmasi dari admin.');
                setTimeout(() => location.reload(), 2000);
            } else {
                showInfoModal('error', 'Upload Gagal', data.message || 'Gagal mengupload bukti pembayaran. Silakan coba lagi.');
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalContent;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showInfoModal('error', 'Terjadi Kesalahan', 'Terjadi kesalahan saat mengupload. Silakan coba lagi.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
        });
    }

    // Download Receipt Function
    function downloadReceipt(transactionId, format) {
        const url = '/member/transactions/' + transactionId + '/download-receipt?format=' + format;
        window.open(url, '_blank');
        
        // Show success message
        setTimeout(() => {
            alert('Receipt download started!');
        }, 500);
    }

    // Email Receipt Function
    function emailReceipt(transactionId) {
        if (confirm('Send receipt to your registered email?')) {
            fetch('/member/transactions/' + transactionId + '/email-receipt', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Receipt has been sent to your email!');
                } else {
                    alert('Failed to send receipt. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        }
    }

    // Cancel transaction functions are now in cancel_transaction_modal.blade.php


    // Copy to Clipboard Function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            showInfoModal('success', 'Berhasil Disalin', 'Nomor rekening berhasil disalin ke clipboard!');
        }).catch(err => {
            console.error('Failed to copy:', err);
            showInfoModal('error', 'Gagal Menyalin', 'Tidak dapat menyalin nomor rekening. Silakan salin manual.');
        });
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('[onclick^="toggleDropdown"]')) {
            document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });

    // Close modal on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modals = document.querySelectorAll('[id$="Modal"]');
            modals.forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    closeModal(modal.id);
                }
            });
        }
    });
</script>
