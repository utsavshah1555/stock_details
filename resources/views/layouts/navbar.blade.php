<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/14.0.0/material-components-web.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.material.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('stocks-list') }}">Stocks </a>
            </li>
          </ul>
          <div class="text-white">
            {{ Auth::user()->name }}
          </div>
            <a href="{{ route('user.logout') }}"><button class="btn btn-outline-light my-2 my-sm-0" type="button">Logout</button></a>
        </div>
      </nav>
</body>
<script src="//code.jquery.com/jquery-3.7.1.js"></script>
<script src="//cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/material-components-web/14.0.0/material-components-web.min.js"></script>
<script src="//cdn.datatables.net/2.1.8/js/dataTables.material.js"></script>
</html>
