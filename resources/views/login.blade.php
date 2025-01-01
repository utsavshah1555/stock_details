<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="login-card">
          <h2>Login</h2>
          @if (Session::has('error'))
              {{ Session::get('error') }}
          @endif
          <form id="login-form" method="post" action="{{ route('user.login') }}">
            @csrf
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" autocomplete>
            @error('email')
                {{ $message }}
            @enderror

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" >
            @error('password')
                {{ $message }}
            @enderror
            <button type="submit">Login</button>
          </form>
        </div>
      </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var loginUrl = "{{ route('user.login') }}";
</script>
<script src="{{ asset('js/login.js') }}"></script>
</html>
