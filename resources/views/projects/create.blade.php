<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
</head>

<body>

    <form action="/projects" method="POST" class="container" style="padding-top: 40px">
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
            </div>
        </div>

    </form>

</body>

</html>
