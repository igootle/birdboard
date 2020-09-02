<?php

namespace App;
use Illuminate\Support\Arr;


trait RecordsActivity
{
   public $oldAttributes = [];

   // Boot the trait.
   public static function bootRecordsActivity()
   {

      foreach (self::recordableEvents() as $event) {
         static::$event(function ($model) use ($event) {
            $model->recordActivity($model->activityDescription($event));
         });

         if ($event === 'updated') {
            static::updating(function ($model) {
               $model->oldAttributes = $model->getOriginal();
            });
         }

      }

   }

   public function activityDescription($description)
   {

      return  "{$description}_" . strtolower(class_basename($this)); // created_task

   }

   public static function recordableEvents()
   {
      # code...

      if (isset(static::$recordableEvents)) {
         return static::$recordableEvents;
      } else {
         return ['created', 'updated', 'deleted'];
      }

   }

   public function recordActivity($description)

   {
     // var_dump($this->old, $this->toArray());
     $this->activity()->create([
        'description' => $description,
        'changes' => $this->activityChanges(),
        'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
     ]);

   }

   public function activity()
   {
         return $this->morphMany(Activity::class, 'subject')->latest();
   }

   public function activityChanges()
   {

     if ($this->wasChanged()) {
        return [
           'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
           'after' => Arr::except($this->getChanges(),  'updated_at') // []
        ];
     }

   }





}
