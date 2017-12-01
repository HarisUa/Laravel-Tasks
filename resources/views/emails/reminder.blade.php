<html>
<head></head>
<body>
<p>You got new task from {{ $fromuser }}</p>
<p>Details:</p>
<p>Task title: {{ $task->title }}</p>
<p>Task Body:</p>
<p>{!! $task->text !!}</p>
<p>Deadline: {{ $task->deadline }}</p>
</body>
</html>