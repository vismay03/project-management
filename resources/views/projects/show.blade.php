@extends('welcome')


@section('content')
<div>
    <a href="{{ route('projects.index') }}" type="button" class="btn btn-primary mb-3">View</a>
    <div class="card">
        <div class="card-body">
           

            <p class="card-text"> <small>Project Name: </small>{{ $project->name }}</p>
            <p class="card-text"> <small>Project Description: </small> {{ $project->description }}</p>
            <p class="card-text"> <small class="text-muted">Start Date: {{ $project->start_date }}</small></p>

            <a href="" type="button" class="btn btn-primary mb-3">Add task</a>
        </div>


    </div>
@endsection