<div class="section-header">
    <h1>{{ $name }}</h1>
    @isset($button)
        <div class="section-header-button">
                <a href="{{ route($link) }}" class="btn btn-primary">{{ $button }}</a>
            </div>
    @endisset
</div>