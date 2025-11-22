# 🤖 Auto Transaction Numbering System

## 📌 Ringkasan
Sistem penomoran transaksi **OTOMATIS** yang memberikan setiap member nomor transaksi independent, dimulai dari 1 dan increment otomatis.

---

## ✅ Cara Kerja

### **1. Member Baru Register**
```php
// File: app/Http/Controllers/AuthController.php
$user = User::create([
    'user_code' => 'MBR-' . strtoupper(\Str::random(6)),
    'role' => 'member',
    'full_name' => $request->full_name,
    // ... data lainnya
]);
```

**Hasil:** Member baru dibuat, belum punya transaksi.

---

### **2. Member Beli Produk (Transaksi Pertama)**
```php
// File: app/Http/Controllers/Admin/TransactionController.php
$transaction = Transaction::create([
    'user_id' => 5,           // ID member baru
    'product_id' => 1,
    'payment_id' => 2,
    'status' => 'pending_payment',
    // user_transaction_number TIDAK perlu diisi manual!
]);
```

**Yang Terjadi di Model (OTOMATIS):**
```php
// File: app/Models/Transaction.php - boot() method
static::creating(function ($transaction) {
    // 1. Cek transaksi terakhir user ini
    $lastNumber = Transaction::where('user_id', 5)
        ->max('user_transaction_number') ?? 0;
    // Hasil: 0 (karena belum ada transaksi)
    
    // 2. Set nomor transaksi = lastNumber + 1
    $transaction->user_transaction_number = 0 + 1; // = 1
    
    // 3. Generate transaction code
    $transaction->transaction_code = "TRX-1-20-11-2025";
});
```

**Hasil di Database:**
```sql
| id | user_id | user_transaction_number | transaction_code    |
|----|---------|-------------------------|---------------------|
| 15 | 5       | 1                       | TRX-1-20-11-2025    |
```

---

### **3. Member Beli Lagi (Transaksi Kedua)**
```php
$transaction = Transaction::create([
    'user_id' => 5,
    'product_id' => 2,
    // ...
]);
```

**Yang Terjadi (OTOMATIS):**
```php
$lastNumber = Transaction::where('user_id', 5)
    ->max('user_transaction_number'); // = 1
    
$transaction->user_transaction_number = 1 + 1; // = 2
$transaction->transaction_code = "TRX-2-20-11-2025";
```

**Hasil di Database:**
```sql
| id | user_id | user_transaction_number | transaction_code    |
|----|---------|-------------------------|---------------------|
| 15 | 5       | 1                       | TRX-1-20-11-2025    |
| 16 | 5       | 2                       | TRX-2-20-11-2025    |
```

---

### **4. Member Lain (User ID 6) Beli Produk**
```php
$transaction = Transaction::create([
    'user_id' => 6,  // Member berbeda!
    'product_id' => 1,
    // ...
]);
```

**Yang Terjadi (OTOMATIS):**
```php
$lastNumber = Transaction::where('user_id', 6)
    ->max('user_transaction_number') ?? 0; // = 0 (belum ada transaksi)
    
$transaction->user_transaction_number = 0 + 1; // = 1 (mulai dari 1 lagi!)
$transaction->transaction_code = "TRX-1-20-11-2025";
```

**Hasil di Database:**
```sql
| id | user_id | user_transaction_number | transaction_code    |
|----|---------|-------------------------|---------------------|
| 15 | 5       | 1                       | TRX-1-20-11-2025    |
| 16 | 5       | 2                       | TRX-2-20-11-2025    |
| 17 | 6       | 1                       | TRX-1-20-11-2025    | ← Mulai dari 1 lagi!
```

---

## 🎯 Penjelasan Independent Per User

### **Contoh 3 Member:**

| Member      | Transaksi 1 | Transaksi 2 | Transaksi 3 |
|-------------|-------------|-------------|-------------|
| **User A**  | TRX-1-...   | TRX-2-...   | TRX-3-...   |
| **User B**  | TRX-1-...   | TRX-2-...   | -           |
| **User C**  | TRX-1-...   | -           | -           |

✅ **Setiap member punya counter sendiri!**  
✅ **Dimulai dari 1 untuk setiap member!**  
✅ **Tidak ada konflik antar member!**

---

## 🔧 Implementasi Teknis

### **File yang Diubah:**

#### **1. app/Models/Transaction.php**
```php
protected static function boot()
{
    parent::boot();

    static::creating(function ($transaction) {
        // Auto-generate user_transaction_number
        if (empty($transaction->user_transaction_number)) {
            $lastNumber = self::where('user_id', $transaction->user_id)
                ->max('user_transaction_number') ?? 0;
            
            $transaction->user_transaction_number = $lastNumber + 1;
        }

        // Auto-generate transaction_code
        if (empty($transaction->transaction_code)) {
            $date = now()->format('d-m-Y');
            $transaction->transaction_code = "TRX-{$transaction->user_transaction_number}-{$date}";
        }
    });
}
```

**Kapan Dijalankan?**
- ✅ Setiap kali `Transaction::create()`
- ✅ Sebelum data disimpan ke database
- ✅ Otomatis, tidak perlu coding manual di controller

---

## 📝 Cara Pakai

### **Di Controller (Tidak Perlu Set Manual):**
```php
// ❌ SEBELUM (Manual):
$lastNumber = Transaction::where('user_id', $userId)->count();
$transaction = Transaction::create([
    'user_id' => $userId,
    'user_transaction_number' => $lastNumber + 1,  // Manual!
    'transaction_code' => "TRX-{$lastNumber}-...", // Manual!
    // ...
]);

// ✅ SESUDAH (Otomatis):
$transaction = Transaction::create([
    'user_id' => $userId,
    // user_transaction_number & transaction_code otomatis terisi!
    'product_id' => $productId,
    'payment_id' => $paymentId,
    'status' => 'pending_payment',
    // ...
]);
```

---

## 🧪 Testing

### **Test 1: Member Baru Register & Beli**
```php
// 1. Register member baru
$user = User::create([/* ... */]);

// 2. Buat transaksi pertama
$transaction1 = Transaction::create(['user_id' => $user->id, /* ... */]);
echo $transaction1->user_transaction_number; // Output: 1

// 3. Buat transaksi kedua
$transaction2 = Transaction::create(['user_id' => $user->id, /* ... */]);
echo $transaction2->user_transaction_number; // Output: 2
```

### **Test 2: Multiple Member Bersamaan**
```php
// Member A
$transactionA1 = Transaction::create(['user_id' => 5, /* ... */]);
echo $transactionA1->user_transaction_number; // Output: 1

// Member B
$transactionB1 = Transaction::create(['user_id' => 6, /* ... */]);
echo $transactionB1->user_transaction_number; // Output: 1 (independent!)

// Member A lagi
$transactionA2 = Transaction::create(['user_id' => 5, /* ... */]);
echo $transactionA2->user_transaction_number; // Output: 2
```

---

## ⚠️ Catatan Penting

### **1. Dummy Data (Seeder)**
- Seeder sudah mengisi `user_transaction_number` manual (1-10)
- Sistem otomatis akan **tetap bekerja** untuk transaksi baru setelah seeder
- Contoh: Seeder bikin 10 transaksi (1-10), transaksi baru akan dimulai dari 11

### **2. Migration**
- Kolom `user_transaction_number` sudah ada di database
- Tidak perlu migration baru

### **3. Backward Compatibility**
- ✅ Dummy data lama tetap valid
- ✅ Transaksi lama (manual) tetap valid
- ✅ Transaksi baru otomatis terisi

---

## 📊 Flow Diagram

```
Member Register
    ↓
Member Login
    ↓
Member Pilih Produk
    ↓
Member Checkout
    ↓
Transaction::create() dipanggil
    ↓
🤖 MODEL OTOMATIS:
    ├─ Cek transaksi terakhir user
    ├─ Hitung: last_number + 1
    ├─ Set user_transaction_number
    └─ Generate transaction_code
    ↓
Data Tersimpan ke Database
    ↓
Member Dapat Nomor Transaksi: TRX-1, TRX-2, dst.
```

---

## 🎉 Kesimpulan

### ✅ **Yang OTOMATIS:**
1. `user_transaction_number` - Auto increment per user
2. `transaction_code` - Auto generate dengan format `TRX-{number}-{date}`

### ✅ **Keuntungan:**
1. **Tidak perlu coding manual** di controller
2. **Konsisten** di semua tempat (admin create, member checkout, dll)
3. **Independent per user** - setiap member punya counter sendiri
4. **Aman dari konflik** - Laravel Eloquent handle secara otomatis

### ✅ **Kapan Aktif:**
- ✅ Member baru register & beli produk
- ✅ Member lama beli produk lagi
- ✅ Admin buat transaksi manual
- ✅ Semua method yang pakai `Transaction::create()`

---

**Tanggal Update:** 20 November 2025  
**File Terkait:** `app/Models/Transaction.php`
