@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('admin.projects.partials.form', [
            'method' => 'PUT',
            'routeName' => 'admin.projects.update',
        ])
    </div>
@endsection
