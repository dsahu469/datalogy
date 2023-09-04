<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Transaction;

class HomeController extends Controller
{
    public function index(){
        return view('home');
    }

    public function payment(){
        $intent = auth()->user()->createSetupIntent();

        return view('payment', compact('intent'));
    }

    public function purchase(Request $request){
        $user          = $request->user();
        $paymentMethod = $request->input('payment-method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($request->amount * 100, $paymentMethod);

            $transaction = Transaction::create([
                'user_id'     => $user->id,
                'amount'      => $request->amount,
            ]);
            
            return view('paymentSuccess');
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function transaction(){
        $transactions = Transaction::select(
            DB::raw('DATE(created_at) as transaction_date'),
            DB::raw('SUM(amount) as total_amount')
        )
        ->groupBy('transaction_date')
        ->orderBy('transaction_date', 'desc')
        ->get();

        return view('transaction', compact('transactions'));
    }
}
