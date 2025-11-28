@props(['title' => null])

<div class="admin-card">
    @if($title || isset($header))
        <div class="admin-card-header">
            @if($title)
                <h5 class="admin-card-title">{{ $title }}</h5>
            @endif

            @if(isset($header))
                <div>
                    {{ $header }}
                </div>
            @endif
        </div>
    @endif

    <div class="admin-card-body">
        {{ $slot }}
    </div>
</div>