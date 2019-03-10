@extends('layouts.base')

@section('content')

<h3>Books</h3>
<a href="/books/add" class="btn btn-success btn-sm">
  <i class="glyphicon glyphicon-plus"></i>
  Add book
</a>

@if (!empty($books))
    @foreach ($books as $book)
    <div class="media">
    <a href="/books/{{ $book->id }}">
        <div class="media-left">
        @if ($book->image_url)
            <img src="{{ $book->image_url }}">
        @else
            <img src="http://placekitten.com/g/128/192">
        @endif
        </div>
        <div class="media-body">
        <h4>{{ $book->title }}</h4>
        <p>{{ $book->author }}</p>
        </div>
    </a>
    </div>
    @endforeach
@else
<p>No books found</p>
@endif

@if ($next_page_token)
<nav>
  <ul class="pager">
    <li><a href="?page_token={{ $next_page_token }}">More</a></li>
  </ul>
</nav>
@endif

@endsection
