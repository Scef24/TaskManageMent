@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    <div class="container">
        <h1 class="mt-4">Add New Task</h1>

        <form method="POST" action="{{ route('task.add') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" class="form-control" id="due_date" name="due_date" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                </select>
            </div>
            <div class="form-group">
                <label for="priority">Priority</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <input type="number" class="form-control" id="category_id" name="category_id" required>
            </div>
            <div class="form-group">
                <label for="user_id">User ID</label>
                <input type="number" class="form-control" id="user_id" name="user_id" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>
@endsection