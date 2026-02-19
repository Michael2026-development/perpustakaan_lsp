@extends('admin.layout')

@section('content')
<div class="space-y-12">
    <!-- Header Section -->
    <div class="flex justify-between items-start">
        <div>
            <h2 class="text-4xl font-bold text-white mb-2">Hello, {{ Auth::user()->username }}</h2>
            <p class="text-zinc-400">Track library progress here. You are doing great!</p>
        </div>
        <div class="flex items-center gap-3 bg-zinc-900/40 border border-zinc-800 px-4 py-2.5 rounded-xl">
            <span class="text-sm font-medium text-zinc-300">{{ date('d M, Y') }}</span>
            <span class="material-symbols-outlined text-zinc-500 text-lg">calendar_today</span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-surface-dark border border-zinc-800 p-6 rounded-2xl space-y-6">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-xl bg-blue-500/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-blue-400">group</span>
                </div>
                <span class="text-[10px] font-bold text-green-400 bg-green-400/10 px-2 py-1 rounded-md uppercase">+Active</span>
            </div>
            <div>
                <p class="text-xs text-zinc-500 font-medium mb-1">Total Users</p>
                <h3 class="text-3xl font-bold text-white tracking-tight">{{ $userCount }}</h3>
            </div>
        </div>

        <!-- Total Anggota -->
        <div class="bg-surface-dark border border-zinc-800 p-6 rounded-2xl space-y-6">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-xl bg-purple-500/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-purple-400">assignment_ind</span>
                </div>
                <span class="text-[10px] font-bold text-purple-400 bg-purple-400/10 px-2 py-1 rounded-md uppercase">Members</span>
            </div>
            <div>
                <p class="text-xs text-zinc-500 font-medium mb-1">Total Anggota</p>
                <h3 class="text-3xl font-bold text-white tracking-tight">{{ $anggotaCount }}</h3>
            </div>
        </div>

        <!-- Total Books -->
        <div class="bg-surface-dark border border-zinc-800 p-6 rounded-2xl space-y-6">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-xl bg-orange-500/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-orange-400">auto_stories</span>
                </div>
                <span class="text-[10px] font-bold text-orange-400 bg-orange-400/10 px-2 py-1 rounded-md uppercase">Collection</span>
            </div>
            <div>
                <p class="text-xs text-zinc-500 font-medium mb-1">Total Books</p>
                <h3 class="text-3xl font-bold text-white tracking-tight">{{ $bookCount }}</h3>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-surface-dark border border-zinc-800 p-6 rounded-2xl space-y-6">
            <div class="flex justify-between items-start">
                <div class="w-12 h-12 rounded-xl bg-green-500/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-green-400">shopping_bag</span>
                </div>
                <span class="text-[10px] font-bold text-emerald-400 bg-emerald-400/10 px-2 py-1 rounded-md uppercase">Transactions</span>
            </div>
            <div>
                <p class="text-xs text-zinc-500 font-medium mb-1">Total Orders</p>
                <h3 class="text-3xl font-bold text-white tracking-tight">{{ $orderCount }}</h3>
            </div>
        </div>
    </div>

    <!-- Analytics Placeholder -->
    <div class="bg-surface-dark border border-zinc-800 rounded-2xl p-8 h-96 flex flex-col items-center justify-center text-zinc-600">
        <span class="material-symbols-outlined text-5xl mb-4">analytics</span>
        <p class="text-sm">Detailed charts and activity logs will appear here</p>
    </div>
</div>
@endsection