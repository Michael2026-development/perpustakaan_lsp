@extends('siswa.layout')

@section('content')
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- Header Banner -->
        <div class="relative overflow-hidden bg-brand-navy rounded-[2rem] p-10 shadow-2xl border border-white/5">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 via-transparent to-purple-500/10"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-4">
                    <a href="{{ url('/siswa/dashboard') }}"
                        class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-white hover:bg-white/20 transition-all">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                    </a>
                    <p class="text-xs font-bold tracking-[0.2em] text-slate-400 uppercase">Process Return</p>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">Kembalikan Buku</h1>
                <p class="text-slate-400">Manage your borrowed books and returns</p>
            </div>
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500/10 rounded-full blur-[100px]"></div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="relative overflow-hidden bg-green-500/10 border border-green-500/20 rounded-2xl p-6 backdrop-blur-sm">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-500/20 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-500">check_circle</span>
                    </div>
                    <p class="text-green-500 font-bold text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Error Message -->
        @if($errors->any())
            <div class="relative overflow-hidden bg-red-500/10 border border-red-500/20 rounded-2xl p-6 backdrop-blur-sm">
                <div class="flex items-start gap-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-500">error</span>
                    </div>
                    <div class="text-red-400 font-bold text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-zinc-900/30 border border-white/5 rounded-[2rem] overflow-hidden">
            <div class="px-8 py-6 border-b border-white/5 bg-white/5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-blue-500">auto_stories</span>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Books to Return</h2>
                            <p class="text-sm text-slate-500 uppercase tracking-wider font-bold text-[10px]">Currently
                                borrowed books</p>
                        </div>
                    </div>
                    <span
                        class="inline-flex items-center px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ count($activeOrders) > 0 ? 'bg-blue-500/10 text-blue-500 border border-blue-500/20' : 'bg-white/5 text-slate-500 border border-white/5' }}">
                        {{ count($activeOrders) }} {{ count($activeOrders) == 1 ? 'Book' : 'Books' }}
                    </span>
                </div>
            </div>

            @if(count($activeOrders) > 0)
                <div class="divide-y divide-white/5">
                    @foreach($activeOrders as $order)
                        <div class="p-8 hover:bg-white/5 transition-colors group">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-8">
                                <div class="flex items-start gap-5 flex-1">
                                    <!-- Icon -->
                                    <div
                                        class="flex-shrink-0 w-16 h-20 bg-zinc-800 rounded-lg flex items-center justify-center border border-white/5 shadow-xl">
                                        <span
                                            class="material-symbols-outlined text-slate-600 text-3xl group-hover:text-blue-400 transition-colors">book</span>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-white group-hover:text-white transition-colors">
                                            {{ $order->book->nama ?? 'Unknown Book' }}</h3>
                                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold mb-4">by
                                            {{ $order->book->pengarang ?? 'Unknown Author' }}</p>
                                        <div class="flex items-center gap-3">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-white/5 text-slate-400 border border-white/5 uppercase tracking-widest">
                                                Borrowed: {{ $order->tanggal_pinjam }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('siswa.return.process', $order->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to return this book?');">
                                    @csrf
                                    <button type="submit"
                                        class="w-full md:w-auto inline-flex items-center justify-center px-8 py-4 bg-white text-black text-sm font-bold rounded-2xl hover:bg-slate-200 transition-all shadow-xl shadow-white/5 group/btn">
                                        <span
                                            class="material-symbols-outlined mr-2 group-hover/btn:-translate-x-1 transition-transform">keyboard_return</span>
                                        Kembalikan
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-20 text-center">
                    <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-4xl text-slate-700">library_add_check</span>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">No Active Borrowings</h3>
                    <p class="text-slate-500 text-sm max-w-sm mx-auto">You don't have any books to return at the moment. All
                        your borrowings are accounted for!</p>
                </div>
            @endif
        </div>
    </div>
@endsection