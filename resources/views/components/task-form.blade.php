<div>
    <form action"/dashboard" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Enter task name">
        <button type="submit">Create Task</button>
    </form>
</div> 