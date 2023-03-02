@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="col-md-4 d-flex justify-content-end">
            <a href="{{ route('admin.projects.trashed') }}" class="btn btn-sm btn-primary me-auto">
                <i class="fa-solid fa-trash"></i>
            </a>
        </div>
        @if (session('message'))
            <div class="alert alert-{{ session('alert-type') }}">
                {{ session('message') }}
            </div>
        @endif
        <table class="table table-striped table-bordered table-hover mt-5">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Name</th>
                    <th scope="col"># of types</th>
                    <th scope="col" class="text-center">
                        <a href="{{ route('admin.types.create') }}" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <td>{{ $type->id }}</td>
                        <td>{{ $type->name }}</td>
                        <td>{{ count($type->projects) }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.types.show', $type->slug) }}" class="btn btn-sm btn-primary"><i
                                    class="fa-solid fa-eye"></i></a>
                            <a href="{{ route('admin.types.edit', $type->slug) }}" class="btn btn-sm btn-success"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.types.destroy', $type->slug) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $types->links() }}
    </div>
@endsection
