<div class="mt-1 py-2 hover:bg-gray-100 flex items-center">
    <input type="radio" id="{{ $id }}" name="{{ $name }}" value="{{$completed}}" <?php echo $completed ? 'checked' : ''; ?>>
    <label for="{{ $id }}">{{ $name }}</label>
</div>