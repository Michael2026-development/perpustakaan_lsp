@extends('admin.layout')

@section('content')
    <div class="space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-3xl font-bold text-white">Orders</h2>
                <p class="text-zinc-400 text-sm mt-1">Monitor book borrowing transactions.</p>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <!-- Search Bar -->
                <div class="relative flex-1 md:w-64">
                    <input type="text" placeholder="Search orders..."
                        class="w-full pl-10 pr-4 py-2 bg-zinc-900/40 border-zinc-800 border rounded-xl text-sm text-white focus:border-white focus:ring-0 transition-all placeholder:text-zinc-600">
                    <span class="material-symbols-outlined text-zinc-500 absolute left-3 top-2 text-[20px]">search</span>
                </div>
                <!-- Add Button -->
                <a href="{{ url('/orders/create') }}"
                    class="bg-white hover:bg-zinc-200 text-black px-5 py-2 rounded-xl text-sm font-semibold flex items-center gap-2 transition-all shrink-0">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Add Order
                </a>
            </div>
        </div>

        @if (session('success'))
            <div
                class="p-4 bg-emerald-500/10 border border-emerald-500/20 rounded-xl text-emerald-400 text-sm flex items-center gap-3">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Section -->
        <div class="bg-surface-dark border border-zinc-800 rounded-2xl overflow-hidden shadow-2xl shadow-black/50">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-zinc-900/50 text-zinc-500 text-[10px] uppercase tracking-widest border-b border-zinc-800">
                            <th class="p-5 font-bold">#ID</th>
                            <th class="p-5 font-bold">Borrower</th>
                            <th class="p-5 font-bold">Book Title</th>
                            <th class="p-5 font-bold text-center">Dates (Pinjam → Kembali)</th>
                            <th class="p-5 font-bold text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-zinc-300 text-sm divide-y divide-zinc-800/50">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-white/[0.02] transition-colors">
                                <td class="p-5 text-zinc-500 font-mono text-xs">#{{ $order->id }}</td>
                                <td class="p-5">
                                    <div class="flex flex-col">
                                        <span class="text-white font-semibold">{{ $order->anggota?->nama ?? '-' }}</span>
                                        <span class="text-zinc-500 text-xs">{{ $order->anggota?->nis ?? 'No NIS' }}</span>
                                    </div>
                                </td>
                                <td class="p-5">
                                    <span class="text-zinc-300 font-medium">{{ $order->book?->nama ?? '-' }}</span>
                                </td>
                                <td class="p-5">
                                    <div class="flex flex-col items-center">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-zinc-600 text-[14px]">calendar_today</span>
                                            <span
                                                class="text-emerald-400 font-medium">{{ date('d M Y', strtotime($order->tanggal_pinjam)) }}</span>
                                            <span
                                                class="material-symbols-outlined text-zinc-700 text-[14px]">arrow_forward</span>
                                            @if($order->tanggal_kembali)
                                                <span
                                                    class="text-blue-400 font-medium">{{ date('d M Y', strtotime($order->tanggal_kembali)) }}</span>
                                            @else
                                                <span
                                                    class="text-orange-900/80 italic text-xs uppercase font-black bg-orange-400/10 px-2 py-0.5 rounded border border-orange-400/20">Waiting...</span>
                                            @endif
                                        </div>
                                        <span class="text-[9px] text-zinc-600 uppercase mt-1 tracking-tighter">Time:
                                            {{ date('H:i', strtotime($order->tanggal_pinjam)) }}</span>
                                    </div>
                                </td>
                                <td class="p-5">
                                    <div class="flex items-center justify-center gap-4">
                                        <a href="{{ url('/orders/' . $order->id . '/edit') }}"
                                            class="text-zinc-500 hover:text-white transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-[20px]">edit</span>
                                        </a>
                                        <form action="{{ url('/orders/' . $order->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this order?');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-zinc-500 hover:text-red-400 transition-colors"
                                                title="Delete">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-zinc-500">
                                    <span class="material-symbols-outlined text-4xl mb-2 block">receipt_long</span>
                                    No transaction history found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection