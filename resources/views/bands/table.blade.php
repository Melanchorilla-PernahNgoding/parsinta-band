@extends('layouts.backend')


@section('content')
@include('alert')
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Genres</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bands as $index => $band)
            <tr>
                <td>{{ $bands->count() * ($bands->currentPage() - 1) + $loop->iteration }}</td>
                <td>{{ $band->name }}</td>
                <td>{{ $band->genres()->get()->implode('name', ',') }}</td>
                <td>
                    <a href="{{ route('bands.edit', $band->slug) }}" class="btn btn-primary btn-sm">Edit</a>
                    <div endpoint="{{ route('bands.delete', $band->slug) }}" class="delete d-inline"></div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $bands->links() }}
@endsection