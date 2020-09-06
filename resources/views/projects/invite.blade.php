<div class="bg-white rounded-lg p-5 shadow flex-col" >
   <h2 class="font-normal text-xl py-4 -ml-5  border-l-4 border-blue-500 text-blue-700 p-4 -mr-5">
      Invite a User
   </h2>


   <footer>
      <form action="{{ $project->path() . '/invitations' }}"  method="POST" class="text-right">

         @csrf

         <input type="email" name="email" class="border border-grey rounded w-full py-2 px-3 mb-2" placeholder="Email address">

         <button type="submit" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">invite</button>
      </form>
      @include('errors', ['bag' => 'invitations'] )
   </footer>

   </div>
