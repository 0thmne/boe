<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Agent</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Noto+Color+Emoji&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <header class="header">
        <div class="logo">
            <a href="{{ url('/admin') }}">
                <i class="fas fa-tasks"></i> Pilot
            </a>
        </div>
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <span>Admin</span>
        </div>
    </header>

    <div class="container">

        <a href="{{ url('admin/') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to list
        </a>
        <form action="{{ route('add-agent.store') }}" method="POST" novalidate>
            @csrf
            <a href="/">
                <h2>Add Agent</h2>
            </a>
            @if (session('success'))
            <div class="success-message">{{ session('success') }}</div>
            @endif

            <div class="form-grid">
                <div class="form-group">
                    <label for="name" class="required">First Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter the first name" required>
                </div>
                <div class="form-group">
                    <label for="surname" class="required">Last Name</label>
                    <input type="text" id="surname" name="surname" placeholder="Enter the last name" required>
                </div>
                <div class="form-group full-width">
                    <label for="email" class="required">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter the email" required>
                </div>
                <div class="form-group">
                    <label for="password" class="required">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter the password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="required">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm the password" required>
                </div>
            </div>

            <div class="button-wrapper">
                <button type="submit" class="submit-button">Add</button>
            </div>
        </form>
    </div>
</body>

</html>