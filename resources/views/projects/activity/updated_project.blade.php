@if (count($activity->changes['after']) == 1)
   {{ $activity->user->name }}  updated the {{ $activity->changes['after']['notes'] }} of the project
@else
{{ $activity->user->name }} You updated the project
@endif
