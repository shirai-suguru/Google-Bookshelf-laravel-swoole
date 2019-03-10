@extends('layouts.base')

@section('content')

<h3>Book</h3>
<form method="post" action="/books/{{ $book->id }}/delete" id="deleteForm">
  <div class="btn-group">
    <a href="/books/{{ $book->id }}/edit" class="btn btn-primary btn-sm">
      <i class="glyphicon glyphicon-edit"></i>
      Edit book
    </a>
    <button id="submit" type="submit" class="btn btn-danger btn-sm">
      <i class="glyphicon glyphicon-trash"></i>
      Delete book
    </button>
  </div>
  @csrf
</form>

<div class="media">
  <div class="media-left">
    <img class="book-image"
         src="{{ $book->image_url ?: 'http://placekitten.com/g/128/192' }}">
  </div>
  <div class="media-body">
    <h4 class="book-title">
      {{ $book->title }}
      <small>{{ $book->published_date }}</small>
    </h4>
    <h5 class="book-author">By {{ $book->author ?? 'Unknown' }}</h5>
    <p class="book-description">{{ $book->description}}</p>
  </div>
</div>

@endsection
