@extends('layouts.base')

@section('content')

<h3>{{ $action }} book</h3>

<form method="POST" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ $book['title'] }}" class="form-control"/>
  </div>

  <div class="form-group">
    <label for="author">Author</label>
    <input type="text" name="author" id="author" value="{{ $book['author'] }}" class="form-control"/>
  </div>

  <div class="form-group">
    <label for="published_date">Date Published</label>
    <input type="text" name="published_date" id="published_date" value="{{ $book['published_date'] }}" class="form-control"/>
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <textarea name="description" id="description" class="form-control">{{ $book['description'] }}</textarea>
  </div>

  <div class="form-group">
    <label for="image">Cover Image</label>
    <input type="file" name="image" id="image" class="form-control"/>
  </div>

  <div class="form-group hidden">
    <label for="image_url">Cover Image URL</label>
    <input type="text" name="image_url" id="image_url" value="{{ $book['image_url'] }}" class="form-control"/>
  </div>
  @csrf
  <button id="submit" type="submit" class="btn btn-success">Save</button>
</form>

@endsection
