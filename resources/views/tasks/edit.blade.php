@php
    $selectedType = old('start_type', $task->start_type ?? 'now');
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
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
        form {
            background: #fff;
            max-width: 500px;
            margin: 30px auto;
            padding: 30px 40px 20px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input[type="text"], textarea, select, input[type="datetime-local"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0 16px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<h1>Edit Task</h1>

<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Title:</label><br>
    <input type="text" name="title" value="{{ old('title', $task->title) }}" required><br><br>

    <label>Description:</label><br>
    <textarea name="description">{{ old('description', $task->description) }}</textarea><br><br>

    <label>Urgency:</label><br>
    <select name="urgent">
        @foreach (['low', 'medium', 'high', 'critical'] as $level)
            <option value="{{ $level }}" {{ old('urgent', $task->urgent) === $level ? 'selected' : '' }}>{{ ucfirst($level) }}</option>
        @endforeach
    </select><br><br>

    <label>Start Type:</label><br>
    <select name="start_type" id="start_type">
        <option value="now" {{ $selectedType === 'now' ? 'selected' : '' }}>Now</option>
        <option value="custom" {{ $selectedType === 'custom' ? 'selected' : '' }}>Custom</option>
        <option value="estimated" {{ $selectedType === 'estimated' ? 'selected' : '' }}>Estimated</option>
    </select><br><br>

    <!-- Custom Start & Due Dates -->
    <div id="custom_start_date" style="display: none;">
        <label>Start Date:</label>
        <input type="datetime-local" name="start_date"
            value="{{ old('start_date', $task->start_date ? $task->start_date->format('Y-m-d\TH:i') : '') }}">

        <label>Due Date:</label>
        <input type="datetime-local" name="due_date"
            value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d\TH:i') : '') }}">
    </div>

    <!-- Now Mode Due Date -->
    <div id="now_due_date" style="display: none;">
        <label>Due Date:</label>
        <input type="datetime-local" name="due_date"
            value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d\TH:i') : '') }}">
    </div>

    <!-- Estimated Time -->
    <div id="estimated_time" style="display: none;">
        <label>Estimated Time (in minutes):</label>
        <input type="number" name="estimated_minutes" min="1"
            value="{{ old('estimated_minutes', $task->estimated_minutes) }}">
    </div>

    <br>
    <button type="submit">Update Task</button>
</form>

<script>
function toggleFields() {
    const type = document.getElementById('start_type').value;

    document.getElementById('custom_start_date').style.display = (type === 'custom') ? 'block' : 'none';
    document.getElementById('estimated_time').style.display = (type === 'estimated') ? 'block' : 'none';
    document.getElementById('now_due_date').style.display = (type === 'now') ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', toggleFields);
document.getElementById('start_type').addEventListener('change', toggleFields);
</script>

</body>
</html>
