<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Telkom School Library') }} - Telkom School Library Register</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#ffffff",
                        "background-light": "#f8fafc",
                        "background-dark": "#000000",
                        "surface-dark": "#121212",
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
        .abstract-pattern {
            background-color: #0a0a0a;
            background-image: radial-gradient(circle at 2px 2px, #262626 1px, transparent 0);
            background-size: 24px 24px;
        }
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-display antialiased bg-background-dark text-slate-100 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Side: Abstract Pattern & Branding -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-zinc-900 border-r border-zinc-800/50">
            <div class="absolute inset-0 abstract-pattern opacity-40"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 via-transparent to-purple-500/10"></div>
            <div class="relative z-10 flex flex-col justify-between p-12 w-full">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/TS-logo-white-750x241.png') }}" alt="Logo" class="h-10 w-auto">
                </div>
                <div>
                    <h1 class="text-5xl font-bold leading-tight mb-6">
                        One platform<br/>
                        <span class="text-slate-500">for all library needs.</span>
                    </h1>
                    <p class="text-lg text-slate-400 max-w-md">
                        Explore our book collection and start your reading journey today.
                    </p>
                </div>
                <div class="flex items-center gap-4 text-sm text-slate-500">
                    <p>© 2026 Telkom School Library</p>
                </div>
            </div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-600/10 rounded-full blur-[120px]"></div>
        </div>

        <!-- Right Side: Registration Form -->
        <div class="w-full lg:w-1/2 flex flex-col relative bg-black">
            <nav class="absolute top-0 right-0 p-8 flex items-center gap-8 text-sm font-medium z-20 bg-black/50 backdrop-blur-sm w-full lg:w-auto justify-end">
                <a class="text-slate-400 hover:text-white transition-colors" href="{{ url('/login') }}">Log in</a>
                <a class="text-white border border-white/20 px-5 py-2 rounded-full bg-white/5 hover:bg-white/10 transition-colors" href="{{ url('/register') }}">Register</a>
            </nav>

            <div class="flex-1 flex items-center justify-center p-6 sm:p-12 pt-24 lg:pt-12">
                <div class="w-full max-w-md space-y-8">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tight">Hello New Members 👋</h2>
                        <p class="text-slate-400">Fill these inputs to register</p>
                    </div>

                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-zinc-800 dark:text-green-400" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-zinc-800 dark:text-red-400" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-zinc-800 dark:text-red-400" role="alert">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="space-y-6 max-h-[70vh] lg:max-h-none overflow-y-auto pr-2 custom-scrollbar" method="POST">
                        @csrf
                        
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-300" for="nama">Nama</label>
                            <input 
                                class="block w-full px-4 py-3 bg-zinc-900/50 border @error('nama') border-red-500 @else border-zinc-800 @enderror rounded-xl focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none text-white placeholder:text-zinc-600" 
                                id="nama" 
                                name="nama"
                                value="{{ old('nama') }}"
                                placeholder="ex: Budi Hartono" 
                                type="text"
                                required
                            />
                            @error('nama')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-300" for="nis">NIS</label>
                            <input 
                                class="block w-full px-4 py-3 bg-zinc-900/50 border @error('nis') border-red-500 @else border-zinc-800 @enderror rounded-xl focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none text-white placeholder:text-zinc-600" 
                                id="nis" 
                                name="nis"
                                value="{{ old('nis') }}"
                                placeholder="539xxxxxxxxx" 
                                type="text"
                                required
                            />
                            @error('nis')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-300" for="jurusan">Jurusan</label>
                            <select 
                                class="block w-full px-4 py-3 bg-zinc-900/50 border @error('jurusan') border-red-500 @else border-zinc-800 @enderror rounded-xl focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none text-white appearance-none" 
                                id="jurusan"
                                name="jurusan"
                                required
                            >
                                <option disabled selected value="">Pilih Jurusan</option>
                                <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                <option value="TKJ" {{ old('jurusan') == 'TKJ' ? 'selected' : '' }}>Teknik Komputer & Jaringan</option>
                                <option value="TR" {{ old('jurusan') == 'TR' ? 'selected' : '' }}>Teknik Transmisi Telekomunikasi</option>
                            </select>
                            @error('jurusan')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-300" for="kelas">Kelas</label>
                            <input 
                                class="block w-full px-4 py-3 bg-zinc-900/50 border @error('kelas') border-red-500 @else border-zinc-800 @enderror rounded-xl focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none text-white placeholder:text-zinc-600" 
                                id="kelas" 
                                name="kelas"
                                value="{{ old('kelas') }}"
                                placeholder="ex : XII Tel 13" 
                                type="text"
                                required
                            />
                            @error('kelas')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-300" for="username">Username</label>
                            <input 
                                class="block w-full px-4 py-3 bg-zinc-900/50 border @error('username') border-red-500 @else border-zinc-800 @enderror rounded-xl focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none text-white placeholder:text-zinc-600" 
                                id="username" 
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="you@example.com" 
                                type="text"
                                required
                            />
                            @error('username')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-300" for="password">Password</label>
                            <input 
                                class="block w-full px-4 py-3 bg-zinc-900/50 border @error('password') border-red-500 @else border-zinc-800 @enderror rounded-xl focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none text-white placeholder:text-zinc-600" 
                                id="password" 
                                name="password"
                                placeholder="••••••••" 
                                type="password"
                                required
                            />
                            @error('password')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-white text-black py-4 px-6 rounded-xl font-semibold hover:bg-zinc-200 active:scale-[0.98] transition-all mt-4 shadow-lg shadow-white/5">
                            Sign in
                        </button>
                    </form>

                    <p class="text-center text-sm text-slate-500 pt-2">
                        Already have an account? 
                        <a class="font-semibold text-white hover:underline underline-offset-4 ml-1" href="{{ url('/login') }}">Log in</a>
                    </p>
                </div>
            </div>

            <div class="lg:hidden p-8 flex justify-center text-xs text-slate-500 gap-4">
                <p>© 2026 Telkom School Library</p>
            </div>
        </div>
    </div>
</body>
</html>
