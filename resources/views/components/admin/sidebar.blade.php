<div class="admin-sidebar">
    <div class="sidebar-header">
        <h3>Elegance</h3>
    </div>

    <div class="sidebar-menu">
        <div class="menu-label">Main</div>
        <a href="{{ route('admin.dashboard') }}"
            class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Dashboard
        </a>

        <div class="menu-label">Management</div>

        @can('view_appointments')
            <a href="{{ route('admin.appointments') }}"
                class="menu-item {{ request()->routeIs('admin.appointments') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i> Appointments
            </a>
        @endcan

        @can('view_services')
            <a href="{{ route('admin.services') }}"
                class="menu-item {{ request()->routeIs('admin.services') ? 'active' : '' }}">
                <i class="fas fa-cut"></i> Services
            </a>
        @endcan

        @can('view_social_posts')
            <a href="{{ route('admin.social.posts') }}"
                class="menu-item {{ request()->routeIs('admin.social.*') ? 'active' : '' }}">
                <i class="fas fa-share-alt"></i> Social Media
            </a>
        @endcan

        @can('view_contacts')
            <a href="{{ route('admin.contacts') }}"
                class="menu-item {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Contacts
            </a>
        @endcan

        @can('manage_products')
            <div class="menu-label">Shop</div>
            <a href="{{ route('admin.products.list') }}"
                class="menu-item {{ request()->routeIs('admin.products.list') ? 'active' : '' }}">
                <i class="fas fa-box-open"></i> Products
            </a>
            <a href="{{ route('admin.products.categories') }}"
                class="menu-item {{ request()->routeIs('admin.products.categories') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> Categories
            </a>
            <a href="{{ route('admin.products.orders') }}"
                class="menu-item {{ request()->routeIs('admin.products.orders') ? 'active' : '' }}">
                <i class="fas fa-shopping-bag"></i> Orders
            </a>
        @endcan

        @can('manage_content')
            <div class="menu-label">Content</div>
            <a href="{{ route('admin.content.company-info') }}"
                class="menu-item {{ request()->routeIs('admin.content.company-info') ? 'active' : '' }}">
                <i class="fas fa-cogs"></i> General Settings
            </a>
            <a href="{{ route('admin.content.hero') }}"
                class="menu-item {{ request()->routeIs('admin.content.hero') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Hero Slider
            </a>
            <a href="{{ route('admin.content.testimonials') }}"
                class="menu-item {{ request()->routeIs('admin.content.testimonials') ? 'active' : '' }}">
                <i class="fas fa-quote-left"></i> Testimonials
            </a>
            <a href="{{ route('admin.content.gallery') }}"
                class="menu-item {{ request()->routeIs('admin.content.gallery') ? 'active' : '' }}">
                <i class="fas fa-photo-video"></i> Gallery
            </a>
            <a href="{{ route('admin.content.faqs') }}"
                class="menu-item {{ request()->routeIs('admin.content.faqs') ? 'active' : '' }}">
                <i class="fas fa-question-circle"></i> FAQs
            </a>
            <a href="{{ route('admin.content.team') }}"
                class="menu-item {{ request()->routeIs('admin.content.team') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Team
            </a>
        @endcan

        @can('view_users')
            <div class="menu-label">System</div>
            <a href="{{ route('admin.users') }}" class="menu-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Users
            </a>
        @endcan

        @can('manage_roles')
            <a href="{{ route('admin.roles') }}" class="menu-item {{ request()->routeIs('admin.roles') ? 'active' : '' }}">
                <i class="fas fa-user-shield"></i> Roles
            </a>
            <a href="{{ route('admin.permissions') }}"
                class="menu-item {{ request()->routeIs('admin.permissions') ? 'active' : '' }}">
                <i class="fas fa-key"></i> Permissions
            </a>
        @endcan
    </div>
</div>