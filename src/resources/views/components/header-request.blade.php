<header class="header">
    <div class="header-content">
        <div class="title">
            {{ __('app.request_form') }}
        </div>
        <div class="language-selector">
            <a href="{{ url('locale/en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">EN</a>
            <span>|</span>
            <a href="{{ url('locale/fr') }}" class="{{ app()->getLocale() == 'fr' ? 'active' : '' }}">FR</a>
        </div>
    </div>
</header>

<style>
.header {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 1rem 0;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}

.header-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem;
}

.title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #333;
}

.language-selector {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.language-selector a {
    color: #666;
    text-decoration: none;
    font-weight: 500;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.language-selector a:hover {
    color: #333;
    background-color: #f5f5f5;
}

.language-selector a.active {
    color: #007bff;
    font-weight: 600;
}

.language-selector span {
    color: #ddd;
}
</style> 