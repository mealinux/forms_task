<x-app-layout>
      <div class="row g-4">
         @foreach ($forms as $form)
         <div class="col-12 col-md-4">
            <div class="card text-center">
               <div class="card-header">
                 {{ $form->title }}
               </div>
               <div class="card-body">
                  @if($form->description)
                     <p class="card-text">{{ $form->description }}</p>
                  @endif
               
                  <a href="{{ url('form/'.$form->id) }}" class="btn btn-primary btn-sm">See Detail</a>
               </div>
               <div class="card-footer text-body-secondary">
                 {{ $form->created_at->diffForHumans() }}
               </div>
             </div>
         </div>
         @endforeach
      </div>
   <div class="row">
      <div class="col">
         {{ $forms->links('layouts.paginate') }}
      </div>
   </div>
     
</x-app-layout>