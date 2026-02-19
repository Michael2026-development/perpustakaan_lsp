<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\anggota;
use App\Models\Book;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userCount = User::all()->count();
        $anggotaCount = anggota::all()->count();
        $bookCount = Book::all()->count();
        $orderCount = Orders::all()->count();

        return view('admin.Dashboard', compact('userCount', 'anggotaCount', 'bookCount', 'orderCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
