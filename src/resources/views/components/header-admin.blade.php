<header class="header">
    <div class="logo">
        <i class="fas fa-plane"></i>
        <span>{{ __('app.pilot_interface') }}</span>
    </div>
    
    <div class="header-right">
        <div class="language-selector">
            <select id="languageSelect" onchange="changeLanguage(this.value)">
                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
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