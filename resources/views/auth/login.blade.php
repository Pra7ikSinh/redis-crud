<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Laravel Crud | login</title>
    <style>
        .btn-color {
            background-color: #0e1c36;
            color: #fff;

        }

        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }



        .cardbody-color {
            background-color: #ebf2fa;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-2">Login</h2>
                <div class="card ">

                    <form id = 'form-id' method = 'post'
                        enctype = 'multipart/form-data' action="{{route('login')}}" class="card-body cardbody-color p-lg-5">
                        @csrf
                    {{-- {!! Form::open([
                        'id' => 'form-id',
                        'route' => " route('login') ",
                        'method' => 'post',
                        'enctype' => 'multipart/form-data',
                    ]) !!} --}}
                    <div class="text-center">
            
                        <img src="https://images.ctfassets.net/23aumh6u8s0i/7gu8qd0qzmuxWWjYLhZpqo/2bb8a206fe4a86af9414545b5c25c368/laravel"
                            class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                            alt="profile">
                    </div>

                    <div class="mb-3">
                        <input name="email" type="text" class="form-control" id="email_login" aria-describedby="emailHelp"
                            placeholder="E-m@il">
                            <small>
                                <small class="text-danger">
                                @error('email')
                                    {{$message}}
                                @enderror
                            </small>
                        </small>
                    </div>
                    <div class="mb-3">
                        <input name="password" type="password" class="form-control" id="password" placeholder="password">
                        <small>
                            <small class="text-danger">
                            @error('password')
                                {{$message}}
                            @enderror
                        </small>
                    </small>
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button>
                    </div>
                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
                        Registered? <a href="{{ route('register') }}" class="text-dark fw-bold"> Create an
                            Account</a>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>
