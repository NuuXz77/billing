# Custom Pagination Components dengan SPA Navigation

Komponen pagination kustom yang telah dibuat untuk aplikasi billing ini terdiri dari 3 jenis yang dapat digunakan sesuai kebutuhan. Semua komponen sudah terintegrasi dengan **Livewire `wire:navigate`** untuk memberikan pengalaman Single Page Application (SPA) yang smooth.

## 🚀 **SPA Navigation Features:**
✅ **Navigasi Instant** - Perpindahan halaman tanpa reload  
✅ **Preserves State** - State aplikasi tetap terjaga  
✅ **Smooth Transitions** - Animasi transisi yang halus  
✅ **Browser History** - Back/forward button bekerja sempurna  
✅ **Performance Boost** - Loading lebih cepat karena hanya update konten

## 1. Custom Pagination (`x-pagination.custom`)

**File:** `resources/views/components/pagination/custom.blade.php`

Pagination lengkap dengan informasi data dan navigasi yang fleksibel.

### Props:
- `paginator` (required): Object paginator dari Laravel
- `showingText` (optional, default: true): Tampilkan info "Menampilkan X dari Y"
- `showingFormat` (optional): Format teks info dengan placeholder {from}, {to}, {total}
- `previousText` (optional, default: "Sebelumnya"): Teks tombol previous
- `nextText` (optional, default: "Selanjutnya"): Teks tombol next
- `size` (optional, default: "default"): Ukuran tombol (sm, default, lg)

### Contoh Penggunaan:
```blade
<x-pagination.custom 
    :paginator="$users" 
    :showingText="true" 
    showingFormat="Menampilkan {from} - {to} dari {total} pengguna"
    previousText="Sebelumnya"
    nextText="Selanjutnya"
    size="default" />
```

## 2. Simple Pagination (`x-pagination.simple`)

**File:** `resources/views/components/pagination/simple.blade.php`

Pagination sederhana dengan tombol join untuk tampilan yang lebih compact.

### Props:
- `paginator` (required): Object paginator dari Laravel
- `simple` (optional, default: false): Mode simple hanya tampilkan current/total page
- `size` (optional, default: "default"): Ukuran tombol (sm, default, lg)

### Contoh Penggunaan:
```blade
{{-- Mode Normal --}}
<x-pagination.simple :paginator="$data" size="sm" />

{{-- Mode Simple --}}
<x-pagination.simple :paginator="$data" :simple="true" size="default" />
```

## 3. Advanced Pagination (`x-pagination.advanced`)

**File:** `resources/views/components/pagination/advanced.blade.php`

Pagination advanced dengan dropdown page jumper dan navigasi ke halaman pertama/terakhir.

### Props:
- `paginator` (required): Object paginator dari Laravel
- `showingText` (optional, default: true): Tampilkan info "Menampilkan X dari Y"
- `showPageJumper` (optional, default: true): Tampilkan dropdown untuk loncat ke halaman tertentu
- `size` (optional, default: "default"): Ukuran tombol (sm, default, lg)

### Contoh Penggunaan:
```blade
<x-pagination.advanced 
    :paginator="$data" 
    :showingText="true" 
    :showPageJumper="true" 
    size="lg" />
```

## Features

### 1. Responsive Design
- Mobile-first approach
- Otomatis menyesuaikan layout untuk layar kecil
- Button text tersembunyi di mobile untuk menghemat ruang

### 2. DaisyUI Integration
- Menggunakan komponen DaisyUI (btn, join, dropdown)
- Consistent styling dengan theme aplikasi
- Dark mode support

### 3. Livewire Integration
- Wire actions: `previousPage`, `nextPage`, `gotoPage(x)`
- SPA navigation dengan `wire:navigate` untuk pengalaman seperti Single Page Application
- Loading indicators
- Disabled state saat loading

### 4. Customizable
- Ukuran tombol dapat disesuaikan (sm, default, lg)
- Teks dapat dikustomisasi
- Format info dapat diubah

## Wire Actions Required

Pastikan Livewire component memiliki methods berikut untuk mendukung SPA navigation:

```php
// Method untuk navigasi halaman dengan wire:navigate
public function previousPage()
{
    $this->resetPage();
    // Logic untuk previous page
    // wire:navigate akan menangani URL update otomatis
}

public function nextPage()
{
    $this->resetPage();
    // Logic untuk next page  
    // wire:navigate akan menangani URL update otomatis
}

public function gotoPage($page)
{
    $this->resetPage();
    // Logic untuk goto specific page
    // wire:navigate akan menangani URL update otomatis
}

// Optional: Method untuk update URL parameters
public function updatedPage()
{
    // Dipanggil otomatis saat page berubah
    $this->resetPage();
}
```

## SPA Navigation Benefits

### ⚡ Performance
- **Faster Loading**: Hanya update konten yang diperlukan
- **Reduced Bandwidth**: Tidak reload seluruh halaman
- **Memory Efficient**: JavaScript state tetap terjaga

### 🎨 User Experience  
- **Smooth Transitions**: Tidak ada white screen saat navigasi
- **Instant Feedback**: Loading indicators yang responsive
- **Natural Navigation**: Browser back/forward button bekerja normal

### 🔧 Developer Experience
- **Simple Implementation**: Hanya tambah `wire:navigate`
- **Automatic URL Updates**: Livewire handle URL sync otomatis
- **State Preservation**: Component state tetap konsisten

## Styling Notes

- Menggunakan Tailwind CSS classes
- DaisyUI component classes (btn, join, dropdown, dll)
- Consistent color scheme dengan aplikasi
- Hover effects dan transitions

## Migration dari Laravel Default

Untuk mengganti pagination default Laravel:

**Sebelum:**
```blade
{{ $users->links() }}
```

**Sesudah:**
```blade
<x-pagination.custom :paginator="$users" />
```

## Best Practices

1. **Gunakan Custom** untuk halaman utama dengan data banyak
2. **Gunakan Simple** untuk modal atau sidebar dengan data sedikit  
3. **Gunakan Advanced** untuk dashboard atau halaman analitik
4. Selalu test responsiveness di berbagai ukuran layar
5. Pastikan wire actions sudah diimplementasi dengan benar

## Example Implementations

### Users Index (Current)
```blade
<x-pagination.custom 
    :paginator="$users" 
    showingFormat="Menampilkan {from} - {to} dari {total} pengguna" />
```

### Reports Index
```blade
<x-pagination.advanced 
    :paginator="$reports" 
    showingFormat="Menampilkan {from} - {to} dari {total} laporan"
    :showPageJumper="true" />
```

### Modal Data Selection
```blade
<x-pagination.simple 
    :paginator="$items" 
    :simple="true" 
    size="sm" />
```