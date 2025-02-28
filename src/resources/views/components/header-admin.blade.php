<header class="header">
    <div class="logo">
        <i class="fas fa-tasks"></i> {{ __('app.pilot_interface') }}
    </div>
    <div class="header-actions">
        <a href="{{ route('add-agent.form') }}" class="add-agent-btn" title="{{ __('Add New Agent') }}">
            <i class="fas fa-user-plus"></i>
        </a>
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            @if(Auth::user())
                <span>{{ Auth::user()->name }}</span>
            @else
                <span>{{ __('app.guest') }}</span>
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
    .header-actions {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .add-agent-btn {
        color: white;
        font-size: 1.2rem;
        padding: 0.5rem;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        text-decoration: none;
    }

    .add-agent-btn:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }
</style>