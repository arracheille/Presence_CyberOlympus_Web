<x-app-layout>
    <h2>Edit Board</h2>
    <form action="/edit-board/{{ $board->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $board->title }}">
        <button>Edit</button>
    </form>
</x-app-layout>