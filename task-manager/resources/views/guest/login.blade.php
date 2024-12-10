   <!-- resources/views/guest/login.blade.php -->
   @extends('layouts.app')

   @section('title', 'Login')

   @section('content')
       <div class="container">
           <h1 class="mt-4">Login</h1>

           <!-- Display Error Message -->
           @if(session('error'))
               <div class="alert alert-danger">
                   {{ session('error') }}
               </div>
           @endif

           <form method="POST" action="{{ route('login') }}">
               @csrf
               <div class="mb-3">
                   <label for="email" class="form-label">Email</label>
                   <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                   @error('email')
                       <div class="text-danger">{{ $message }}</div>
                   @enderror
               </div>

               <div class="mb-3">
                   <label for="password" class="form-label">Password</label>
                   <input id="password" type="password" name="password" class="form-control" required>
                   @error('password')
                       <div class="text-danger">{{ $message }}</div>
                   @enderror
               </div>

               <button type="submit" class="btn btn-primary">Login</button>
           </form>
       </div>
   @endsection