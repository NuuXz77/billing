@props([
    'paginator',
    'showingText' => true,
    'showPageJumper' => true,
    'size' => 'default'
])

@php
    $sizeClasses = [
        'sm' => 'btn-sm text-xs',
        'default' => 'btn-md text-sm',
        'lg' => 'btn-lg text-base'
    ];
    $btnClass = $sizeClasses[$size] ?? $sizeClasses['default'];
@endphp

<div class="flex flex-col sm:flex-row justify-between items-center gap-4">
    {{-- Showing Info with Page Jumper --}}
    <div class="flex flex-col sm:flex-row items-center gap-4 order-2 sm:order-1">
        @if($showingText && $paginator->total() > 0)
            <div class="text-sm text-base-content/60">
                Menampilkan 
                <span class="font-semibold">{{ $paginator->firstItem() ?? 0 }}</span> - 
                <span class="font-semibold">{{ $paginator->lastItem() ?? 0 }}</span> dari 
                <span class="font-semibold">{{ $paginator->total() }}</span> data
            </div>
        @endif

        @if($showPageJumper && $paginator->hasPages())
            <div class="flex items-center gap-2">
                <span class="text-sm text-base-content/60">Halaman:</span>
                <div class="dropdown dropdown-top sm:dropdown-bottom">
                    <div tabindex="0" role="button" class="btn {{ $btnClass }} btn-ghost">
                        {{ $paginator->currentPage() }}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu rounded-box z-50 w-32 max-h-48 overflow-y-auto p-2 shadow-xl bg-base-100 border border-base-300">
                        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
                            <li>
                                <button wire:click="gotoPage({{ $page }})" 
                                        class="text-left {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                                    Halaman {{ $page }}
                                </button>
                            </li>
                        @endfor
                    </ul>
                </div>
                <span class="text-sm text-base-content/60">dari {{ $paginator->lastPage() }}</span>
            </div>
        @endif
    </div>

    {{-- Navigation Buttons --}}
    @if ($paginator->hasPages())
        <div class="flex items-center gap-1 order-1 sm:order-2">
            {{-- First Page --}}
            @if($paginator->currentPage() > 3)
                <button wire:click="gotoPage(1)" wire:navigate class="btn {{ $btnClass }} btn-ghost hover:btn-primary" title="Halaman Pertama">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                    </svg>
                </button>
            @endif

            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <span class="btn {{ $btnClass }} btn-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="hidden sm:inline">Sebelumnya</span>
                </span>
            @else
                <button wire:click="previousPage" wire:navigate class="btn {{ $btnClass }} btn-ghost hover:btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="hidden sm:inline">Sebelumnya</span>
                </button>
            @endif

            {{-- Page Numbers --}}
            <div class="hidden sm:flex items-center gap-1">
                @php
                    $start = max(1, $paginator->currentPage() - 1);
                    $end = min($paginator->lastPage(), $paginator->currentPage() + 1);
                @endphp

                @for ($page = $start; $page <= $end; $page++)
                    @if ($page == $paginator->currentPage())
                        <span class="btn {{ $btnClass }} btn-primary">
                            {{ $page }}
                        </span>
                    @else
                        <button wire:click="gotoPage({{ $page }})" wire:navigate class="btn {{ $btnClass }} btn-ghost hover:btn-primary">
                            {{ $page }}
                        </button>
                    @endif
                @endfor
            </div>

            {{-- Current Page Indicator (Mobile) --}}
            <div class="sm:hidden">
                <span class="btn {{ $btnClass }} btn-ghost cursor-default">
                    {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
                </span>
            </div>

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:navigate class="btn {{ $btnClass }} btn-ghost hover:btn-primary">
                    <span class="hidden sm:inline">Selanjutnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @else
                <span class="btn {{ $btnClass }} btn-disabled">
                    <span class="hidden sm:inline">Selanjutnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif

            {{-- Last Page --}}
            @if($paginator->currentPage() < $paginator->lastPage() - 2)
                <button wire:click="gotoPage({{ $paginator->lastPage() }})" wire:navigate class="btn {{ $btnClass }} btn-ghost hover:btn-primary" title="Halaman Terakhir">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                </button>
            @endif
        </div>
    @endif
</div>