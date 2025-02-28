<?php

use Illuminate\Support\Facades\Auth;

$isAdmin = Auth::check() && Auth::user()->role === 'admin';
?>
<header class="admin-header">
    <div class="admin-header-container">
        <div class="admin-logo">
            <i class="fas fa-tasks"></i> {{ __('app.pilot_interface') }}
        </div>
        <div class="admin-header-actions">
            <div class="language-selector">
                <select onchange="changeLanguage(this.value)" class="lang-select">
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
                    <option value="it" {{ app()->getLocale() == 'it' ? 'selected' : '' }}>Italiano</option>
                    <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
                    <option value="hi" {{ app()->getLocale() == 'hi' ? 'selected' : '' }}>हिंदी</option>
                </select>
            </div>
            @if($isAdmin)
            <a href="{{ route('add-agent.form') }}" class="admin-add-btn" title="{{ __('Add New Agent') }}">
                <i class="fas fa-user-plus"></i>
            </a>
            @endif
            <div class="admin-user-profile">
                <div class="admin-user-avatar">
                    @if(Auth::check())
                    @if(Auth::user()->role === 'admin')
                    <i class="fas fa-user-shield" title="{{ __('app.admin') }}"></i>
                    @else
                    <i class="fas fa-user-tie" title="{{ __('app.agent') }}"></i>
                    @endif
                    @else
                    <i class="fas fa-user"></i>
                    @endif
                </div>
                @if(Auth::user())
                <span>{{ Auth::user()->name }}</span>
                @else
                <span>{{ __('app.guest') }}</span>
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
    :root {
        --primary-color: #243782;
        --secondary-color: #1d2d6f;
        --background-color: #f5f7fa;
        --border-color: #e1e4e8;
        --text-color: #24292e;
        --hover-color: #f6f8fa;
    }

    .admin-header {
        background-color: white !important;
        color: var(--text-color) !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1) !important;
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

    .admin-add-btn {
        color: white !important;
        font-size: 1.2rem !important;
        padding: 0.5rem !important;
        border-radius: 50% !important;
        background-color: var(--primary-color) !important;
        transition: background-color 0.3s ease !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 40px !important;
        height: 40px !important;
        text-decoration: none !important;
    }

    .admin-add-btn:hover {
        background-color: var(--secondary-color) !important;
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

    .language-selector {
        display: flex !important;
        align-items: center !important;
    }

    .lang-select {
        padding: 0.5rem !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 4px !important;
        background-color: white !important;
        color: var(--text-color) !important;
        font-size: 0.9rem !important;
        cursor: pointer !important;
        transition: border-color 0.3s ease !important;
    }

    .lang-select:hover {
        border-color: var(--primary-color) !important;
    }

    .lang-select:focus {
        outline: none !important;
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 2px rgba(36, 55, 130, 0.2) !important;
    }
</style>