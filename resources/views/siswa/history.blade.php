@extends('siswa.layout')

@section('content')
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ url('/siswa/dashboard') }}"
                class="inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors mb-4">
                <span class="material-symbols-outlined text-sm mr-2">arrow_back</span>
                Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-bold text-white mb-2">Riwayat Peminjaman</h1>
            <p class="text-slate-400">Daftar buku yang sudah dikembalikan</p>
        </div>

        <!-- History Card -->
        <div class="bg-zinc-900/30 border border-white/5 rounded-[2rem] overflow-hidden">
            <div class="px-8 py-6 border-b border-white/5 bg-white/5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-500/10 rounded-xl flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-500">history</span>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-white">Buku yang Sudah Dikembalikan</h2>
                            <p class="text-sm text-slate-500 uppercase tracking-wider font-bold text-[10px]">Total
                                {{ count($history) }} transaksi selesai</p>
                        </div>
                    </div>
                </div>
            </div>

            @if(count($history) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="text-slate-500 border-b border-white/5 backdrop-blur-sm">
                                <th class="px-8 py-4 font-semibold uppercase tracking-widest text-[10px]">No</th>
                                <th class="px-8 py-4 font-semibold uppercase tracking-widest text-[10px]">Buku</th>
                                <th class="px-8 py-4 font-semibold uppercase tracking-widest text-[10px]">Tanggal Pinjam</th>
                                <th class="px-8 py-4 font-semibold uppercase tracking-widest text-[10px]">Tanggal Kembali</th>
                                <th class="px-8 py-4 font-semibold uppercase tracking-widest text-[10px] text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($history as $index => $order)
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="px-8 py-6 text-slate-400 font-medium whitespace-nowrap">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-10 h-12 bg-white/5 rounded-lg flex items-center justify-center shrink-0 border border-white/5">
                                                <span
                                                    class="material-symbols-outlined text-slate-500 group-hover:text-blue-400 transition-colors">book</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-white">{{ $order->book->nama ?? 'Unknown Book' }}</p>
                                                <p class="text-[10px] text-slate-500 uppercase tracking-wider">
                                                    {{ $order->book->pengarang ?? 'Unknown Author' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center text-slate-400">
                                            <span
                                                class="material-symbols-outlined text-sm mr-2 text-slate-600">calendar_today</span>
                                            {{ $order->tanggal_pinjam }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center text-slate-400">
                                            <span
                                                class="material-symbols-outlined text-sm mr-2 text-green-500/50">check_circle</span>
                                            {{ $order->tanggal_kembali }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-green-500/10 text-green-500 uppercase tracking-widest border border-green-500/20">
                                            Dikembalikan
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Summary Footer -->
                <div class="px-8 py-4 bg-white/5 border-t border-white/5">
                    <div class="flex items-center justify-between">
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">
                            Showing <span class="text-white">{{ count($history) }}</span> records
                        </p>
                    </div>
                </div>
            @else
                <div class="p-20 text-center">
                    <div class="w-24 h-24 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-8">
                        <span class="material-symbols-outlined text-5xl text-slate-700">history</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Belum Ada Riwayat</h3>
                    <p class="text-slate-500 mb-8 max-w-sm mx-auto text-sm">Kamu belum memiliki riwayat peminjaman buku. Buku
                        yang sudah dikembalikan akan muncul di sini.</p>
                    <a href="{{ url('/siswa/order/create') }}"
                        class="inline-flex items-center px-8 py-4 text-sm font-bold text-black bg-white rounded-2xl hover:bg-slate-200 transition-all shadow-xl shadow-white/5">
                        <span class="material-symbols-outlined text-xl mr-2">add</span>
                        Pinjam Buku Sekarang
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection