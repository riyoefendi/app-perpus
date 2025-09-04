<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\DetailBorrow;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\Borrows;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrows = Borrows::with('member', 'detailMember')->orderBy('id','desc')->get();
        return view('admin.pinjam.index', compact('borrows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //    get data dari model (get sama all sama)
        $kode = "PJM";
        $today = Carbon::now()->format('Ymd');
        $prefix = $kode . "-" . $today;
        $lastTransaction = Borrows::whereDate('created_at', Carbon::today())->orderBy('id', 'desc')->first();
        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction->trans_number, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }
        $trans_number = $prefix . $newNumber;
        $members = Member::get();
        $categories = Category::get();
        return view('admin.pinjam.create', compact('members', 'categories', 'trans_number'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $insertBorrow = Borrows::create ([
            'id_anggota' => $request->id_anggota,
            'trans_number' => $request->trans_number,
            'return_date' => $request->return_date,
            'note' => $request->note,
        ]);

        foreach ($request->id_buku as $key => $value) {
            DetailBorrow::create([
                'id_borrow' => $insertBorrow->id,
                'id_book' => $request->id_book[$key],
            ]);
        }
        DB::commit();
        return redirect()->to('transcation');

        } catch (\Throwable $th){
            //thorw $th;
            DB::rollBack();
            //return redirect()->to('transaction);
        }


        return redirect()->to('transaction');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $borrow = Borrows::with('detailBorrow.book','member')->find($id);
        return view('admin.pinjam.show', compact('borrow'));
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
    public function getBukuByIdCategory($id_category)
    {
        try {
            $books = Book::where('id_kategori', $id_category)->get();
            return response()->json([
                'status' => 'success',
                'message' => 'fetch book success',
                'data' => $books
            ]);
            DB::commit();
            return redirect()->tid('print-peminjam', $insertBorrow->id);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }

    }

    public function print($id_borrow)
    {
        $borrow = Borrows::with('member','detailBorrow.book')->find($id_borrow);
        return view('admin.pinjam.print', compact('borrow'));
    }
}
