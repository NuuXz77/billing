@props([
    'paginator',
    'simple' => false,
    'size' => 'default'
])

@php
    $sizeClasses = [
        'sm' => 'btn-sm',
        'default' => 'btn-md',
        'lg' => 'btn-lg'
    ];
    $btnClass = $sizeClasses[$size] ?? $sizeClasses['default'];
@endphp

@if ($paginator->hasPages())
    <div class="join">
        {{-- Previous Button --}}
        @if ($paginator->onFirstPage())
            <a class="join-item btn {{ $btnClass }} btn-disabled">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @else
            <a wire:click="previousPage" wire:navigate class="join-item btn {{ $btnClass }} btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endif

        @if(!$simple)
            {{-- Page Numbers (for non-simple pagination) --}}
            @php
                $start = max(1, $paginator->currentPage() - 1);
                $end = min($paginator->lastPage(), $paginator->currentPage() + 1);
            @endphp

            @for ($page = $start; $page <= $end; $page++)
                @if ($page == $paginator->currentPage())
                    <button class="join-item btn {{ $btnClass }} btn-active">
                        {{ $page }}
                    </button>
                @else
                    <button wire:click="gotoPage({{ $page }})" wire:navigate class="join-item btn {{ $btnClass }} btn-ghost">
                        {{ $page }}
                    </button>
                @endif
            @endfor
        @else
            {{-- Simple page indicator --}}
            <button class="join-item btn {{ $btnClass }} btn-ghost cursor-default">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </button>
        @endif

        {{-- Next Button --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:navigate class="join-item btn {{ $btnClass }} btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        @else
            <button class="join-item btn {{ $btnClass }} btn-disabled">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        @endif
    </div>
@endif