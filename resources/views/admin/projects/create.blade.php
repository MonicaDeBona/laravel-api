@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('admin.projects.partials.form', [
            'method' => 'POST',
            'routeName' => 'admin.projects.store',
        ])
    </div>
@endsection
