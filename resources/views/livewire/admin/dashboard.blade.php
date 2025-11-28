<div>
    @section('title', 'Dashboard')

    <style>
        :root {
            --dashboard-primary: #084734;
            --dashboard-secondary: #F5F5F5;
            --dashboard-accent: #D4AF37;
            /* Gold-ish accent */
            --dashboard-text: #333;
            --dashboard-text-muted: #777;
        }

        .dashboard-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        }

        .kpi-card {
            position: relative;
            padding: 25px;
        }

        .kpi-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .kpi-value {
            font-size: 28px;
            font-weight: 700;
            color: var(--dashboard-primary);
            margin-bottom: 5px;
            font-family: 'Hanken Grotesk', sans-serif;
        }

        .kpi-label {
            font-size: 14px;
            color: var(--dashboard-text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .system-grid-item {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #eee;
            transition: all 0.2s;
        }

        .system-grid-item:hover {
            border-color: var(--dashboard-primary);
            background: #fcfcfc;
        }

        .chart-container {
            position: relative;
            height: 350px;
            width: 100%;
        }

        .section-header {
            font-family: 'Hanken Grotesk', sans-serif;
            font-weight: 700;
            color: var(--dashboard-primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold text-dark mb-1" style="font-family: 'Hanken Grotesk', sans-serif;">Dashboard
            </h2>
            <p class="text-muted mb-0">Welcome back, Admin. Here's what's happening today.</p>
        </div>
        <div class="text-right">
            <div class="h5 font-weight-bold text-primary mb-0">{{ now()->format('l, F j, Y') }}</div>
        </div>
    </div>

    <!-- KPI Row -->
    <div class="row mb-4">
        <!-- Revenue -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card kpi-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="kpi-label">Total Revenue</div>
                        <div class="kpi-value">${{ number_format($stats['kpi']['revenue'], 2) }}</div>
                        <div class="text-success small font-weight-bold"><i class="fas fa-arrow-up"></i> YTD Growth
                        </div>
                    </div>
                    <div class="kpi-icon" style="background: rgba(8, 71, 52, 0.1); color: #084734;">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointments -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card kpi-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="kpi-label">Total Bookings</div>
                        <div class="kpi-value">{{ $stats['kpi']['appointments'] }}</div>
                        <div class="text-muted small">{{ $stats['kpi']['pending'] }} Pending Actions</div>
                    </div>
                    <div class="kpi-icon" style="background: rgba(212, 175, 55, 0.1); color: #D4AF37;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card kpi-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="kpi-label">Client Rating</div>
                        <div class="kpi-value">{{ $stats['kpi']['rating'] }} <span
                                style="font-size: 14px; color: #ccc;">/ 5.0</span></div>
                        <div class="text-muted small">Based on reviews</div>
                    </div>
                    <div class="kpi-icon" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card kpi-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="kpi-label">New Messages</div>
                        <div class="kpi-value">{{ $stats['kpi']['unread_contacts'] }}</div>
                        <div class="text-danger small font-weight-bold">Unread Inquiries</div>
                    </div>
                    <div class="kpi-icon" style="background: rgba(220, 53, 69, 0.1); color: #dc3545;">
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-5">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div class="dashboard-card p-4 h-100">
                <div class="section-header">
                    <span>Revenue Overview</span>
                    <select class="custom-select custom-select-sm w-auto border-0 bg-light">
                        <option>This Year</option>
                    </select>
                </div>
                <div class="chart-container">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="dashboard-card p-4 h-100">
                <div class="section-header">
                    <span>Booking Status</span>
                </div>
                <div class="chart-container" style="height: 250px; margin-top: 40px;">
                    <canvas id="statusChart"></canvas>
                </div>
                <div class="mt-4 text-center">
                    <div class="row text-center justify-content-center">
                        <div class="col-6 mb-2"><span class="badge badge-dot mr-2"
                                style="background: #084734;"></span>Completed</div>
                        <div class="col-6 mb-2"><span class="badge badge-dot mr-2"
                                style="background: #D4AF37;"></span>Pending</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Overview Grid -->
    <div class="mb-5">
        <h4 class="section-header">System Overview</h4>
        <div class="row">
            @php
                $systemItems = [
                    ['label' => 'Registered Users', 'value' => $stats['system']['users'], 'icon' => 'fas fa-users', 'color' => '#4e73df'],
                    ['label' => 'Active Services', 'value' => $stats['system']['services'], 'icon' => 'fas fa-cut', 'color' => '#1cc88a'],
                    ['label' => 'Gallery Images', 'value' => $stats['system']['gallery_images'], 'icon' => 'fas fa-images', 'color' => '#36b9cc'],
                    ['label' => 'Team Members', 'value' => $stats['system']['team_members'], 'icon' => 'fas fa-user-tie', 'color' => '#f6c23e'],
                    ['label' => 'Social Posts', 'value' => $stats['system']['social_posts'], 'icon' => 'fas fa-share-alt', 'color' => '#e74a3b'],
                    ['label' => 'FAQs', 'value' => $stats['system']['faqs'], 'icon' => 'fas fa-question-circle', 'color' => '#858796'],
                ];
            @endphp

            @foreach($systemItems as $item)
                <div class="col-xl-2 col-md-4 col-6 mb-4">
                    <div class="system-grid-item h-100">
                        <div>
                            <div class="h3 font-weight-bold mb-0 text-dark">{{ $item['value'] }}</div>
                            <div class="small text-muted">{{ $item['label'] }}</div>
                        </div>
                        <div style="color: {{ $item['color'] }}; opacity: 0.8;">
                            <i class="{{ $item['icon'] }} fa-lg"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Appointments Table -->
    <div class="dashboard-card p-0">
        <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="font-weight-bold mb-0 text-dark" style="font-family: 'Hanken Grotesk', sans-serif;">Recent
                Appointments</h5>
            <a href="{{ route('admin.appointments') }}" class="small font-weight-bold text-primary">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="border-top-0 pl-4 py-3">ID</th>
                        <th class="border-top-0 py-3">Customer</th>
                        <th class="border-top-0 py-3">Service</th>
                        <th class="border-top-0 py-3">Date & Time</th>
                        <th class="border-top-0 py-3">Status</th>
                        <th class="border-top-0 py-3">Price</th>
                        <th class="border-top-0 py-3 text-right pr-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stats['recent_appointments'] as $appointment)
                        <tr>
                            <td class="pl-4 py-3 font-weight-bold text-muted">#{{ $appointment->id }}</td>
                            <td class="py-3">
                                <div class="font-weight-bold text-dark">{{ $appointment->customer_name }}</div>
                                <small class="text-muted">{{ $appointment->customer_phone }}</small>
                            </td>
                            <td class="py-3">{{ $appointment->service->name ?? 'N/A' }}</td>
                            <td class="py-3">
                                <div class="font-weight-bold">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</div>
                                <small
                                    class="text-muted">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</small>
                            </td>
                            <td class="py-3">
                                @if($appointment->status == 'pending')
                                    <span class="admin-badge admin-badge-warning">Pending</span>
                                @elseif($appointment->status == 'confirmed')
                                    <span class="admin-badge admin-badge-primary">Confirmed</span>
                                @elseif($appointment->status == 'completed')
                                    <span class="admin-badge admin-badge-success">Completed</span>
                                @elseif($appointment->status == 'canceled')
                                    <span class="admin-badge admin-badge-danger">Cancelled</span>
                                @endif
                            </td>
                            <td class="py-3 font-weight-bold">${{ number_format($appointment->price, 2) }}</td>
                            <td class="text-right pr-4 py-3">
                                <a href="{{ route('admin.appointments') }}"
                                    class="admin-btn admin-btn-sm admin-btn-secondary" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">No recent appointments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Chart.defaults.font.family = "'DM Sans', sans-serif";
            Chart.defaults.color = '#666';

            // Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            const gradient = revenueCtx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(8, 71, 52, 0.2)'); // #084734 with opacity
            gradient.addColorStop(1, 'rgba(8, 71, 52, 0.0)');

            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Revenue',
                        data: @json($stats['charts']['monthly_revenue']),
                        borderColor: '#084734',
                        backgroundColor: gradient,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#084734',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#084734',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 12,
                            cornerRadius: 8,
                            displayColors: false,
                            callbacks: {
                                label: function (context) {
                                    return '$' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [4, 4], color: '#f0f0f0', drawBorder: false },
                            ticks: { callback: function (value) { return '$' + value; } }
                        },
                        x: {
                            grid: { display: false, drawBorder: false }
                        }
                    }
                }
            });

            // Status Chart
            const statusCtx = document.getElementById('statusChart');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Confirmed', 'Completed', 'Canceled'],
                    datasets: [{
                        data: @json($stats['charts']['status_data']),
                        backgroundColor: ['#D4AF37', '#4e73df', '#084734', '#e74a3b'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
</div>