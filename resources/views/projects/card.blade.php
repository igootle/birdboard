{{-- <div class="lg:w-1/3 px-3 pb-6"> --}}
    <div class="bg-white rounded-lg p-5 shadow" style="height:250px">
        <h2 class="font-normal text-xl py-4 -ml-5  border-l-4 border-blue-500 text-blue-700 p-4 -mr-5">
            <a href="{{ $project->path() }}" class="text-black">{{ $project->title }}</a>
        </h2>
        <div class="text-gray-600">{{ Str::limit($project->description, 150) }}</div>
    </div>
{{-- </div> --}}
