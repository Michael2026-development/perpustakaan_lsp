<!DOCTYPE html>
<html class="dark" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Admin Dashboard - Perpusz Telkom</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#ffffff",
                        "background-dark": "#000000",
                        "surface-dark": "#0a0a0a",
                        "sidebar-dark": "#050505",
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-menu {
            background: linear-gradient(90deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.02) 100%);
            border-left: 2px solid white;
        }
        /* Custom scrollbar for dark theme */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #000000;
        }
        ::-webkit-scrollbar-thumb {
            background: #1f2937;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #374151;
        }
    </style>
</head>

<body class="font-display antialiased bg-background-dark text-slate-100 min-h-screen overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-sidebar-dark border-r border-zinc-800 flex flex-col shrink-0">
            <div class="p-8">
                <img src="{{ asset('images/TS-logo-white-750x241.png') }}" alt="Logo" class="h-10 w-auto mx-auto">
            </div>

            <div class="mt-4 px-4 space-y-1 flex-1">
                <p class="px-4 text-[10px] font-bold text-zinc-500 uppercase tracking-widest mb-4">Main Menu</p>

                <a class="flex items-center gap-3 px-4 py-3 {{ Request::is('dashboard') ? 'text-white active-menu' : 'text-zinc-400 hover:text-white hover:bg-white/5' }} rounded-r-xl transition-all"
                    href="{{ url('/dashboard') }}">
                    <span class="material-symbols-outlined text-[22px]">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>

                <a class="flex items-center gap-3 px-4 py-3 {{ Request::is('users*') ? 'text-white active-menu' : 'text-zinc-400 hover:text-white hover:bg-white/5' }} rounded-r-xl transition-all"
                    href="{{ url('/users') }}">
                    <span class="material-symbols-outlined text-[22px]">person</span>
                    <span class="text-sm font-medium">User</span>
                </a>

                <a class="flex items-center gap-3 px-4 py-3 {{ Request::is('books*') ? 'text-white active-menu' : 'text-zinc-400 hover:text-white hover:bg-white/5' }} rounded-r-xl transition-all"
                    href="{{ url('/books') }}">
                    <span class="material-symbols-outlined text-[22px]">menu_book</span>
                    <span class="text-sm font-medium">Book</span>
                </a>

                <a class="flex items-center gap-3 px-4 py-3 {{ Request::is('orders*') ? 'text-white active-menu' : 'text-zinc-400 hover:text-white hover:bg-white/5' }} rounded-r-xl transition-all"
                    href="{{ url('/orders') }}">
                    <span class="material-symbols-outlined text-[22px]">receipt_long</span>
                    <span class="text-sm font-medium">Orders</span>
                </a>
            </div>

            <!-- User Profile & Logout at Bottom -->
            <div class="p-6 border-t border-zinc-800/50">
                <div class="flex items-center gap-3 px-4 py-3 mb-2">
                    <div
                        class="w-8 h-8 rounded-full bg-zinc-800 flex items-center justify-center border border-zinc-700 overflow-hidden shrink-0">
                        <span
                            class="text-[10px] font-bold text-white uppercase">{{ substr(Auth::user()->username, 0, 1) }}</span>
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->username }}</p>
                        <p class="text-[9px] text-zinc-500 uppercase">{{ Auth::user()->role }}</p>
                    </div>
                </div>
                <a class="flex items-center gap-3 px-4 py-3 text-zinc-400 hover:text-red-400 transition-colors"
                    href="{{ url('/logout') }}">
                    <span class="material-symbols-outlined text-[22px]">logout</span>
                    <span class="text-sm font-medium">Log out</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 bg-black overflow-y-auto">
            <!-- Header -->
            <header class="h-20 flex items-center justify-end px-12 border-b border-zinc-900/50 shrink-0">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3">
                        <div class="text-right">
                            <p class="text-sm font-semibold text-white capitalize">{{ Auth::user()->username }}</p>
                            <p class="text-[10px] text-zinc-500">{{ Auth::user()->role }}</p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center border border-zinc-700 overflow-hidden">
                            <span
                                class="text-xs font-bold text-white uppercase">{{ substr(Auth::user()->username, 0, 1) }}</span>
                        </div>
                    </div>
                    <a href="{{ url('/logout') }}" class="text-zinc-500 hover:text-white transition-colors">
                        <span class="material-symbols-outlined">logout</span>
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-12">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>