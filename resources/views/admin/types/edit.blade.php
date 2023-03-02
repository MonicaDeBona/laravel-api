@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('admin.types.partials.form', [
            'method' => 'PUT',
            'routeName' => 'admin.types.update',
        ])
    </div>
@endsection
