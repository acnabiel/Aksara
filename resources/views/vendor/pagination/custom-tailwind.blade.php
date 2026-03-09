@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between p-4 glass rounded-2xl border border-slate-800/50 shadow-2xl relative overflow-hidden">
        {{-- Subtle background decoration --}}
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary-500/5 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-purple-500/5 rounded-full blur-2xl pointer-events-none"></div>

        {{-- Mobile View --}}
        <div class="flex justify-between flex-1 sm:hidden relative z-10 w-full">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-slate-500 bg-slate-800/30 rounded-xl cursor-not-allowed border border-slate-700/30">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    Previous
                </span>
            @else
                <button type="button" wire:click="previousPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-slate-800/80 hover:bg-slate-700 hover:text-primary-300 rounded-xl transition-all shadow-lg border border-slate-700/50 hover:border-primary-500/30 active:scale-95">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    Previous
                </button>
            @endif

            @if ($paginator->hasMorePages())
                <button type="button" wire:click="nextPage" wire:loading.attr="disabled" class="relative inline-flex items-center px-4 py-2.5 ms-3 text-sm font-medium text-white bg-slate-800/80 hover:bg-slate-700 hover:text-primary-300 rounded-xl transition-all shadow-lg border border-slate-700/50 hover:border-primary-500/30 active:scale-95">
                    Next
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            @else
                <span class="relative inline-flex items-center px-4 py-2.5 ms-3 text-sm font-medium text-slate-500 bg-slate-800/30 rounded-xl cursor-not-allowed border border-slate-700/30">
                    Next
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </span>
            @endif
        </div>

        {{-- Desktop View --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between relative z-10">
            <div>
                <p class="text-sm text-slate-400 font-medium">
                    Menampilkan
                    <span class="font-bold text-white px-1">{{ $paginator->firstItem() }}</span>
                    sampai
                    <span class="font-bold text-white px-1">{{ $paginator->lastItem() }}</span>
                    dari
                    <span class="font-bold text-primary-400 px-1">{{ $paginator->total() }}</span>
                    hasil
                </p>
            </div>

            <div>
                <ul class="relative z-0 inline-flex items-center gap-1.5 list-none">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li>
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="relative inline-flex items-center p-2.5 text-sm font-medium text-slate-600 bg-slate-800/20 rounded-xl cursor-not-allowed transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                            </span>
                        </li>
                    @else
                        <li>
                            <button type="button" wire:click="previousPage" rel="prev" class="relative inline-flex items-center p-2.5 text-sm font-medium text-slate-400 bg-slate-800/50 hover:bg-slate-700 hover:text-white rounded-xl transition-all border border-transparent hover:border-slate-600 shadow-sm active:scale-95" aria-label="{{ __('pagination.previous') }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                            </button>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li>
                                <span aria-disabled="true" class="relative flex items-center justify-center w-10 h-10 text-sm font-medium text-slate-500 bg-transparent cursor-default">{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li>
                                        <span aria-current="page" class="relative flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-gradient-to-tr from-primary-500 to-primary-600 rounded-xl shadow-[0_4px_16px_rgba(14,165,233,0.3)] border border-primary-400/30 overflow-hidden group">
                                            <span class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 pointer-events-none"></span>
                                            <span class="relative z-10">{{ $page }}</span>
                                        </span>
                                    </li>
                                @else
                                    <li>
                                        <button type="button" wire:click="gotoPage({{ $page }})" class="relative flex items-center justify-center w-10 h-10 text-sm font-medium text-slate-400 bg-slate-800/30 hover:bg-slate-700/60 hover:text-white rounded-xl transition-all duration-200 border border-slate-700/30 hover:border-slate-500/50 active:scale-95">
                                            {{ $page }}
                                        </button>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <button type="button" wire:click="nextPage" rel="next" class="relative inline-flex items-center p-2.5 text-sm font-medium text-slate-400 bg-slate-800/50 hover:bg-slate-700 hover:text-white rounded-xl transition-all border border-transparent hover:border-slate-600 shadow-sm active:scale-95" aria-label="{{ __('pagination.next') }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                            </button>
                        </li>
                    @else
                        <li>
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="relative inline-flex items-center p-2.5 text-sm font-medium text-slate-600 bg-slate-800/20 rounded-xl cursor-not-allowed transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" /></svg>
                            </span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
