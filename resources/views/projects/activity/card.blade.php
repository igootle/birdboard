<div class="bg-white rounded-lg p-5 shadow mt-5 mb-5 ">
   <ul class="text-sm list-reset">

      @foreach ($project->activity as $activity)
      <li class="{{ $loop->last ? '' : 'mb-1' }}">
         @include("projects.activity.{$activity->description}")
         <span class="text-gray-600"> {{ $activity->created_at->diffForHumans(null, true) }} </span>
      </li>
      @endforeach
   </ul>
</div>
