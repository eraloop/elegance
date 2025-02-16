<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [\App\Livewire\Web\Index::class, '__invoke'])->name('web.index');
Route::get('/about', [\App\Livewire\Web\About::class, '__invoke'])->name('web.about');
Route::get('/services', [\App\Livewire\Web\Service::class, '__invoke'])->name('web.services');
Route::get('/services/{slug}', [\App\Livewire\Web\ServiceDetail::class, '__invoke'])->name('web.service.details');
Route::get('/contact', [\App\Livewire\Web\Contact::class, '__invoke'])->name('web.contact');
Route::get('/booking', [\App\Livewire\Web\Booking::class, '__invoke'])->name('web.booking');
Route::get('/faq', [\App\Livewire\Web\Faq::class, '__invoke'])->name('web.faq');


Route::fallback([\App\Livewire\Web\NotFound::class, '__invoke'])->name('web.not-found');
