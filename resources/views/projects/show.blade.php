@extends('layouts.app')

@section('content')

    <h1>{{ $project->title }}</h1>
    {{ $project->description }}
    <a href="/projects">Go Back</a>

@endsection
