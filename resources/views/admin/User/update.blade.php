@extends('admin.layout')

@section('content')
    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Header -->
        <div>
            <h2 class="text-3xl font-bold text-white">{{ isset($user) ? 'Edit User' : 'Add New User' }}</h2>
            <p class="text-zinc-400 text-sm mt-1">Configure user accounts and member profiles.</p>
        </div>

        <!-- Form Card -->
        <div class="bg-surface-dark border border-zinc-800 rounded-2xl p-8 shadow-2xl shadow-black/50">
            <form action="{{ isset($user) ? url('users/' . $user->id) : url('users/create') }}" method="POST"
                class="space-y-8">
                @csrf
                @if(isset($user)) @method('PUT') @endif

                <!-- Account Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 text-zinc-400 border-b border-zinc-800/50 pb-2">
                        <span class="material-symbols-outlined text-[20px]">account_circle</span>
                        <h3 class="text-sm font-bold uppercase tracking-widest">Account Details</h3>
                    </div>

                    @if ($errors->any())
                        <div class="p-4 bg-rose-500/10 border border-rose-500/20 rounded-xl text-rose-400 text-xs">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Role -->
                        <div class="space-y-2">
                            <label for="role"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Role</label>
                            <select name="role" id="role"
                                class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all"
                                onchange="toggleMemberFields()">
                                <option value="siswa" {{ (old('role') ?? ($user->role ?? '')) == 'siswa' ? 'selected' : '' }}>
                                    Siswa (Member)</option>
                                <option value="admin" {{ (old('role') ?? ($user->role ?? '')) == 'admin' ? 'selected' : '' }}>
                                    Administrator</option>
                            </select>
                        </div>

                        <!-- Username -->
                        <div class="space-y-2">
                            <label for="username"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Username</label>
                            <input type="text" name="username" id="username"
                                value="{{ old('username') ?? ($user->username ?? '') }}"
                                class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700"
                                placeholder="Enter username" required>
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label for="password"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Password
                                {{ isset($user) ? '(Optional)' : '' }}</label>
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700"
                                placeholder="••••••••" {{ isset($user) ? '' : 'required' }}>
                        </div>
                    </div>
                </div>

                <!-- Member Details Section -->
                <div id="member_fields_container"
                    class="space-y-6 {{ (old('role') ?? ($user->role ?? '')) == 'admin' ? 'hidden' : '' }}">
                    <div class="flex items-center gap-2 text-zinc-400 border-b border-zinc-800/50 pb-2">
                        <span class="material-symbols-outlined text-[20px]">id_card</span>
                        <h3 class="text-sm font-bold uppercase tracking-widest">Member Profile</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- NIS -->
                        <div class="space-y-2">
                            <label for="nis"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">NIS</label>
                            <input type="text" name="nis" id="nis" value="{{ old('nis') ?? ($user->anggota->nis ?? '') }}"
                                class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700"
                                placeholder="12345678">
                        </div>

                        <!-- Full Name -->
                        <div class="space-y-2">
                            <label for="nama" class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Full
                                Name</label>
                            <input type="text" name="nama" id="nama"
                                value="{{ old('nama') ?? ($user->anggota->nama ?? '') }}"
                                class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700"
                                placeholder="Enter full name">
                        </div>

                        <!-- Major -->
                        <div class="space-y-2">
                            <label for="jurusan"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Major</label>
                            <select name="jurusan" id="jurusan"
                                class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all">
                                <option value="RPL" {{ (old('jurusan') ?? ($user->anggota->jurusan ?? '')) == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                <option value="TKJ" {{ (old('jurusan') ?? ($user->anggota->jurusan ?? '')) == 'TKJ' ? 'selected' : '' }}>Teknik Komputer & Jaringan</option>
                                <option value="TJA" {{ (old('jurusan') ?? ($user->anggota->jurusan ?? '')) == 'TJA' ? 'selected' : '' }}>Teknik Jaringan Akses</option>
                            </select>
                        </div>

                        <!-- Class -->
                        <div class="space-y-2">
                            <label for="kelas"
                                class="block text-xs font-bold text-zinc-500 uppercase tracking-widest">Class</label>
                            <input type="text" name="kelas" id="kelas"
                                value="{{ old('kelas') ?? ($user->anggota->kelas ?? '') }}"
                                class="w-full px-4 py-2.5 bg-zinc-900/50 border border-zinc-800 rounded-xl text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition-all placeholder:text-zinc-700"
                                placeholder="XI RPL 1">
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="pt-8 flex items-center justify-end gap-3 border-t border-zinc-800">
                    <a href="{{ url('/users') }}"
                        class="px-6 py-2.5 text-sm font-semibold text-zinc-400 hover:text-white transition-colors">Cancel</a>
                    <button type="submit"
                        class="bg-white hover:bg-zinc-200 text-black px-10 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-white/5 transition-all">
                        {{ isset($user) ? 'Update User' : 'Create User' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleMemberFields() {
            const role = document.getElementById('role').value;
            const container = document.getElementById('member_fields_container');
            const inputs = container.querySelectorAll('input, select');

            if (role === 'admin') {
                container.classList.add('hidden');
                inputs.forEach(input => input.disabled = true);
            } else {
                container.classList.remove('hidden');
                inputs.forEach(input => input.disabled = false);
            }
        }

        // Run on load
        window.addEventListener('DOMContentLoaded', toggleMemberFields);
    </script>
@endsection