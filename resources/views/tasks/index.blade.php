<!DOCTYPE html>
<html>
<head>
    <title>Todo-list with Timer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }
        a {
            color: #fff;
            background: tomato;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            margin: 20px 0 20px 20px;
            display: inline-block;
        }
        a:hover {
            background: #0056b3;
        }
        table {
            margin: 30px auto;
            border-collapse: collapse;
            width: 90%;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        th, td {
            padding: 12px 16px;
            text-align: center;
        }
        th {
            background: red;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        button {
            background: #dc3545;
            color: #fff;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #a71d2a;
        }
    </style>
</head>
<body>

<h1>Todo-list</h1>
<a href="{{ route('tasks.create') }}" style="margin: 5vh 100vh">+ New Task</a>

<table border="1" cellpadding="10" cellspacing="0">
   <thead>
        <tr>
            
            <th>Title</th>
            <th>Urgent</th>
            <th>
                Start Date
                
            </th>
            <th>Due Date</th>
            <th>Completed</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($tasks as $task)
        <tr style="{{ $task->completed ? 'background-color: #d3d3d3; color: #888;' : '' }}">
    

            <td>
                {{ $task->title }}<br><br>
                <span style="color: darkgray">{{ $task->description }}</span>
            </td>

            <td>{{ ucfirst($task->urgent) }}</td>

            @if ($task->estimated_minutes)
                <td colspan="2">
                    {{ $task->estimated_minutes }}M [Estimated] <br>
          
                </td>
            @else
                <td>{{ $task->start_date }}</td>
                <td>{{ $task->due_date }}</td>
            @endif

            <td>
                <form method="POST" action="{{ route('tasks.toggle', $task->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                </form>
            </td>

            <td>
                <a href="{{ route('tasks.edit', $task->id) }}" style="background-color: purple">Edit</a> |
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this task?')">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7">No tasks found.</td></tr>
    @endforelse
    </tbody>
</table>



</body>
</html>
