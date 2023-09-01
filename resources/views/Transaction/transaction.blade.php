<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Show Item</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle fs-5 mx-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Category</a>
                        <ul class="dropdown-menu mx-4">
                            @can('admin')
                                <li><a class="dropdown-item" href="{{ route('add_category_menu') }}">Add</a></li>
                            @endcan
                            <li><a class="dropdown-item" href="{{ route('category') }}">Show</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle fs-5 mx-4" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Item</a>
                        <ul class="dropdown-menu mx-4">
                            @can('admin')
                                <li><a class="dropdown-item" href="{{ route('add_item_menu') }}">Add</a></li>
                            @endcan
                            <li><a class="dropdown-item" href="{{ route('item') }}">Show</a></li>
                        </ul>
                    </li>
                </ul>
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-outline-danger" type="submit" href="{{ route('logout') }}">Logout</button>
                    </form>
                @else
                    <a class="btn btn-outline-success" href="{{ route('login_menu') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>
    <h1 class="m-5">All Item</h1>
    <div class="d-flex flex-row width-100">
        <div class="card m-5" style="width: 18rem;">
            <img src="{{ asset('./storage/Item/'.$item->image) }}" class="card-img-top" alt="{{ $item->image }}">
            <div class="card-body">
                <h4 class="">{{ $item->name }}</h4>
                <p class="card-text">Price: Rp. {{ $item->price }}</p>
                <p class="card-text">Quantity: {{ $item->quantity }}</p>
                <form action="{{ route('store_transaction', ['id'=>$item->id]) }}" method="POST">
                    @csrf
                    <input class="form-control" type="number" name="amount" placeholder="Input Amount">
                    <input class="form-control mt-2" type="text" name="address" placeholder="Input Address">
                    <input class="form-control mt-2" type="text" name="postal_code" placeholder="Input Postal Code">
                    <button class="btn btn-success mt-4" type="submit">Buy</button>
                    <a href="{{ route('item') }}" class="btn btn-danger mt-4">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>