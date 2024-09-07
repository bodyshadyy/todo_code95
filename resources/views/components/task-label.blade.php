<div class="pt-3 hover:bg-black flex items-center">
    <input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="{{$completed}}" <?php echo $completed ? 'checked' : ''; ?>>
    <label for="{{ $id }}">{{ $name }}</label>
</div>