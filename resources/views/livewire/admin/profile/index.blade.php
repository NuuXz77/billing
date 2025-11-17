<div>
    {{-- breadcrumbs --}}
    <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="font-bold text-">Edit Profile</h1>
        </div>
        <div>
            <div class="breadcrumbs text-sm">
                <ul>
                    <li>
                        @if (auth()->user()->role === 'admin')
                            <a href="/admin/dashboard" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Beranda
                            </a>
                        @else
                            <a href="/dashboard" wire:navigate>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                Beranda
                            </a>
                        @endif
                        <a>

                        </a>
                    </li>
                    <li>
                        <a>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                class="h-4 w-4 stroke-current">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                </path>
                            </svg>
                            Edit Profile
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- content --}}
    <div class="card bg-base-100 shadow-md border border-base-300">
        <div class="card-body">
            <div class="card border border-base-300">
                <div class="card-body">
                    {{-- untuk content bersebrangan --}}
                    <div class="flex justify-between items-center">
                        {{-- info profile --}}
                        <div class="flex items-center gap-4">
                            <div class="w-24 h-24 rounded-full bg-base-200 flex items-center justify-center">
                                {{-- if else, kalau ada profile maka gunakan img kalau else maka gunakan inisial nama --}}
                                @if (auth()->user()->profile && auth()->user()->profile->foto_profile)
                                    <img src="{{ asset('storage/' . auth()->user()->profile->foto_profile) }}"
                                        alt="{{ auth()->user()->full_name }}" class="w-24 h-24 rounded-full" />
                                @else
                                    <span
                                        class="text-4xl font-semibold text-base-content/60">{{ substr(auth()->user()->full_name ?? 'U', 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <div class="font-semibold text-lg">
                                    {{ auth()->user()->full_name }}
                                </div>
                                <div class="text-sm text-base-content/60">
                                    {{ auth()->user()->email }} | {{ ucfirst(auth()->user()->role) }}
                                </div>
                            </div>
                        </div>
                        {{-- aksi edit --}}
                        <div>
                            <button wire:click="editProfile" class="btn btn-primary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
