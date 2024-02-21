@extends('be.layout')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Voucher</h3>
        </div>
        <form method="post" action="{{ route('admin.voucher.doAdd') }}">
            @csrf
            <div class="card-body">
                <div>
                    <label>Type</label>
                    <select name="type" class="form-control">
                        <option value="1">Percentage</option>
                        <option value="2">Direct Amount</option>
                    </select>
                </div>
                <br>
                <div class="form-group">
                    <label>Discount Amount</label>
                    <input type="number" name="discount_amount" class="form-control" placeholder="Enter Discount Amount">
                </div>
                <div class="form-group">
                    <label>Coin</label>
                    <input type="number" name="coin" class="form-control" placeholder="Enter Voucher's Coin">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Submit</button>
            </div>
        </form>
    </div>
@endsection
