@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Header -->
    <div>
        <h2 class="text-3xl font-bold text-white">{{ isset($book) ? 'Update Book' : 'Add New Book' }}</h2>
        <p class="text-zinc-400 text-sm mt-1">Enter catalog details for the library collection.</p>
    </div>

    <!-- Form Card -->
    <div class="bg-surface-dark border border-zinc-800 rounded-2xl p-8 shadow-2xl shadow-black/50">
        <form action="{{ isset($book) ? url('books/' . $book->id) : url('books/create') }}" method="POST" class="space-y-8">
            @csrf
            @if(isset($book)) @method('PUT') @endif
            
            <div class="space-y-6">
                <div class="flex items-center gap-2 text-zinc-400 border-b border-zinc-800/50 pb-2">
                    <span class="material-symbols-outlined text-[20px]">book</span>
                    <h3 class="text-sm font-bold uppercase tracking-widest">Book Information</h3>
                </div>

                @if ($errors->any())
                    <div class="p-4 bg-rose-500/10 border border-rose-500/20 rounded-xl text-rose-400 text-xs shadow-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 gap-6">
                    <!-- Title -->
                    <div class="space-y-2">
                        <label for="nama" class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Book Title</label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') ?? ($book->nama ?? '') }}" class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700" placeholder="e.g. The Great Gatsby" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Author -->
                        <div class="space-y-2">
                            <label for="pengarang" class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Author</label>
                            <input type="text" name="pengarang" id="pengarang" value="{{ old('pengarang') ?? ($book->pengarang ?? '') }}" class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700" placeholder="e.g. F. Scott Fitzgerald" required>
                        </div>
                        <!-- Publisher -->
                        <div class="space-y-2">
                            <label for="penerbit" class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Publisher</label>
                            <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit') ?? ($book->penerbit ?? '') }}" class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700" placeholder="e.g. Scribner" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Year -->
                        <div class="space-y-2">
                            <label for="tahun_terbit" class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Year Published</label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit') ?? ($book->tahun_terbit ?? '') }}" min="1800" max="{{ date('Y') + 1 }}" class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700" placeholder="e.g. 1925" required>
                        </div>
                        <!-- Stock -->
                        <div class="space-y-2">
                            <label for="stock" class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Stock Available</label>
                            <div class="relative">
                                <input type="number" name="stock" id="stock" value="{{ old('stock') ?? ($book->stock ?? '') }}" min="0" class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700" placeholder="0" required>
                                <span class="absolute inset-y-0 right-4 flex items-center text-zinc-600 text-[10px] font-bold uppercase">copies</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="pt-8 flex items-center justify-end gap-3 border-t border-zinc-800">
                <a href="{{ url('/books') }}" class="px-6 py-2.5 text-sm font-semibold text-zinc-400 hover:text-white transition-colors">Cancel</a>
                <button type="submit" class="bg-white hover:bg-zinc-200 text-black px-10 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-white/5 transition-all">
                    {{ isset($book) ? 'Save Changes' : 'Add to Catalog' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection