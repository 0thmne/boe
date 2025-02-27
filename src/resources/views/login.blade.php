<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Noto+Color+Emoji&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login</title>
    
</head>

<body>
    <div class="container">
        <form id="loginForm" novalidate>
            <a href="./index.html">
                <h2>Login</h2>
            </a>

            <div class="form-group">
                <label for="username" class="required">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password" class="required">Password</label>
                <input type="password" id="password" name="password" required>
            </div>


            <div class="button-wrapper">
                <button type="submit" class="submit-button">Login</button>
            </div>
        </form>
    </div>

    
</body>

</html>