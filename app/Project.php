<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;


class Project extends Model
{



    protected $guarded = [];

    public $old = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {

      return  $this->tasks()->create(compact('body'));


    }

    public function recordActivity($description)

    {

      // var_dump($this->old, $this->toArray());
      $this->activity()->create([
         'description' => $description,
         'changes' => $this->activityChanges($description)
      ]);

    }

    public function activityChanges($description)
    {

      if ($description == 'updated') {
         return [
            'before' => Arr::except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
            'after' => Arr::except($this->getChanges(),  'updated_at') // []
         ];
      }

    }

   public function activity()
   {
         return $this->hasMany(Activity::class)->latest();
   }

}
