<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Livewire\Web\Index::class, '__invoke'])->name('web.index');
Route::get('/about', [\App\Livewire\Web\About::class, '__invoke'])->name('web.about');
Route::get('/services', [\App\Livewire\Web\Service::class, '__invoke'])->name('web.services');
Route::get('/service/{slug}', [\App\Livewire\Web\ServiceDetail::class, '__invoke'])->name('web.service.details');
Route::get('/contact', [\App\Livewire\Web\Contact::class, '__invoke'])->name('web.contact');
Route::get('/pricing', [\App\Livewire\Web\Pricing::class, '__invoke'])->name('web.pricing');
Route::get('/booking', [\App\Livewire\Web\Booking::class, '__invoke'])->name('web.booking');
Route::get('/faq', [\App\Livewire\Web\Faq::class, '__invoke'])->name('web.faq');


Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.post');
    });

    Route::middleware(['auth:admin', 'admin'])->group(function () {
        Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

        Route::get('/dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');

        Route::get('/users', \App\Livewire\Admin\Users\ManageUsers::class)->name('users')->middleware('can:view_users');
        Route::get('/roles', \App\Livewire\Admin\Roles\ManageRoles::class)->name('roles')->middleware('can:manage_roles');
        Route::get('/appointments', \App\Livewire\Admin\Appointments\ManageAppointments::class)->name('appointments')->middleware('can:view_appointments');
        Route::get('/services', \App\Livewire\Admin\Services\ManageServices::class)->name('services')->middleware('can:view_services');
        Route::get('/contacts', \App\Livewire\Admin\Contacts\ManageContacts::class)->name('contacts')->middleware('can:view_contacts');

        // Content Management
        Route::group(['prefix' => 'content', 'as' => 'content.', 'middleware' => 'can:manage_content'], function () {
            Route::get('/company-info', \App\Livewire\Admin\Content\ManageCompanyInfo::class)->name('company-info');
            Route::get('/hero', \App\Livewire\Admin\Content\ManageHero::class)->name('hero');
            Route::get('/testimonials', \App\Livewire\Admin\Content\ManageTestimonials::class)->name('testimonials');
            Route::get('/gallery', \App\Livewire\Admin\Content\ManageGallery::class)->name('gallery');
            Route::get('/faqs', \App\Livewire\Admin\Content\ManageFaqs::class)->name('faqs');
            Route::get('/team', \App\Livewire\Admin\Content\ManageTeam::class)->name('team');
        });

        // Social Media
        Route::get('/social/posts', \App\Livewire\Admin\Social\ManageSocialPosts::class)
            ->name('social.posts')
            ->middleware('can:view_social_posts');
        Route::get('/permissions', \App\Livewire\Admin\Permissions\ManagePermissions::class)->name('permissions');

        // Future routes will go here
    });
});


