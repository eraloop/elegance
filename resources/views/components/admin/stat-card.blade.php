<div class="stat-card">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h6 class="text-muted mb-1">{{ $title }}</h6>
            <h2 class="mb-0 font-weight-bold">{{ $value }}</h2>
        </div>
        <div class="icon-box {{ $colorClass }}">
            <i class="{{ $icon }}"></i>
        </div>
    </div>
    @if(isset($trend))
        <div class="d-flex align-items-center text-sm">
            <span class="{{ $trend > 0 ? 'text-success' : 'text-danger' }} font-weight-600 mr-2">
                <i class="fas fa-arrow-{{ $trend > 0 ? 'up' : 'down' }}"></i> {{ abs($trend) }}%
            </span>
            <span class="text-muted">vs last month</span>
        </div>
    @endif
</div>

<style>
    .stat-card {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .bg-primary-light {
        background: rgba(8, 71, 52, 0.1);
        color: var(--primary-color);
    }

    .bg-success-light {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .bg-warning-light {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }

    .bg-info-light {
        background: rgba(23, 162, 184, 0.1);
        color: #17a2b8;
    }
</style>