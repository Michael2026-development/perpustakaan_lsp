<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\anggota;
use App\Models\Book;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::with(['anggota','book'])->get();
        return view('admin.Order.index' , compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->isMethod('get')){
            $books =  Book::all();
            $anggotas = anggota::all();

            return view('admin.Order.create' , compact(['books', 'anggotas']));
     }

        if ($request->isMethod('post')){
            $validate = $request->validate([
                'anggota_id' => 'required',
                'book_id' => 'required',
                'tanggal_pinjam' => 'required',
            ]);
            $book = Book::findOrFail($request->book_id);
          
            $book->decrement('stock');

            Orders::create($validate);

            return redirect('/orders')->with('success', 'Order has been sucessfully created');
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
        $order = Orders::findOrFail($id);
        $books = Book::all();
        $anggotas = anggota::all();

        return view('admin.Order.update', compact('order', 'books', 'anggotas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Orders::findOrFail($id);

        $validate = $request->validate([
            'anggota_id' => 'required',
            'book_id' => 'required',
            'tanggal_pinjam' => 'required',
        ]);

        if ($request->filled('tanggal_kembali') && $order->tanggal_kembali === null){
            $validate['tanggal_kembali'] = $request->tanggal_kembali;
            $book = Book::findOrFail($request->book_id);
            $book->increment('stock');
        }

        $order->update($validate);

        return redirect('/orders')->with('success', 'Order has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Orders::destroy($id);


        return redirect()->back()->with('success', 'Berhasil hapus data');
    }
}
