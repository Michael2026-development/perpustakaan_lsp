@extends('siswa.layout')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ url('/siswa/dashboard') }}"
                class="inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors mb-4">
                <span class="material-symbols-outlined text-sm mr-2">arrow_back</span>
                Back to Dashboard
            </a>
            <h1 class="text-3xl font-bold text-white mb-2">Borrow a Book</h1>
            <p class="text-slate-400">Select a book from our collection to borrow</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-8 p-6 bg-red-500/10 border border-red-500/20 rounded-[2rem] backdrop-blur-sm">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-500">error</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-red-500 uppercase tracking-widest text-[10px] mb-2">Errors</h3>
                        <ul class="list-disc list-inside text-sm text-red-400/80 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Book Selection Card -->
        <form action="{{ url('/siswa/order/create') }}" method="POST">
            @csrf

            <!-- Available Books Grid -->
            <div class="bg-zinc-900/30 border border-white/5 rounded-[2rem] overflow-hidden mb-8">
                <div class="px-8 py-6 border-b border-white/5 bg-white/5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-brand-primary/10 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-brand-primary">library_books</span>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Available Books</h2>
                            <p class="text-sm text-slate-500 uppercase tracking-wider font-bold text-[10px]">
                                {{ count($books) }} books in stock</p>
                        </div>
                    </div>
                </div>

                @if(count($books) > 0)
                    <div class="p-8">
                        <!-- Search/Filter -->
                        <div class="mb-8">
                            <div class="relative group">
                                <span
                                    class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-500 group-focus-within:text-white transition-colors">search</span>
                                <input type="text" id="book-search" placeholder="Search books by title or author..."
                                    class="w-full pl-12 pr-4 py-4 bg-white/5 border border-white/10 rounded-2xl focus:bg-white/10 focus:border-white/20 outline-none transition-all text-white placeholder:text-slate-600 shadow-inner">
                            </div>
                        </div>

                        <!-- Books Grid -->
                        <div id="books-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($books as $book)
                                <label
                                    class="book-item relative flex cursor-pointer rounded-2xl border border-white/5 bg-white/5 p-5 transition-all duration-300 hover:bg-white/10 hover:border-white/10"
                                    data-title="{{ strtolower($book->nama) }}" data-author="{{ strtolower($book->pengarang) }}">
                                    <input type="radio" name="book_id" value="{{ $book->id }}" class="peer sr-only" {{ old('book_id') == $book->id ? 'checked' : '' }}>

                                    <!-- Book Cover Placeholder -->
                                    <div
                                        class="flex-shrink-0 w-16 h-20 bg-zinc-800 rounded-lg flex items-center justify-center mr-4 shadow-xl border border-white/5">
                                        <span class="material-symbols-outlined text-slate-600 text-3xl">book</span>
                                    </div>

                                    <!-- Book Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-white truncate group-hover:text-blue-400 transition-colors">
                                            {{ $book->nama }}</h3>
                                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold mb-3">by
                                            {{ $book->pengarang }}</p>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] font-bold bg-white/5 text-slate-400 border border-white/5 uppercase tracking-wider">
                                                {{ $book->penerbit }}
                                            </span>
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider {{ $book->stock > 5 ? 'bg-green-500/10 text-green-500 border border-green-500/20' : ($book->stock > 2 ? 'bg-amber-500/10 text-amber-500 border border-amber-500/20' : 'bg-red-500/10 text-red-500 border border-red-500/20') }}">
                                                {{ $book->stock }} in stock
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Selection Indicator -->
                                    <div
                                        class="absolute top-4 right-4 w-6 h-6 rounded-full border border-white/10 flex items-center justify-center transition-all peer-checked:bg-white peer-checked:border-white">
                                        <span
                                            class="material-symbols-outlined text-xs text-black opacity-0 peer-checked:opacity-100 transition-opacity font-bold">check</span>
                                    </div>

                                    <!-- Selected Overlay -->
                                    <div
                                        class="absolute inset-0 rounded-2xl border-2 border-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity">
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <!-- No Results Message -->
                        <div id="no-results" class="hidden text-center py-16">
                            <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                                <span class="material-symbols-outlined text-4xl text-slate-700">search_off</span>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2">No books found</h3>
                            <p class="text-slate-500 text-sm">Try adjusting your search terms</p>
                        </div>
                    </div>
                @else
                    <div class="p-20 text-center">
                        <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="material-symbols-outlined text-4xl text-slate-700">block</span>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-2">No Books Available</h3>
                        <p class="text-slate-500 text-sm">All books are currently borrowed. Please check back later.</p>
                    </div>
                @endif
            </div>

            <!-- Borrow Information -->
            <div
                class="bg-amber-500/5 border border-amber-500/10 rounded-[2rem] p-8 mb-8 backdrop-blur-sm relative overflow-hidden">
                <div class="flex items-start gap-4 relative z-10">
                    <div class="flex-shrink-0 w-12 h-12 bg-amber-500/10 rounded-2xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-amber-500">info</span>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-amber-500 uppercase tracking-widest text-[10px] mb-4">Borrowing
                            Policy</h3>
                        <ul class="text-sm text-slate-400 space-y-3">
                            <li class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-500/40 text-sm">verified</span>
                                Maximum borrowing period: <span class="text-white font-bold ml-1">14 days</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-500/40 text-sm">verified</span>
                                Please return books in good condition
                            </li>
                            <li class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-500/40 text-sm">verified</span>
                                Late returns may result in borrowing restrictions
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Abstract BG -->
                <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-amber-500/5 rounded-full blur-3xl"></div>
            </div>

            <!-- Submit Button -->
            @if(count($books) > 0)
                <div class="flex items-center justify-between gap-6 pb-20">
                    <a href="{{ url('/siswa/dashboard') }}"
                        class="px-8 py-4 text-sm font-bold text-slate-400 hover:text-white bg-white/5 border border-white/5 rounded-2xl transition-all">
                        Cancel
                    </a>
                    <button type="submit"
                        class="flex-1 group px-8 py-4 text-sm font-bold text-black bg-white rounded-2xl hover:bg-slate-200 focus:outline-none transition-all shadow-xl shadow-white/5 disabled:opacity-50"
                        id="submit-btn" disabled>
                        <span class="flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-xl">add_task</span>
                            Borrow Selected Book
                        </span>
                    </button>
                </div>
            @endif
        </form>
    </div>

    <script>
        // Book search functionality
        document.getElementById('book-search').addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const bookItems = document.querySelectorAll('.book-item');
            const noResults = document.getElementById('no-results');
            let visibleCount = 0;

            bookItems.forEach(function (item) {
                const title = item.getAttribute('data-title');
                const author = item.getAttribute('data-author');

                if (title.includes(searchTerm) || author.includes(searchTerm)) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (visibleCount === 0 && searchTerm !== '') {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });

        // Update selection visual and submit button
        document.querySelectorAll('input[name="book_id"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                document.getElementById('submit-btn').disabled = !this.checked;
            });
        });

        // Initialize: check if any is already selected
        document.addEventListener('DOMContentLoaded', function () {
            const checkedRadio = document.querySelector('input[name="book_id"]:checked');
            if (checkedRadio) {
                document.getElementById('submit-btn').disabled = false;
            }
        });
    </script>
@endsection