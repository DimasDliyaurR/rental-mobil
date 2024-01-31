<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Login - Rental Mobil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!-- Custom Styles -->
    <style>
        body {
            background-image: url("assets/img/bg12.jpg");
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            width: 400px;
            padding: 40px;
            border: 1px solid #ced4da;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            background-color: rgba(255, 255, 255, 0.801);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 4px;
        }

        .btn {
            background-color: #0a1f29;
            color: #fff;
            transition: 0.2s;
        }

        .btn:hover {
            background-color: #153646;
            color: #fff;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="bg-image">
        <div class="login-container">

            <h2 class="mb-4">Mari Rent Car Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                {{-- <div class="form-group">
                    <input type="text" class="form-control" id="username" name="token" />
                    @error('token')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username"
                        name="username" value="{{ old('username') }}" />
                    @error('username')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password"
                        name="password" />
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-block">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
