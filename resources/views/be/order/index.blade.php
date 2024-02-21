<?php
use Carbon\Carbon;

?>
@extends('be.layout')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                    <div class="float-left" style="display:flex;gap:10px">
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}" class="status">All</a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}" class="status">Pending</a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'processing']) }}"
                            class="status">Processing</a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'success']) }}" class="status">Success</a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'canceled']) }}" class="status">Canceled</a>
                    </div>
                    <div class="float-right" style="display:flex;gap:10px">
                        <div class="">
                            <form action="{{ route('be.order.list') }}">
                                @csrf
                                <div class="input-group input-group-sm flex space-y-0 justify-center items-center">
                                    <input type="search" name="query" class="form-control float-right focus:outline-none"
                                        placeholder="Search" name="keyword">
                                    <button type="submit" class="btn btn-default h-8 flex justify-center items-center">
                                        <i class="fas fa-search"></i>
                                        <div class="input-group-append">
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="btn-group">
                            <button type="button"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Month</button>
                            <button type="button"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 rounded-l dropdown-toggle"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            {{-- <div class="dropdown-menu" role="menu" style="">
                                @foreach ($months as $month => $value)
                                <a class="dropdown-item"
                                href="{{route('be.order.list')}}?month={{$month}}">{{$month}}</a>

                                @endforeach

                            </div> --}}
                            <div class="dropdown-menu" role="menu">
                                <label for="" class="dropdown-item ">
                                    <a href="{{ request()->fullUrlWithQuery(['month' => 'all']) }}"
                                        style="width:100%">All</a>
                                </label>
                                @foreach ($months as $month => $value)
                                    <label for="" class="dropdown-item ">
                                        <a href="{{ request()->fullUrlWithQuery(['month' => $month]) }}"
                                            style="width:100%">{{ $month }}</a>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if ($status)
                        <p>Status:{{ $status }}
                        </p>
                    @endif
                    @if (request()->month)
                        Tháng:{{ request()->month }}
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Mã đơn hàng</th>
                                <th>Full Name</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Time</th>
                                <th>Số lượng:{{ $count }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $r = 0;
                            @endphp

                            @foreach ($list as $item)
                                <tr>
                                    <td>{{ ++$r }}</td>
                                    <td style="text-align:center">{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>

                                    <td>{{ number_format($item->total, 0, ',', '.') }}Đ</td>
                                    <td>
                                        @switch($item->status)
                                            @case(0)
                                                <span class="badge badge-warning">Waiting for confirm</span>
                                            @break

                                            @case(1)
                                                <span class="badge badge-warning">Pending</span>
                                            @break

                                            @case(2)
                                                <span class="badge badge-primary">Processing</span>
                                            @break

                                            @case(3)
                                                <span class="badge badge-success">Success</span>
                                            @break

                                            @case(4)
                                                <span class="badge badge-danger">Canceled</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{ Carbon::parse($item->created_at)->toDateString() }}</td>
                                    <td>
                                        <a class="btn btn-warning"
                                            href="{{ route('be.order.detail', ['id' => $item->id]) }}">Detail</a>

                                        <div class="btn-group">
                                            <button type="button"
                                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Change
                                                Status</button>
                                            <button type="button"
                                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 rounded-l dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                                <a class="dropdown-item"
                                                    href="{{ route('be.order.changeStatus', ['id' => $item->id, 'status' => 1, 'user_id' => $item->user_id]) }}">Pending</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('be.order.changeStatus', ['id' => $item->id, 'status' => 2, 'user_id' => $item->user_id]) }}">Processing</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('be.order.changeStatus', ['id' => $item->id, 'status' => 3, 'user_id' => $item->user_id]) }}">Succeed</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('be.order.changeStatus', ['id' => $item->id, 'status' => 4, 'user_id' => $item->user_id]) }}">Cancel</a>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{ $list->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
