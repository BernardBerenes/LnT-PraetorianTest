<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <title>Login</title>
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
    <h1 class="m-5">Login</h1>
    <form method="POST" action="{{ route('login') }}" class="mx-5 mb-3">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control w-25" id="email" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control w-25" id="password" name="password">
        </div>
        <p class="">Don't Have Account? <a href="{{ route('register_menu') }}">Register Here!</a></p>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</body>
</html>