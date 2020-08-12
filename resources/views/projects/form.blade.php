

   @csrf

   <div class="field mb-6">
       <div class="label text-sm mb-2 block" for="title">Title</div>

       <div class="control">
           <input type="text" class="input bg-transparent border border-gray-500 rounded p-2 text-xs w-full" name="title" placeholder="Title" value="{{ $project->title }}">
       </div>
   </div>
   <div class="field mb-6">
       <div class="label text-sm mb-2 block" for="description">Description</div>

       <div class="">
           <textarea name="description" id=""  rows="4" class="textarea bg-transparent border border-gray-500 rounded p-2 text-xs w-full" placeholder="description" >{{ $project->description }}</textarea>
       </div>
   </div>
   <div class="field">
       <div class="control">
           <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">{{ $buttonText }}</button>
           <a href="{{ $project->path() }}">Cancel</a>
       </div>
   </div>

   @if ($errors->any())
      <div class="field mt-6">
          @foreach ($errors->all() as $error)
              <li class="text-sm text-red-500">{{ $error }}</li>
          @endforeach
      </div>
   @endif


