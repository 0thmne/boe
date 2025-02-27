<header class="header">
    <div class="logo">
        <a href="{{ url('/admin') }}">
            <i class="fas fa-tasks"></i> Pilot
        </a>
    </div>
    <div class="header-right">
        <div class="language-selector">
            <select id="languageSelect" onchange="changeLanguage(this.value)">
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
                <option value="it" {{ app()->getLocale() == 'it' ? 'selected' : '' }}>Italiano</option>
                <option value="hi" {{ app()->getLocale() == 'hi' ? 'selected' : '' }}>हिंदी</option>
                <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
            </select>
        </div>
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <span>Admin</span>
        </div>
    </div>
</header>

<style>
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .header-right {
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .language-selector select {
        padding: 0.5rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #fff;
        font-size: 0.9rem;
        cursor: pointer;
    }

    .language-selector select:hover {
        border-color: #999;
    }

    [dir="rtl"] .header {
        flex-direction: row-reverse;
    }
</style>

<script>
    function changeLanguage(lang) {
        let currentUrl = window.location.href;
        let newUrl = new URL(currentUrl);
        newUrl.searchParams.set('lang', lang);
        window.location.href = newUrl.toString();
    }
</script>