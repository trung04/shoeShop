@extends('be.layout')
@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Voucher Table</h3>

            <a href="{{ route('admin.voucher.add') }}"
                class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Add</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">Stt</th>
                        <th>Type</th>
                        <th>Discount_amount</th>
                        <th>Coin</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                @php
                    $r = 0;
                @endphp
                <tbody>
                    @foreach ($lists as $list)
                        <tr>
                            <td>{{ ++$r }}</td>
                            <td>
                                @switch($list->type)
                                    @case(1)
                                        Percentage
                                    @break

                                    @case(2)
                                        Direct Amount
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>{{ $list->discount_amount }}</td>
                            <td> {{ number_format($list->coin, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.voucher.edit', $list->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">Edit</a>
                                <a href="{{ route('admin.voucher.delete', $list->id) }}"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border border-red-700 rounded">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">«</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
        </div>
    </div>
@endsection
