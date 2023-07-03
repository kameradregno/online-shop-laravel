<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Models\Carts;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\TransactionItems;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $products = Products::with(['gallery'])->latest()->get();

        return view('pages.frontend.index', compact('products'));
    }

    public function details(Request $request, $slug)
    {
        $product = Products::with(['gallery'])->where('slug', $slug)->firstOrFail();

        $recommendations = Products::with(['gallery'])->inRandomOrder()->limit(4)->get();

        return view('pages.frontend.details', compact('product', 'recommendations'));
    }

    public function cartAdd(Request $request, $id)
    {
        Carts::create([

            'user_id' => Auth::user()->id,
            'product_id' => $id

        ]);

        return redirect('cart');
    }

    public function cartDelete(Request $request, $id)
    {
        $item = Carts::findOrFail($id);

        $item->delete();

        return redirect('cart');
    }

    public function cart(Request $request)
    {
        $carts = Carts::with(['product.gallery'])->where('user_id', Auth::user()->id)->get();

        return view('pages.frontend.cart', compact('carts'));
    }

    public function checkout(CheckoutRequest $request)
    {
        $data = $request->all();

        // ambil data carts

        $carts = Carts::with(['product'])->where('user_id', Auth::user()->id)->get();

        // data tambah transaksi

        $data['user_id'] = Auth::user()->id;
        $data['total_price'] = $carts->sum('product.price');

        // buat transaksi

        $transaction = Transaction::create($data);

        // buat item transaksi

        foreach ($carts as $cart) {
            $items[] = TransactionItems::create([
                'transaction_id' => $transaction->id,
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
            ]);
        }

        // hapus cart setelah transaksi

        Carts::where('user_id', Auth::user()->id)->delete();

        // konfigurasi

        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');;
        Config::$isSanitized = config('services.midtrans.isSanitized');;
        Config::$is3ds = config('services.midtrans.is3ds');

        // setup variable midtrans

        $midtrans = [
            'transaction_details' => [
                'order_id' => 'LUX-' . $transaction->id,
                'gross_amount' => (int) $transaction->total_price
            ],
            'customer_details' => [
                'first_name' => $transaction->name,
                'email' => $transaction->email
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        // proses pembayaran
        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function success(Request $request)
    {
        return view('pages.frontend.success');
    }
}
