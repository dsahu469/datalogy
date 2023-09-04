@extends('app')

@section('content')
<style>
    /* Center-align the table */
    .table-container {
        text-align: center;
    }

    .compact-table {
        font-size: 14px;
    }

    .compact-table th,
    .compact-table td {
        padding: 8px 12px;
    }

    .compact-table th {
        background-color: #f2f2f2;
    }

</style>
<div class="container">
    <h1>Transactions by Date</h1>
    <div class="table-container" style="margin-left: 42.5%;">
        <table class="table table-bordered compact-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->transaction_date }}</td>
                        <td>${{ number_format($transaction->total_amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection