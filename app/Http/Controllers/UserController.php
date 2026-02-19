<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::with('anggota')->get();
        return view('admin.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        if($request->isMethod('get')){
            return view('admin.User.create');
        }

        if($request->isMethod('post')){
            
            $validateRules = [
                'username' => 'required|unique:users',
                'password' => 'required',
                'role' => 'required'
            ];

            // If role is NOT admin, validate Anggota fields
            if($request->input('role') !== 'admin') {
                $validateRules = array_merge($validateRules, [
                    'nama' => 'required',
                    'nis' => 'required',
                    'jurusan' => 'required',
                    'kelas' => 'required',
                ]);
            }

            $request->validate($validateRules);

            $userAttributes = [
                'username' => $request->username,
                'password' => Hash::make($request->password), // It's good practice to hash passwords
                'role' => $request->role,
            ];

            if ($request->input('role') !== 'admin') {
                 $anggota = anggota::create([
                    'nama' => $request->nama,
                    'nis' => $request->nis,
                    'jurusan' => $request->jurusan,
                    'kelas' => $request->kelas,
                ]);
                $userAttributes['anggota_id'] = $anggota->id;
            }

            User::create($userAttributes);

            return redirect('/users')->with('success', 'User berhasil dibuat');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('anggota')->findOrFail($id);
        return view('admin.User.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'username' => 'required|unique:users,username,' . $id,
            'role' => 'required'
        ];

        // If role is NOT admin, validate Anggota fields
        if ($request->input('role') !== 'admin') {
            $rules = array_merge($rules, [
                'nama' => 'required',
                'nis' => 'required',
                'jurusan' => 'required',
                'kelas' => 'required',
            ]);
        }

        $request->validate($rules);

        $userAttributes = [
            'username' => $request->username,
            'role' => $request->role,
        ];

        // Only update password if it's provided
        if ($request->filled('password')) {
            $userAttributes['password'] = Hash::make($request->password);
        }

        // Handle Anggota update or creation
        if ($request->input('role') !== 'admin') {
            if ($user->anggota) {
                // Update existing anggota
                $user->anggota->update([
                    'nama' => $request->nama,
                    'nis' => $request->nis,
                    'jurusan' => $request->jurusan,
                    'kelas' => $request->kelas,
                ]);
            } else {
                // Create new anggota if it doesn't exist (e.g. changing from admin to siswa)
                $anggota = anggota::create([
                    'nama' => $request->nama,
                    'nis' => $request->nis,
                    'jurusan' => $request->jurusan,
                    'kelas' => $request->kelas,
                ]);
                $userAttributes['anggota_id'] = $anggota->id;
            }
        } else {
            // changing to admin? maybe decouple anggota/delete it? 
            // For now let's just nullify the relationship if needed, 
            // but keeping the record might be safer or we just leave it. 
            // The requirement doesn't specify deep cleanup logic.
            // Let's at least ensure role update works.
            $userAttributes['anggota_id'] = null; 
        }

        $user->update($userAttributes);

        return redirect('/users')->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $anggotaId = $user->anggota->id;
        $user->destroy($id);
        anggota::destroy($anggotaId);


        return redirect('/users')->with('success', 'User berhasil dihapus');
    }
}
