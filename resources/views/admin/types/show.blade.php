@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2 class="m-3 p-2 fw-bold text-center">
            {{ $type->name }} projects
        </h2>
        @foreach ($type->projects as $project)
            <div class="card mb-3 mt-5">
                <div class="card-header text-center">
                    <h5 class="card-title">{{ $project->title }}</h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <p class="card-text text-center">{{ $project->content }}</p>
                    <form action="{{ route('admin.projects.clearType', $project) }}" method="POST" class="d-inline-block p-1">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                    </form>
                    <p class="card-text text-center">
                        <small class="text-muted">Author: {{ $project->author }}</small><br>
                        <small class="text-muted">Posted on: {{ $project->project_date }}</small>
                    </p>
                </div>

            </div>
        @endforeach
    </div>
@endsection
