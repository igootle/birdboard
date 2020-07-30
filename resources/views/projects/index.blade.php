@extends('layouts.app')

@section('content')

<header class="flex items-center mb-4 py-4">
<div class="flex justify-between items-center w-full">
    <h3 class="text-xl text-gray-600 font-normal">My Projects</h3>
    <a href="/projects/create" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">New Project</a>
</div>

</header>

<main class="lg:flex lg:flex-wrap -mx-3">
    @forelse ($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6">
        @include('projects.card')
    </div>
    @empty
    <div>No projects yet.</div>
    @endforelse
</div>


</main>

</html>
@endsection
