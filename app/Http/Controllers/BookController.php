<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.Book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        if($request->isMethod('get')){
            return view('admin.Book.create');
        }

        if($request->isMethod('post')){
             $validate = $request->validate([
            'nama' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'stock' => 'required',
            'tahun_terbit' => 'required'
        ]);

        Book::create($validate);

        return redirect('/books')->with('success' , 'Book has been Created');
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
       $book =  Book::findOrFail($id);
       return view('admin.Book.update' , compact('book'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|unique:books,nama,' . $id,
            'penerbit' => 'required',
            'pengarang' => 'required',
            'stock' => 'required',
            'tahun_terbit' => 'required'
        ]);

        $book->update($data);

        return redirect('/books')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::destroy($id);

        return redirect('/books')->with('success','Berhasil hapus data');
    }
}
