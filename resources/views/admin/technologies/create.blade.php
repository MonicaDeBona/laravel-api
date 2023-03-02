@extends('layouts.admin')

@section('content')
    <div class="container">
        @include('admin.technologies.partials.form', [
            'method' => 'POST',
            'routeName' => 'admin.technologies.store',
        ])
    </div>
@endsection
