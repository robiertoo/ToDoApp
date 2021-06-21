@extends('layouts.app')
@section('title', 'ToDo List')
@section('content')

    <h2>ToDo List!</h2>

    <form method='post' action="{{ route('tasks.store') }}">
        @csrf
        <div class='d-flex justify-content-center'>
            <input type="text" class='form-control w-75' name='name' placeholder='Insert new task...' autofocus required>
            <button type='submit' class='btn btn-sm btn-primary ms-2'>Create</button>
        </div>
    </form>

    @if (!count($tasks))
        <h1>No task were found!</h1>
    @else
        <table class='mt-2 table table-hover'>
            <thead class='bg-dark text-light'>
                <tr>
                    <th>Task</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    @if ($task->completed === NULL)
                        <tr>
                            <td>{{ $task->name }}</td>
                            <td class='d-flex justify-content-center'>
                                <div class='me-2'>
                                    <form action="{{ url('tasks/'.$task->id.'/complete') }}" method='GET'>
                                        @csrf
                                        <button class='btn btn-sm btn-info'>
                                            Complete
                                        </button>
                                    </form>
                                </div>
                                <div>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method='POST'>
                                        @csrf
                                        @method('DELETE')
                                        <button class='btn btn-danger btn-sm'>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td><del>{{ $task->name }}</del></td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($task->updated_at)) }}</td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @endif

    <div class='fixed-bottom w-100'>
        @if ($message = Session::get('success'))
            <div class='alert alert-success'>
                <p class='mb-0'>{{ $message }}</p>
            </div>
        @endif
    </div>
@endsection