@extends('be.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Size Table</h3>
            <a class="float-right btn btn-primary" href="{{ route('admin.size.add') }}">Add</a>

        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 60px">#</th>
                        <th>Size</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                @php
                    $r = 0;
                @endphp
                <tbody>
                    @foreach ($lists as $item)
                        <tr>
                            <td>{{ ++$r }}</td>
                            <td>{{ $item->size }}</td>
                            <td>
                                <a href="{{ route('admin.size.edit', $item->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border
                    border-blue-700 rounded">Edit</a>
                                <a href="{{ route('admin.size.delete', $item->id) }}"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border
                    border-red-700 rounded"
                                    onclick="return confirm('Do you want to delete this ?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>
@endsection
