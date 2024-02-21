@extends('be.layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Material</h3>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 60px">#</th>
                        <th>Name</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $r = 0;
                    @endphp
                    @foreach ($lists as $item)
                        <tr>
                            <td>{{ ++$r }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('admin.material.edit', $item->id) }}"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border
                border-blue-700 rounded">Edit</a>
                                <a href="{{ route('admin.material.delete', $item->id) }}"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 border
                border-red-700 rounded"
                                    onclick="return confirm('Do you want to delete this ?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $lists->links() }}
        </div>

    </div>
@endsection
