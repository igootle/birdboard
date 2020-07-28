@extends('layouts.app')

@section('content')

<div class="flex items-center mb-4">
    <h1 class="mr-auto">Birdboard</h1>
    <a href="/projects/create">New Project</a>

</div>

<div class="flex">
    @forelse ($projects as $project)
    <div class="bg-white mr-4 rounded p-5 shadow w-1/3" style="height: 200px">
        <h2 class="font-normal text-xl py-4">{{ $project->title }}</h2>
        <div class="text-gray-600">{{ Illuminate\Support\str::limit($project->description, 150) }}</div>
    </div>
    @empty
    <div>No projects yet.</div>
    @endforelse
</div>


</body>

</html>
@endsection
