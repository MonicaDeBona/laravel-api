@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('admin.technologies.partials.form', [
            'method' => 'PUT',
            'routeName' => 'admin.technologies.update',
        ])
    </div>
@endsection
