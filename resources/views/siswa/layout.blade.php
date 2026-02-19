<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#ffffff",
                        "background-dark": "#0a0a0a",
                        "surface-dark": "#121212",
                        "brand-navy": "#1a1f2c",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.75rem",
                    },
                },
            },
        };
    </script>
    <style type="text/tailwindcss">
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #262626;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #404040;
        }
    </style>
</head>

<body class="font-display antialiased bg-background-dark text-slate-100 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-zinc-950 border-r border-white/5 flex flex-col fixed inset-y-0 left-0 z-50">
            <div class="p-8">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-black text-xl font-bold">book</span>
                    </div>
                    <span class="text-sm font-bold tracking-widest uppercase">Perpusz Telkom</span>
                </div>
            </div>

            <div class="flex-1 px-4 space-y-8 overflow-y-auto custom-scrollbar">
                <div>
                    <p class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-4">Main Menu</p>
                    <nav class="space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ url('/siswa/dashboard') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('siswa/dashboard*') ? 'bg-white/5 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <span class="material-symbols-outlined text-xl">grid_view</span>
                            Dashboard
                        </a>

                        <!-- Borrow Book -->
                        <a href="{{ url('/siswa/order/create') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('siswa/order*') ? 'bg-white/5 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <span class="material-symbols-outlined text-xl">auto_stories</span>
                            Pinjam Buku
                        </a>

                        <!-- Return Book -->
                        <a href="{{ url('/siswa/return') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('siswa/return*') ? 'bg-white/5 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <span class="material-symbols-outlined text-xl">keyboard_return</span>
                            Kembalikan Buku
                        </a>

                        <!-- History -->
                        <a href="{{ url('/siswa/history') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->is('siswa/history*') ? 'bg-white/5 text-white' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                            <span class="material-symbols-outlined text-xl">history</span>
                            Riwayat Peminjaman
                        </a>
                    </nav>
                </div>
            </div>

            <div class="p-4 border-t border-white/5">
                <a href="{{ url('/logout') }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl text-slate-400 hover:text-red-400 transition-colors">
                    <span class="material-symbols-outlined text-xl">logout</span>
                    Log out
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8">
            <header class="flex justify-end items-center mb-8">
                <div class="flex items-center gap-4 bg-zinc-900/50 p-2 pl-4 rounded-full border border-white/5">
                    <div class="text-right">
                        <p class="text-xs font-semibold text-white">{{ Auth::user()->username ?? 'Guest' }}</p>
                        <p class="text-[10px] text-slate-500">{{ Auth::user()->role ?? 'siswa' }}</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold">
                        {{ substr(Auth::user()->username ?? 'G', 0, 1) }}
                    </div>
                    <a href="{{ url('/logout') }}"
                        class="w-8 h-8 flex items-center justify-center text-slate-400 hover:text-red-400 transition-colors mr-2">
                        <span class="material-symbols-outlined text-lg">logout</span>
                    </a>
                </div>
            </header>

            @yield('content')
            {{ isset($slot) ? $slot : '' }}
        </main>
    </div>
</body>

</html>