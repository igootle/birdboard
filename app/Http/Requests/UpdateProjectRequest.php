<?php

namespace App\Http\Requests;

use App\Project;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate as FacadesGate;

class UpdateProjectRequest extends FormRequest
{

    public function authorize()
    {
       return FacadesGate::allows('update', $this->project());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'title' => 'sometimes | required',
            'description' => 'sometimes | required',
            'notes' => 'nullable'
        ] ;
    }

    public function project()
    {
       return Project::findOrFail($this->route('project'));
      //  return $this->route('project');
    }

    public function save()
    {

      // $project = $this->project();

      // $project->update($this->validated());

      return tap($this->project())->update($this->validated());

      // return $project;

      // $this->project()->update($this->validated());
    }

}
