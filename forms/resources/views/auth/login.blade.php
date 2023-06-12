<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="card">
         <div class="card-body">
           <h5 class="card-title">Login</h5>
           <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="exampleFormControlInput1">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
          </div>
          
          <div class="d-flex justify-content-evenly">
               {{-- <a href="{{ url('register') }}" class="btn btn-primary btn-sm">Register</a> --}}
               <button type="submit" class="btn btn-primary btn-sm">Login</button>
          </div>
           
         </div>
       </div>
    </form>
</x-guest-layout>
