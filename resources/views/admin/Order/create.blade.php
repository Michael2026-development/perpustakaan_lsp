@extends('admin.layout')

@section('content')
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Header -->
        <div>
            <h2 class="text-3xl font-bold text-white">{{ isset($order) ? 'Update Order' : 'New Order' }}</h2>
            <p class="text-zinc-400 text-sm mt-1">Record or modify book borrowing transactions.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-surface-dark border border-zinc-800 rounded-2xl p-8 shadow-2xl shadow-black/50">
            <form action="{{ isset($order) ? url('orders/' . $order->id) : url('orders/create') }}" method="POST"
                class="space-y-8">
                @csrf
                @if(isset($order)) @method('PUT') @endif

                <div class="space-y-6">
                    <!-- Transaction Details -->
                    <div class="flex items-center gap-2 text-zinc-400 border-b border-zinc-800/50 pb-2">
                        <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                        <h3 class="text-sm font-bold uppercase tracking-widest">Transaction Details</h3>
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

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Member Selection -->
                        <div class="space-y-3">
                            <label for="anggota_id"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Member /
                                Borrower</label>
                            <select name="anggota_id" id="anggota_id"
                                class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all"
                                required>
                                <option value="" disabled selected>Select a Member...</option>
                                @foreach($anggotas as $anggota)
                                    <option value="{{ $anggota->id }}" {{ (old('anggota_id') ?? ($order->anggota_id ?? '')) == $anggota->id ? 'selected' : '' }}>
                                        {{ $anggota->nama }} ({{ $anggota->kelas }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Book Selection -->
                        <div class="space-y-3">
                            <label for="book_id"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Book Title</label>
                            <select name="book_id" id="book_id"
                                class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all"
                                required>
                                <option value="" disabled selected>Select a Book...</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ (old('book_id') ?? ($order->book_id ?? '')) == $book->id ? 'selected' : '' }}>
                                        {{ $book->nama }} (by {{ $book->pengarang }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                        <!-- Borrow Date -->
                        <div class="space-y-3">
                            <label for="tanggal_pinjam"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Borrow Date &
                                Time</label>
                            <div class="relative">
                                <input type="datetime-local" name="tanggal_pinjam" id="tanggal_pinjam"
                                    value="{{ old('tanggal_pinjam') ?? (isset($order) ? date('Y-m-d\TH:i', strtotime($order->tanggal_pinjam)) : date('Y-m-d\TH:i')) }}"
                                    class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all"
                                    required>
                                <span
                                    class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-zinc-700 pointer-events-none">calendar_month</span>
                            </div>
                        </div>

                        <!-- Return Date -->
                        <div class="space-y-3">
                            <label for="tanggal_kembali"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Return Date & Time
                                (Optional)</label>
                            <div class="relative">
                                <input type="datetime-local" name="tanggal_kembali" id="tanggal_kembali"
                                    value="{{ old('tanggal_kembali') ?? (isset($order) && $order->tanggal_kembali ? date('Y-m-d\TH:i', strtotime($order->tanggal_kembali)) : '') }}"
                                    class="w-full px-4 py-3 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all">
                                <span
                                    class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-zinc-700 pointer-events-none">event_available</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-8 flex items-center justify-end gap-3 border-t border-zinc-800">
                    <a href="{{ url('/orders') }}"
                        class="px-6 py-2.5 text-sm font-semibold text-zinc-400 hover:text-white transition-colors">Cancel</a>
                    <button type="submit"
                        class="bg-white hover:bg-zinc-200 text-black px-10 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-white/5 transition-all">
                        {{ isset($order) ? 'Update Transaction' : 'Create Transaction' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection