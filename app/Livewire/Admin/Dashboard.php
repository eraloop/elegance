<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Contact;

use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        // 1. Business KPIs
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $totalRevenue = Appointment::where('status', 'completed')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->sum('services.price_min');
        $avgRating = \App\Models\Testimonial::avg('rating') ?? 0;

        // 2. System Content Overview
        $systemStats = [
            'users' => \App\Models\User::count(),
            'services' => Service::count(),
            'gallery_images' => \App\Models\GalleryImage::count(),
            'team_members' => \App\Models\Team::count(),
            'social_posts' => \App\Models\SocialPost::count(),
            'faqs' => \App\Models\FAQ::count(),
            'testimonials' => \App\Models\Testimonial::count(),
            'contacts' => Contact::count(),
            'unread_contacts' => Contact::where('is_read', false)->count(),
        ];

        // 3. Revenue Chart Data (Monthly)
        $monthlyRevenueData = Appointment::where('status', 'completed')
            ->whereYear('appointment_date', date('Y'))
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->selectRaw('MONTH(appointment_date) as month, SUM(services.price_min) as revenue')
            ->groupBy('month')
            ->pluck('revenue', 'month')
            ->toArray();

        $monthlyRevenue = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue[] = $monthlyRevenueData[$i] ?? 0;
        }

        // 4. Status Distribution
        $statusDistribution = Appointment::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $statuses = ['pending', 'confirmed', 'completed', 'canceled'];
        $statusData = [];
        foreach ($statuses as $status) {
            $statusData[] = $statusDistribution[$status] ?? 0;
        }

        // 5. Recent Activity
        $recentAppointments = Appointment::with('service')->latest()->take(5)->get();

        $stats = [
            'kpi' => [
                'revenue' => $totalRevenue,
                'appointments' => $totalAppointments,
                'pending' => $pendingAppointments,
                'rating' => number_format($avgRating, 1),
                'unread_contacts' => $systemStats['unread_contacts'],
            ],
            'system' => $systemStats,
            'recent_appointments' => $recentAppointments,
            'charts' => [
                'monthly_revenue' => $monthlyRevenue,
                'status_data' => $statusData,
            ]
        ];

        return view('livewire.admin.dashboard', [
            'stats' => $stats
        ]);
    }
}
