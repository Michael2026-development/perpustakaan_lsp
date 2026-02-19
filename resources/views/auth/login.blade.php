<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Telkom School Library') }} - Telkom School Library Login</title>
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
                        "background-dark": "#0a0a0a",
                        "surface-dark": "#171717",
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
        .floating-label-group {
            position: relative;
        }
        .floating-label-group input:focus ~ label,
        .floating-label-group input:not(:placeholder-shown) ~ label {
            transform: translateY(-1.25rem) scale(0.85);
            color: #94a3b8;
            background: transparent;
        }
        .floating-label-group label {
            position: absolute;
            top: 1rem;
            left: 1rem;
            transition: all 0.2s ease;
            pointer-events: none;
            color: #64748b;
        }
        .abstract-pattern {
            background-color: #0a0a0a;
            background-image: radial-gradient(circle at 2px 2px, #262626 1px, transparent 0);
            background-size: 24px 24px;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-display antialiased bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Left Side: Abstract Pattern & Branding -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-zinc-900">
            <div class="absolute inset-0 abstract-pattern opacity-40"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/20 via-transparent to-purple-500/20"></div>
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
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-600/20 rounded-full blur-[120px]"></div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full lg:w-1/2 flex flex-col relative bg-background-dark">
            <nav class="absolute top-0 right-0 p-8 flex items-center gap-8 text-sm font-medium">
                <a class="text-slate-900 dark:text-white transition-colors" href="{{ url('/login') }}">Log in</a>
                <a class="text-slate-900 dark:text-white border border-slate-200 dark:border-slate-800 px-5 py-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" href="{{ url('/register') }}">Register</a>
            </nav>

            <div class="flex-1 flex items-center justify-center p-8 sm:p-12">
                <div class="w-full max-w-md space-y-8">
                    <div class="space-y-2">
                        <h2 class="text-3xl font-bold tracking-tight">Welcome back</h2>
                        <p class="text-slate-500 dark:text-slate-400">Please enter your details to sign in.</p>
                    </div>

                    <!-- Flash Messages -->
                    @if (session('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form class="space-y-5" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="floating-label-group">
                            <input 
                                class="block w-full px-4 py-4 bg-white dark:bg-surface-dark border @error('username') border-red-500 @else border-slate-200 dark:border-slate-800 @enderror rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" 
                                id="username" 
                                name="username"
                                value="{{ old('username') }}"
                                placeholder=" " 
                                type="text"
                                required
                            />
                            <label for="username">Username or Email</label>
                            @error('username')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="floating-label-group">
                            <input 
                                class="block w-full px-4 py-4 bg-white dark:bg-surface-dark border @error('password') border-red-500 @else border-slate-200 dark:border-slate-800 @enderror rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none" 
                                id="password" 
                                name="password"
                                placeholder=" " 
                                type="password"
                                required
                            />
                            <label for="password">Password</label>
                            @error('password')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-primary text-background-dark py-4 px-6 rounded-xl font-semibold hover:opacity-90 active:scale-[0.98] transition-all shadow-lg shadow-white/5">
                            Sign in
                        </button>
                    </form>

                    <p class="text-center text-sm text-slate-500">
                        Don't have an account? 
                        <a class="font-semibold text-slate-900 dark:text-white hover:underline underline-offset-4 ml-1" href="{{ url('/register') }}">Sign up for free</a>
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
