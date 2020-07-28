@extends('layouts.app')

@section('content')

<form action="/projects" method="POST"  >
    <h1 class="heading is-1" >Create a Project</h1>
    @csrf
    <div class="field">
        <div class="label" for="title">Title</div>

        <div class="">
            <input type="text" class="input" name="title" placeholder="Title">
        </div>
    </div>
    <div class="field">
        <div class="label" for="description">Description</div>

        <div class="">
            <textarea name="description" id=""  rows="4" class="textarea" placeholder="description"></textarea>
        </div>
    </div>
    <div class="field">
        <div class="control">
            <button type="submit" class="button is-link">Create Project</button>
            <a href="/projects">Cancel</a>
        </div>
    </div>

</form>


@endsection
