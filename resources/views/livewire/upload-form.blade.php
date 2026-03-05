<div>
    {{-- Upload Button --}}
    <button
        wire:click="openForm"
        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white text-sm font-semibold rounded-xl transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg hover:shadow-primary-500/25"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Upload Baru
    </button>

    {{-- Upload Modal --}}
    @if($showForm)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm animate-fade-in overflow-y-auto py-8" wire:click.self="closeForm">
            <div class="glass rounded-2xl p-6 sm:p-8 max-w-lg w-full mx-4 animate-scale-in my-auto" @click.stop>
                {{-- Header --}}
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-lg font-semibold text-white">{{ $editId ? 'Edit Item' : 'Upload Baru' }}</h2>
                        <p class="text-xs text-slate-400 mt-0.5">{{ $editId ? 'Perbarui informasi item galeri' : 'Tambahkan foto atau video ke galeri' }}</p>
                    </div>
                    <button wire:click="closeForm" class="w-8 h-8 rounded-lg bg-slate-800/50 flex items-center justify-center text-slate-400 hover:text-white hover:bg-slate-700 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form wire:submit="save" class="space-y-5">
                    {{-- Type Selector --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-2">Tipe</label>
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" wire:model.live="type" value="photo" class="sr-only peer">
                                <div class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl border border-slate-700/50 bg-slate-800/30 text-sm text-slate-400 transition-all peer-checked:border-emerald-500/50 peer-checked:bg-emerald-500/10 peer-checked:text-emerald-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    Foto
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" wire:model.live="type" value="video" class="sr-only peer">
                                <div class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl border border-slate-700/50 bg-slate-800/30 text-sm text-slate-400 transition-all peer-checked:border-purple-500/50 peer-checked:bg-purple-500/10 peer-checked:text-purple-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                    Video
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Title --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-slate-300 mb-2">Judul</label>
                        <input
                            wire:model="title"
                            type="text"
                            id="title"
                            placeholder="Masukkan judul..."
                            class="w-full px-4 py-2.5 bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white placeholder-slate-500 transition-all focus:border-primary-500/50"
                        >
                        @error('title') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- Description --}}
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-300 mb-2">Deskripsi <span class="text-slate-500">(opsional)</span></label>
                        <textarea
                            wire:model="description"
                            id="description"
                            rows="3"
                            placeholder="Tambahkan deskripsi..."
                            class="w-full px-4 py-2.5 bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white placeholder-slate-500 transition-all focus:border-primary-500/50 resize-none"
                        ></textarea>
                        @error('description') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- Class/Category --}}
                    <div>
                        <label for="category" class="block text-sm font-medium text-slate-300 mb-2">Kelas</label>
                        @if($isAdmin)
                            <select
                                wire:model.live="category"
                                id="category"
                                class="w-full px-4 py-2.5 bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white transition-all focus:border-primary-500/50"
                            >
                                <option value="">Pilih Kelas...</option>
                                @foreach($allCategories as $cat)
                                    <option value="{{ $cat }}">{{ $cat }}</option>
                                @endforeach
                                <option value="__custom__">+ Kelas Baru</option>
                            </select>

                            @if($category === '__custom__')
                                <input
                                    wire:model="customCategory"
                                    type="text"
                                    placeholder="Masukkan nama kelas baru..."
                                    class="w-full mt-2 px-4 py-2.5 bg-slate-800/50 border border-slate-700/50 rounded-xl text-sm text-white placeholder-slate-500 transition-all focus:border-primary-500/50"
                                >
                            @endif
                        @else
                            <div class="w-full px-4 py-2.5 bg-slate-800/30 border border-slate-700/30 rounded-xl text-sm text-slate-400">
                                {{ Auth::user()->name }}
                            </div>
                        @endif
                        @error('category') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- File Upload --}}
                    <div x-data="{ preview: null, fileName: '', fileSize: '' }">
                        <label class="block text-sm font-medium text-slate-300 mb-2">
                            File {{ $editId ? '(kosongkan jika tidak ingin mengubah)' : '' }}
                        </label>

                        {{-- Preview --}}
                        <template x-if="preview">
                            <div class="relative mb-3 rounded-xl overflow-hidden border border-slate-700/50">
                                @if($type === 'photo')
                                    <img :src="preview" class="w-full h-48 object-cover" alt="Preview">
                                @else
                                    <video :src="preview" class="w-full h-48 object-cover" controls></video>
                                @endif
                                <button
                                    type="button"
                                    @click="preview = null; fileName = ''; fileSize = ''; $wire.set('file', null)"
                                    class="absolute top-2 right-2 w-7 h-7 rounded-lg bg-black/50 backdrop-blur-sm flex items-center justify-center text-white/80 hover:text-white transition-colors"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                                <div class="absolute bottom-2 left-2 px-2 py-1 rounded-md bg-black/50 backdrop-blur-sm text-[10px] text-white/80">
                                    <span x-text="fileName"></span> · <span x-text="fileSize"></span>
                                </div>
                            </div>
                        </template>

                        {{-- Drop Zone --}}
                        <template x-if="!preview">
                            <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-slate-700/50 rounded-xl bg-slate-800/20 cursor-pointer hover:border-primary-500/50 hover:bg-slate-800/40 transition-all duration-300 group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-slate-500 group-hover:text-primary-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    <p class="text-sm text-slate-400 group-hover:text-slate-300">
                                        <span class="font-semibold text-primary-400">Klik untuk upload</span> atau drag & drop
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1">
                                        @if($type === 'photo')
                                            PNG, JPG, GIF, WebP (Maks. 10MB)
                                        @else
                                            MP4, MPEG, WebM, MOV (Maks. 100MB)
                                        @endif
                                    </p>
                                </div>
                                <input
                                    type="file"
                                    wire:model="file"
                                    class="hidden"
                                    accept="{{ $type === 'photo' ? 'image/jpeg,image/png,image/jpg,image/gif,image/webp' : 'video/mp4,video/mpeg,video/quicktime,video/webm' }}"
                                    @change="
                                        const file = $event.target.files[0];
                                        if (file) {
                                            preview = URL.createObjectURL(file);
                                            fileName = file.name;
                                            const size = file.size;
                                            if (size >= 1048576) fileSize = (size / 1048576).toFixed(2) + ' MB';
                                            else if (size >= 1024) fileSize = (size / 1024).toFixed(2) + ' KB';
                                            else fileSize = size + ' B';
                                        }
                                    "
                                >
                            </label>
                        </template>

                        {{-- Upload Progress --}}
                        <div wire:loading wire:target="file" class="mt-3">
                            <div class="flex items-center gap-2 text-sm text-primary-400">
                                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Mengupload file...
                            </div>
                        </div>

                        @error('file') <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p> @enderror
                    </div>

                    {{-- Submit Buttons --}}
                    <div class="flex gap-3 pt-2">
                        <button
                            type="button"
                            wire:click="closeForm"
                            class="flex-1 py-2.5 px-4 rounded-xl border border-slate-700 text-slate-300 text-sm font-medium hover:bg-slate-800 transition-all"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            class="flex-1 py-2.5 px-4 rounded-xl bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-500 hover:to-primary-400 text-white text-sm font-semibold transition-all transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                            wire:loading.attr="disabled"
                            wire:target="save,file"
                        >
                            <span wire:loading.remove wire:target="save">{{ $editId ? 'Perbarui' : 'Upload' }}</span>
                            <span wire:loading wire:target="save" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
