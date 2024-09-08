@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit List</h1>

        <form action="{{ route('lists.update', $list->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">List Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $list->name }}">
            </div>

            <div class="form-group">
                <label for="description">List Description</label>
                <textarea name="description" id="description" class="form-control">{{ $list->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update List</button>
        </form>
    </div>
@endsection