@extends('siswa.layout')

@section('content')
    <!-- Welcome Banner -->
    <div class="relative bg-brand-navy rounded-[2rem] p-10 mb-8 overflow-hidden border border-white/5">
        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="space-y-4">
                <p class="text-xs font-bold tracking-[0.2em] text-slate-400 uppercase">Welcome Back</p>
                <h1 class="text-4xl font-bold text-white">{{ $anggota->nama ?? Auth::user()->username }}</h1>
                @if($anggota)
                    <div class="flex flex-wrap gap-2">
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/10 text-[10px] font-bold text-slate-300">
                            <span class="material-symbols-outlined text-xs">location_on</span> {{ $anggota->kelas }}
                        </span>
                        <span
                            class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-white/10 text-[10px] font-bold text-slate-300">
                            <span class="material-symbols-outlined text-xs">id_card</span> NIS: {{ $anggota->nis }}
                        </span>
                    </div>
                @endif
            </div>
            <a href="{{ url('/siswa/order/create') }}"
                class="bg-white text-black px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:bg-slate-200 transition-all shadow-lg shadow-white/10">
                <span class="material-symbols-outlined text-xl">add</span>
                Borrow a Book
            </a>
        </div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500/10 rounded-full blur-[100px]"></div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Active Borrowings -->
        <div class="bg-zinc-900/30 border border-white/5 p-6 rounded-3xl relative overflow-hidden group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-blue-500/10 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-500">menu_book</span>
                </div>
                <span class="px-3 py-1 rounded-full bg-blue-500/10 text-[10px] font-bold text-blue-500">Active</span>
            </div>
            <p class="text-3xl font-bold mb-1">{{ count($activeOrders) }}</p>
            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Books Currently Borrowed</p>
        </div>

        <!-- Returned -->
        <div class="bg-zinc-900/30 border border-white/5 p-6 rounded-3xl relative overflow-hidden group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-green-500/10 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-green-500">check_circle</span>
                </div>
                <span class="px-3 py-1 rounded-full bg-green-500/10 text-[10px] font-bold text-green-500">Returned</span>
            </div>
            <p class="text-3xl font-bold mb-1">{{ count($history) }}</p>
            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Books Returned</p>
        </div>

        <!-- Total -->
        <div class="bg-zinc-900/30 border border-white/5 p-6 rounded-3xl relative overflow-hidden group">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 bg-purple-500/10 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-500">receipt_long</span>
                </div>
                <span class="px-3 py-1 rounded-full bg-purple-500/10 text-[10px] font-bold text-purple-500">Total</span>
            </div>
            <p class="text-3xl font-bold mb-1">{{ count($activeOrders) + count($history) }}</p>
            <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Total Transactions</p>
        </div>
    </div>

    <!-- Currently Borrowed -->
    <div class="bg-zinc-900/30 border border-white/5 rounded-3xl mb-8 overflow-hidden">
        <div class="p-6 border-b border-white/5 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-slate-400">book</span>
                </div>
                <div>
                    <h3 class="text-sm font-bold">Currently Borrowed Books</h3>
                    <p class="text-[10px] text-slate-500 uppercase tracking-wider">Books you need to return</p>
                </div>
            </div>
            <span class="px-3 py-1 rounded-full bg-white/5 text-[10px] font-bold text-slate-400">{{ count($activeOrders) }}
                Books</span>
        </div>

        @if(count($activeOrders) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-white/5">
                            <th class="px-6 py-4 font-semibold">Book Title</th>
                            <th class="px-6 py-4 font-semibold">Borrowed Date</th>
                            <th class="px-6 py-4 font-semibold text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($activeOrders as $order)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-white">{{ $order->book->nama ?? 'Unknown Book' }}</div>
                                    <div class="text-[10px] text-slate-500">{{ $order->book->pengarang ?? 'Unknown Author' }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-400">{{ $order->tanggal_pinjam }}</td>
                                <td class="px-6 py-4 text-right">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-blue-500/10 text-blue-500 uppercase tracking-widest">Borrowed</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-16 flex flex-col items-center justify-center text-center space-y-6">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-4xl text-slate-600">import_contacts</span>
                </div>
                <div class="space-y-2">
                    <h4 class="text-lg font-bold">No Active Borrowings</h4>
                    <p class="text-sm text-slate-500 max-w-sm">You haven't borrowed any books yet. Start exploring our
                        collection!</p>
                </div>
                <a href="{{ url('/siswa/order/create') }}"
                    class="bg-zinc-950 border border-white/10 text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:bg-zinc-900 transition-all">
                    <span class="material-symbols-outlined text-xl">add</span>
                    Borrow a Book
                </a>
            </div>
        @endif
    </div>

    <!-- History -->
    <div class="bg-zinc-900/30 border border-white/5 rounded-3xl overflow-hidden">
        <div class="p-6 border-b border-white/5 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-500/10 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-green-500">history</span>
                </div>
                <div>
                    <h3 class="text-sm font-bold">Borrowing History</h3>
                    <p class="text-[10px] text-slate-500 uppercase tracking-wider">Books you have returned</p>
                </div>
            </div>
            <span
                class="px-3 py-1 rounded-full bg-green-500/10 text-[10px] font-bold text-green-500 uppercase tracking-widest">{{ count($history) }}
                Books</span>
        </div>

        @if(count($history) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-white/5">
                            <th class="px-6 py-4 font-semibold">Book Title</th>
                            <th class="px-6 py-4 font-semibold">Borrowed Date</th>
                            <th class="px-6 py-4 font-semibold">Returned Date</th>
                            <th class="px-6 py-4 font-semibold text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($history as $order)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-white">{{ $order->book->nama ?? 'Unknown Book' }}</div>
                                    <div class="text-[10px] text-slate-500">{{ $order->book->pengarang ?? 'Unknown Author' }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-400">{{ $order->tanggal_pinjam }}</td>
                                <td class="px-6 py-4 text-slate-400">{{ $order->tanggal_kembali }}</td>
                                <td class="px-6 py-4 text-right">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-green-500/10 text-green-500 uppercase tracking-widest">Returned</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-4xl text-slate-600">history</span>
                </div>
                <h4 class="text-lg font-bold">No History Yet</h4>
                <p class="text-sm text-slate-500">Your returned books will appear here.</p>
            </div>
        @endif
    </div>
@endsection