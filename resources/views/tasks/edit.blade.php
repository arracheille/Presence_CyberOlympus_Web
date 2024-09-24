<x-app-layout>
    <h2>Edit Task</h2>
    <form action="/edit-task/{{ $task->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $task->title }}">
        <button>Edit</button>
    </form>
</x-app-layout>