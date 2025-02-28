<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('app.pilot_interface') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pilote.css') }}">
    @stack('styles')
</head>

<body>

    <header class="admin-header">
        <div class="admin-header-container">
            <div class="admin-logo">
                <i class="fas fa-plane"></i>
                <span>{{ __('app.pilot_interface') }}</span>
            </div>
            <div class="admin-header-actions">
                <div class="language-selector">
                    <select id="languageSelect" onchange="changeLanguage(this.value)">
                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                        <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
                    </select>
                </div>
                <div class="admin-user-profile">
                    <div class="admin-user-avatar">
                        <i class="fas fa-user-tie" title="{{ __('app.agent') }}"></i>
                    </div>
                    @if(Auth::user())
                    <span>{{ Auth::user()->name }}</span>
                    @endif
                </div>
                @if(Auth::check())
                <form action="{{ route('logout') }}" method="POST" class="admin-logout-form">
                    @csrf
                    <button type="submit" class="admin-logout-btn" title="{{ __('app.logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
                @endif
            </div>
        </div>
    </header>

    @yield('content')

    <script>
        function changeLanguage(lang) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = '/change-language';

            let csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);

            let langInput = document.createElement('input');
            langInput.type = 'hidden';
            langInput.name = 'language';
            langInput.value = lang;
            form.appendChild(langInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>

    <style>
        .admin-header {
            background-color: white !important;
            color: var(--text-color) !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
            margin-bottom: 20px;
        }

        .admin-header-container {
            max-width: 100% !important;
            padding: 1rem 2rem !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .admin-logo {
            color: var(--primary-color) !important;
            font-size: 1.5rem !important;
            font-weight: bold !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .admin-logo i {
            color: var(--primary-color) !important;
        }

        .admin-user-profile {
            color: var(--text-color) !important;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-user-profile span {
            font-weight: 600 !important;
            color: var(--text-color) !important;
        }

        .admin-user-avatar {
            background-color: var(--primary-color) !important;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white !important;
        }

        .admin-header-actions {
            display: flex !important;
            align-items: center !important;
            gap: 1.5rem !important;
        }

        .admin-logout-form {
            margin: 0;
            padding: 0;
            line-height: 0;
        }

        .admin-logout-btn {
            color: white !important;
            font-size: 1.2rem !important;
            padding: 0 !important;
            border-radius: 50% !important;
            background-color: var(--primary-color) !important;
            border: none !important;
            cursor: pointer !important;
            transition: background-color 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 40px !important;
            height: 40px !important;
            margin: 0 !important;
            line-height: 1 !important;
        }

        .admin-logout-btn:hover {
            background-color: var(--secondary-color) !important;
        }

        /* Language selector styling */
        .language-selector select {
            padding: 8px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            background-color: white;
            color: var(--text-color);
            font-size: 14px;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .language-selector select:hover {
            border-color: var(--primary-color);
        }

        .language-selector select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(36, 55, 130, 0.1);
        }
    </style>
</body>

</html>