@extends('layouts.app')

@section('content')
<header class="flex items-center mb-4 py-4">
    <div class="flex justify-between items-center w-full">
        <h3 class="text-base text-gray-600 font-normal">
           <a href="/projects"> My Projects </a>/ {{ $project->title }}
        </h3>
        <a href="/projects/create" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            New Project
        </a>
    </div>
</header>
<main>
    <div class="lg:flex -mx-3">
        <div class="lg:w-3/4 px-3 mb-6">
            <div class="mb-8">
                <h2 class="text-lg font-normal text-gray-600 mb-3">
                    Tasks
                </h2>
                <div class="bg-white rounded-lg p-5 shadow mb-3">
                    Lorem ipsum dolor.
                </div>
                <div class="bg-white rounded-lg p-5 shadow mb-3">
                    Lorem ipsum dolor.
                </div>
                <div class="bg-white rounded-lg p-5 shadow mb-3">
                    Lorem ipsum dolor.
                </div>
                <div class="bg-white rounded-lg p-5 shadow">
                    Lorem ipsum dolor.
                </div>
            </div>

            <h2 class="text-lg font-normal text-gray-600 mb-3">
                Gereral Notes
            </h2>
            <textarea class="bg-white rounded-lg p-5 shadow w-full" style="min-height:  200px">Lorem ipsum.</textarea>
        </div>
        <div class="lg:w-1/4 px-3">
            @include('projects.card')
        </div>
    </div>
</main>


@endsection
