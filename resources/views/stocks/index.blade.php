<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stocks</title>
    <style>
        div.dt-container {
            width: 80%;
        }
    </style>
</head>
@include('layouts.navbar')

@if (Session::has('success'))
    <div class="alert alert-error" role="alert"><strong>{{ Session::get('success') }}</strong></div>
@endif

<body>
    <div class="container">
        <div>
            <button class="btn btn-primary" style="float:right">Add stock</button>
        </div>
        <table id="stocks-table" class="mdl-data-table">
            <thead>
                <tr>
                    <th>Item code</th>
                    <th>Item name</th>
                    <th>Quantity</th>
                    <th>Location</th>
                    <th>Store</th>
                    <th>In stock date</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</body>

</html>
<script>
    var stock_list = "{{ route('stock_list') }}";
</script>
<script src="{{ asset('js/stocks.js') }}"></script>
