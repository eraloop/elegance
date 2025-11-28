<!-- Floating Booking Button -->
<div class="floating-booking-btn" id="floatingBookingBtn">
    <a href="{{ route('web.booking') }}" class="btn-default">
        <i class="fas fa-calendar-check"></i> Book Now
    </a>
</div>

<script>
    // Show/hide floating booking button on scroll
    window.addEventListener('scroll', function () {
        const floatingBtn = document.getElementById('floatingBookingBtn');
        if (floatingBtn && window.scrollY > 500) {
            floatingBtn.classList.add('visible');
        } else if (floatingBtn) {
            floatingBtn.classList.remove('visible');
        }
    });
</script>