<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class MyTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $query = Transaction::with(['user'])->where('user_id', Auth::user()->id);
            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                    <a href="' . route('dashboard.my-transaction.show', $item->id) . '" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 mx-2 rounded shadow-lg">
                    Show
                    ';
                })
                ->editColumn('total_price', function ($item) {
                    return number_format($item->total_price);
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('pages.dashboard.transaction.index');
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
    public function show(Transaction $myTransaction)
    {
        if (request()->ajax()) {

            $query = TransactionItems::with(['product'])->where('transaction_id', $myTransaction->id);
            return DataTables::of($query)

                ->editColumn('product.price', function ($item) {
                    return number_format($item->product->price);
                })

                ->make();
        }

        return view('pages.dashboard.transaction.show', [
            'transaction' => $myTransaction
        ]);
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
