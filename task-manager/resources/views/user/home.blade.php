@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <h1 class="mt-4">Welcome, {{ Auth::user()->first_name }}!</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p>Ready to Finish some task?</p>

       
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">
            Add Task
        </button>

  
        <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                <select class="form-control" id="category_id" name="category_id" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            Add Category
        </button>

        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('categories.add') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

      
           <table class="table mt-4">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Category</th>
                    <th>Actions</th>
                    <th>Done</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->priority }}</td>
                        <td>{{ $task->category->name }}</td>
                        <td>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}">
                                Edit
                            </button>
                            <form method="POST" action="{{ route('task.delete', $task->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                        <td>
                            <form method="get" action="{{ route('task.done', $task->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Done</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Task Modal -->
                    <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" aria-labelledby="editTaskModalLabel{{ $task->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTaskModalLabel{{ $task->id }}">Edit Task</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('task.edit', $task->id) }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="due_date">Due Date</label>
                                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $task->due_date }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status" required>
                                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="priority">Priority</label>
                                            <select class="form-control" id="priority" name="priority" required>
                                                <option value="low" {{ $task->priority == 'low' ? 'selected' : '' }}>Low</option>
                                                <option value="medium" {{ $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                                                <option value="high" {{ $task->priority == 'high' ? 'selected' : '' }}>High</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select class="form-control" id="category_id" name="category_id" required>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Task</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
