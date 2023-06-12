<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="card">
         <div class="card-body">
           <h5 class="card-title">Register</h5>
           <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('email') }}" id="exampleFormControlInput1">
          </div>
           <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="exampleFormControlInput2">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleFormControlInput3">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlInput4" class="form-label">Password Confirmation</label>
            <input type="password"  name="password_confirmation"  class="form-control" id="exampleFormControlInput4">
          </div>
          <div class="d-flex justify-content-evenly">
            <a href="{{ url('login') }}" class="btn btn-primary btn-sm">Login</a>
            <button type="submit" class="btn btn-primary btn-sm">Register</button>
          </div>
           
         </div>
    </form>
</x-guest-layout>
