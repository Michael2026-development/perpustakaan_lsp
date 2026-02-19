<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Display siswa dashboard with orders and history.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        // Get active orders (not returned yet)
        $activeOrders = [];
        // Get history (returned books)
        $history = [];

        if ($anggota) {
            $activeOrders = Orders::with('book')
                ->where('anggota_id', $anggota->id)
                ->whereNull('tanggal_kembali')
                ->orderBy('tanggal_pinjam', 'desc')
                ->get();

            $history = Orders::with('book')
                ->where('anggota_id', $anggota->id)
                ->whereNotNull('tanggal_kembali')
                ->orderBy('tanggal_kembali', 'desc')
                ->get();
        }

        return view('siswa.Dashboard', compact('user', 'anggota', 'activeOrders', 'history'));
    }

    /**
     * Show the borrow book form.
     */
    public function createOrder(Request $request)
    {
        if ($request->isMethod('get')) {
            $books = Book::where('stock', '>', 0)->get();
            return view('siswa.order-create', compact('books'));
        }

        if ($request->isMethod('post')) {
            $user = Auth::user();
            $anggota = $user->anggota;

            if (!$anggota) {
                return redirect()->back()->withErrors(['error' => 'Your account is not linked to a member profile. Please contact the administrator.']);
            }

            $request->validate([
                'book_id' => 'required|exists:books,id',
            ]);

            $book = Book::findOrFail($request->book_id);

            // Check if book is available
            if ($book->stock < 1) {
                return redirect()->back()->withErrors(['book_id' => 'This book is currently not available.']);
            }

            // Check if student already has this book borrowed
            $existingOrder = Orders::where('anggota_id', $anggota->id)
                ->where('book_id', $request->book_id)
                ->whereNull('tanggal_kembali')
                ->first();

            if ($existingOrder) {
                return redirect()->back()->withErrors(['book_id' => 'You already have this book borrowed.']);
            }

            // Create the order
            Orders::create([
                'anggota_id' => $anggota->id,
                'book_id' => $request->book_id,
                'tanggal_pinjam' => now(),
            ]);

            // Decrease stock
            $book->decrement('stock');

            return redirect('/siswa/dashboard')->with('success', 'Book borrowed successfully!');
        }
    }

    /**
     * Show order history page.
     */
    public function history()
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        $history = [];
        if ($anggota) {
            $history = Orders::with('book')
                ->where('anggota_id', $anggota->id)
                ->whereNotNull('tanggal_kembali')
                ->orderBy('tanggal_kembali', 'desc')
                ->get();
        }

        return view('siswa.history', compact('history'));
    }

    /**
     * Show return book page with active orders.
     */
    public function returnBook()
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        $activeOrders = [];
        if ($anggota) {
            $activeOrders = Orders::with('book')
                ->where('anggota_id', $anggota->id)
                ->whereNull('tanggal_kembali')
                ->orderBy('tanggal_pinjam', 'desc')
                ->get();
        }

        return view('siswa.return', compact('activeOrders'));
    }

    /**
     * Process book return.
     */
    public function processReturn(string $id)
    {
        $user = Auth::user();
        $anggota = $user->anggota;

        if (!$anggota) {
            return redirect()->back()->withErrors(['error' => 'Your account is not linked to a member profile.']);
        }

        // Find the order and verify ownership
        $order = Orders::where('id', $id)
            ->where('anggota_id', $anggota->id)
            ->whereNull('tanggal_kembali')
            ->first();

        if (!$order) {
            return redirect()->back()->withErrors(['error' => 'Order not found or already returned.']);
        }

        // Set return date
        $order->tanggal_kembali = now();
        $order->save();

        // Increment book stock
        $book = Book::findOrFail($order->book_id);
        $book->increment('stock');

        return redirect('/siswa/return')->with('success', 'Buku berhasil dikembalikan!');
    }
}
