@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-16 mb-8">
        <div class="flex items-center gap-2 p-2 glass rounded-2xl shadow-2xl shadow-primary-500/10 backdrop-blur-xl border border-slate-700/50">
            
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800/40 text-slate-500 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800/80 text-white hover:bg-primary-500 hover:text-white hover:shadow-lg hover:shadow-primary-500/30 transition-all duration-300 transform hover:-translate-x-1 outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
            @endif

            {{-- Pagination Elements --}}
            <div class="flex items-center gap-1.5 px-2">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="w-10 h-10 flex items-center justify-center text-slate-400 font-medium">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="relative w-10 h-10 flex items-center justify-center rounded-xl bg-gradient-to-tr from-primary-600 to-primary-400 text-white font-bold shadow-lg shadow-primary-500/40 text-sm overflow-hidden group">
                                    <span class="relative z-10">{{ $page }}</span>
                                    <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                                </span>
                            @else
                                <button wire:click="gotoPage({{ $page }})" class="w-10 h-10 flex items-center justify-center rounded-xl bg-transparent text-slate-400 font-medium hover:bg-white/5 hover:text-white transition-all duration-300 text-sm outline-none">
                                    {{ $page }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800/80 text-white hover:bg-primary-500 hover:text-white hover:shadow-lg hover:shadow-primary-500/30 transition-all duration-300 transform hover:translate-x-1 outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            @else
                <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800/40 text-slate-500 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
