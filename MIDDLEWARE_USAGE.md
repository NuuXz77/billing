# Role Middleware - Panduan Penggunaan

Middleware ini digunakan untuk membedakan hak akses antara role **admin** dan **member**.

## Struktur Role di Database

Berdasarkan model `User`, ada 2 role:
- `admin` - Akses penuh ke halaman admin
- `member` - Akses terbatas untuk member biasa

## Cara Menggunakan Middleware

### 1. Proteksi Route untuk Admin Saja

```php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', ...);
    Route::get('/admin/users', ...);
    Route::get('/admin/settings', ...);
});
```

### 2. Proteksi Route untuk Member Saja

```php
Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('/member/dashboard', ...);
    Route::get('/member/profile', ...);
});
```

### 3. Route yang Bisa Diakses Admin DAN Member

```php
Route::middleware(['auth', 'role:admin,member'])->group(function () {
    Route::get('/shared/page', ...);
});
```

### 4. Proteksi Single Route

```php
Route::get('/admin/users', [UserController::class, 'index'])
    ->middleware(['auth', 'role:admin']);
```

## File yang Sudah Dikonfigurasi

### 1. Middleware (`app/Http/Middleware/RoleMidleware.php`)
- Mengecek apakah user sudah login
- Mengecek apakah role user sesuai dengan yang diizinkan
- Redirect ke login jika belum login
- Return 403 jika role tidak sesuai

### 2. Bootstrap (`bootstrap/app.php`)
- Middleware sudah di-register dengan alias `'role'`

### 3. Routes (`routes/admin.php`)
- Contoh implementasi route dengan middleware role
- Route admin hanya bisa diakses oleh user dengan role 'admin'
- Route member hanya bisa diakses oleh user dengan role 'member'

### 4. AuthController (`app/Http/Controllers/AuthController.php`)
- Fungsi login dengan redirect otomatis berdasarkan role
- Admin → `/admin`
- Member → `/member/dashboard`

## Testing

1. **Login sebagai Admin:**
   - Bisa akses: `/admin/*`
   - Tidak bisa akses: `/member/*` (403 Forbidden)

2. **Login sebagai Member:**
   - Bisa akses: `/member/*`
   - Tidak bisa akses: `/admin/*` (403 Forbidden)

3. **Belum Login:**
   - Redirect ke halaman login

## Error Messages

- **Belum login**: "Silakan login terlebih dahulu."
- **Role tidak sesuai**: 403 - "Anda tidak memiliki akses ke halaman ini."
