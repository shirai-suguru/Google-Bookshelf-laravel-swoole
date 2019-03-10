<?php $user = session('user'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bookshelf - PHP on Google Cloud Platform</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <div class="navbar-brand">Bookshelf</div>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="/books">Books</a></li>
        </ul>
        <p class="navbar-text navbar-right">
          @if ($user)
            @if ($user['picture'])
              <img src="{{ $user['picture'] }}" class="img-circle" width="24" alt="Photo" />
            @endif
            <span>
              {{ $user['name'] }} &nbsp;
              <a href="/logout">(logout)</a>
            </span>
          @else
            <a href="/login">Login</a>
          @endif
        </p>

      </div>
    </div>
    <div class="container">
        @yield('content')
    </div>
  </body>
</html>