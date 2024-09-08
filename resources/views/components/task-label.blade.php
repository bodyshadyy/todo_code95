<div class="mt-1 py-2 hover:bg-gray-100 flex items-center">
    <form action="{{ route('tasks.update', $todolist) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <input type="radio" name="completed" value="1"  onChange="this.form.submit()">
    </form>

    <label for="{{ $id }}">{{ $name }}</label>
</div>