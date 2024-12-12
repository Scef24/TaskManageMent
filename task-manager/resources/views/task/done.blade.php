@extends('layouts.app')
@section('title','Done Tasks')
@section('content')
@if(session('Success'))
    <div class="alert alert-success">
        {{ session('Success') }}
    </div>
@endif  
    <div class="container">
        <h1 class="mt-4">Welcome, {{ Auth::user()->first_name }}!</h1>
    </div>
    <div class="container">
      <h3>Here is your finished Task!</h3>
    </div>
<table class="table mt-4">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Priority</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->due_date }}</td>
            <td>{{ $task->priority }}</td>
        </tr>
        @endforeach
    </tbody>
</table>    

@endsection