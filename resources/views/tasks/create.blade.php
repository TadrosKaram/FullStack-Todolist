@php
    $selectedType = old('start_type', isset($task) ? $task->start_type : 'now');
@endphp


<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
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
        input[type="text"], textarea, select, input[type="datetime-local"] {
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

<h1>Create Task</h1>

<form action="{{ route('tasks.store') }}" method="POST">
    @csrf

    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Urgency:</label><br>
    <select name="urgent">
        <option value="low" style="color: #007bff">Low</option>
        <option value="medium" style="color: orange">Medium</option>
        <option value="high" style="color: tomato">High</option>
        <option value="critical" style="color:darkred">Critical</option>
    </select><br><br>

    <label>Start Type:</label><br>
  <select name="start_type">
    <option value="now" {{ $selectedType === 'now' ? 'selected' : '' }}>Now</option>
    <option value="custom" {{ $selectedType === 'custom' ? 'selected' : '' }}>Custom</option>
    <option value="estimated" {{ $selectedType === 'estimated' ? 'selected' : '' }}>Estimated</option>
</select>
<br><br>

<!-- Custom Start Date -->
<div id="custom_start_date" style="display: none;">
    <label>Start Date:</label>
    <input type="datetime-local" name="start_date" class="form-control">
    
    <label>Due Date:</label>
    <input type="datetime-local" name="due_date" class="form-control">
</div>

<!-- Now Start Date (only due date needed) -->
<div id="now_due_date" style="display: none;">
    <label>Due Date:</label>
    <input type="datetime-local" name="due_date" class="form-control">
</div>

<!-- Estimated Field -->
<div id="estimated_time" style="display: none;">
    <label>Estimated Time (in minutes):</label>
    <input type="number" name="estimated_minutes" class="form-control" min="1">
</div>

<br>
<button type="submit">Create Task</button>
</form>

<script>
function toggleFields() {
    const type = document.querySelector('select[name="start_type"]').value;

    document.getElementById('custom_start_date').style.display = (type === 'custom') ? 'block' : 'none';
    document.getElementById('estimated_time').style.display = (type === 'estimated') ? 'block' : 'none';
    document.getElementById('now_due_date').style.display = (type === 'now') ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', toggleFields);
document.querySelector('select[name="start_type"]').addEventListener('change', toggleFields);
</script>


</body>
</html>
