@extends('layouts.app')

@section('content')
<header class="flex items-center mb-4 py-4">
   <div class="flex justify-between items-center w-full">
      <h3 class="text-base text-gray-600 font-normal">
         <a href="/projects"> My Projects </a>/ {{ $project->title }}
      </h3>
      <a href="{{ $project->path(). "/edit" }}"
         class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
         Edit Project
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
            @foreach ($project->tasks as $task)
            <div class="bg-white rounded-lg p-5 shadow mb-3">
               <form action="{{ $task->path() }}" method="POST">
                  @method('PATCH')
                  @csrf
                  <div class="flex items-center">

                     <input type="text" name="body" value="{{ $task->body }}"
                        class="w-full {{ $task->completed ? 'text-gray-400' : '' }}">
                     <input type="checkbox" name="completed" onchange="this.form.submit()"
                        {{ $task->completed ? 'checked' : '' }}>
                  </div>

               </form>
            </div>
            @endforeach

            <div class="bg-white rounded-lg p-5 shadow mb-3">
               <form action="{{ $project->path() . '/tasks' }}" method="POST">
                  @csrf

                  <input type="text" name="body" class="w-full" placeholder="Add a new task..">
               </form>

            </div>
         </div>

         <h2 class="text-lg font-normal text-gray-600 mb-3">
            Gereral Notes
         </h2>
         <form action="{{ $project->path() }}" method="POST">
            @csrf
            @method('PATCH')
            <textarea class="bg-white rounded-lg p-5 shadow w-full mb-3" name="notes" style="min-height:  200px"
               placeholder="Anything special that yout want to make a note of?">{{ $project->notes }}</textarea>
            <button type="submit" class="button">Save</button>
         </form>

         @if ($errors->any())
         <div class="field mt-6">
            @foreach ($errors->all() as $error)
            <li class="text-sm text-red-500">{{ $error }}</li>
            @endforeach
         </div>
         @endif
      </div>


         <div class="lg:w-1/4 px-3">
            @include('projects.card')
         </div>
      </div>

</main>


@endsection
