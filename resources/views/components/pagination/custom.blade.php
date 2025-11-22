@props([
    'paginator',
    'showingText' => true,
    'showingFormat' => 'Menampilkan {from} - {to} dari {total} data',
    'previousText' => 'Sebelumnya',
    'nextText' => 'Selanjutnya',
    'size' => 'default' // default, sm, lg
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
    {{-- Showing Info --}}
    @if($showingText && $paginator->total() > 0)
        <div class="text-sm text-base-content/60 order-2 sm:order-1">
            {!! str_replace(
                ['{from}', '{to}', '{total}'],
                [
                    '<span class="font-semibold">' . ($paginator->firstItem() ?? 0) . '</span>',
                    '<span class="font-semibold">' . ($paginator->lastItem() ?? 0) . '</span>',
                    '<span class="font-semibold">' . $paginator->total() . '</span>'
                ],
                $showingFormat
            ) !!}
        </div>
    @endif

    {{-- Pagination Navigation --}}
    @if ($paginator->hasPages())
        <div class="flex items-center gap-1 order-1 sm:order-2">
            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <span class="btn {{ $btnClass }} btn-disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="hidden sm:inline">{{ $previousText }}</span>
                </span>
            @else
                <a wire:click="previousPage" wire:navigate wire:loading.attr="disabled" class="btn {{ $btnClass }} btn-ghost hover:btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span class="hidden sm:inline">{{ $previousText }}</span>
                </a>
            @endif

            {{-- Page Numbers --}}
            <div class="flex items-center gap-1">
                @php
                    $start = max(1, $paginator->currentPage() - 2);
                    $end = min($paginator->lastPage(), $paginator->currentPage() + 2);
                @endphp

                {{-- First Page --}}
                @if($start > 1)
                    <button wire:click="gotoPage(1)" wire:navigate class="btn {{ $btnClass }} btn-ghost hover:btn-primary">
                        1
                    </button>
                    @if($start > 2)
                        <span class="px-2 text-base-content/40">...</span>
                    @endif
                @endif

                {{-- Page Range --}}
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

                {{-- Last Page --}}
                @if($end < $paginator->lastPage())
                    @if($end < $paginator->lastPage() - 1)
                        <span class="px-2 text-base-content/40">...</span>
                    @endif
                    <button wire:click="gotoPage({{ $paginator->lastPage() }})" wire:navigate class="btn {{ $btnClass }} btn-ghost hover:btn-primary">
                        {{ $paginator->lastPage() }}
                    </button>
                @endif
            </div>

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:navigate wire:loading.attr="disabled" class="btn {{ $btnClass }} btn-ghost hover:btn-primary">
                    <span class="hidden sm:inline">{{ $nextText }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @else
                <span class="btn {{ $btnClass }} btn-disabled">
                    <span class="hidden sm:inline">{{ $nextText }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </div>

        {{-- Loading Indicator --}}
        <div wire:loading wire:target="previousPage,nextPage,gotoPage" class="fixed top-4 right-4 z-50">
            <div class="alert alert-info">
                <span class="loading loading-spinner loading-sm"></span>
                <span>Loading...</span>
            </div>
        </div>
    @endif
</div>