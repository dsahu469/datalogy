@extends('app')
@section('content')    
    <div class="container">
        <div class="donate-btn" style="margin-top: 30px">
            <a href="{{ url('payment') }}" style="padding: 15px; background: #1d1e6d; color: #fff; border-radius: 10px; border: 0px; text-decoration: none;">Donate With Stripe</a>
            <a href="{{ url('transaction') }}" style="padding: 15px; background: #1d1e6d; color: #fff; border-radius: 10px; border: 0px; text-decoration: none;">Get Transactions</a>
        </div>
    </div>
@endsection