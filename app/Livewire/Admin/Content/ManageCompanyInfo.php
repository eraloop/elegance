<?php

namespace App\Livewire\Admin\Content;

use App\Models\CompanyInfo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.admin')]
class ManageCompanyInfo extends Component
{
    use WithFileUploads;

    public $companyInfo;
    public $about_image, $new_about_image;
    public $about_image_2, $new_about_image_2;
    public $video_image, $new_video_image;
    public $video_file, $new_video_file;

    // Form fields
    public $name, $email, $phone, $address;
    public $facebook, $instagram, $twitter, $linkedin;
    public $about_title, $about_subtitle, $about_us, $founded_year, $working_hours;
    public $video_url;
    public $why_choose_us_title, $why_choose_us_subtitle;
    public $about_points = [];

    public function mount()
    {
        $this->companyInfo = CompanyInfo::first();

        if ($this->companyInfo) {
            $this->name = $this->companyInfo->name;
            $this->email = $this->companyInfo->email;
            $this->phone = $this->companyInfo->phone;
            $this->address = $this->companyInfo->address;
            $this->facebook = $this->companyInfo->facebook;
            $this->instagram = $this->companyInfo->instagram;
            $this->twitter = $this->companyInfo->twitter;
            $this->linkedin = $this->companyInfo->linkedin;
            $this->about_title = $this->companyInfo->about_title;
            $this->about_subtitle = $this->companyInfo->about_subtitle;
            $this->about_us = $this->companyInfo->about_us;
            $this->founded_year = $this->companyInfo->founded_year;
            $this->working_hours = $this->companyInfo->working_hours;
            $this->video_url = $this->companyInfo->video_url;
            $this->why_choose_us_title = $this->companyInfo->why_choose_us_title;
            $this->why_choose_us_subtitle = $this->companyInfo->why_choose_us_subtitle;
            $this->about_points = $this->companyInfo->about_points ?? [];

            $this->about_image = $this->companyInfo->about_image;
            $this->about_image_2 = $this->companyInfo->about_image_2;
            $this->video_image = $this->companyInfo->video_image;
            $this->video_file = $this->companyInfo->video_file;
        } else {
            // Initialize with defaults if no record exists
            $this->about_points = ['', '', '', ''];
        }
    }

    public function addPoint()
    {
        $this->about_points[] = '';
    }

    public function removePoint($index)
    {
        unset($this->about_points[$index]);
        $this->about_points = array_values($this->about_points);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'new_about_image' => 'nullable|image|max:2048',
            'new_about_image_2' => 'nullable|image|max:2048',
            'new_video_image' => 'nullable|image|max:2048',
            'new_video_file' => 'nullable|mimes:mp4,mov,avi,wmv,webm|max:51200',
            'video_url' => 'nullable|url',
        ]);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'linkedin' => $this->linkedin,
            'about_title' => $this->about_title,
            'about_subtitle' => $this->about_subtitle,
            'about_us' => $this->about_us,
            'founded_year' => $this->founded_year,
            'working_hours' => $this->working_hours,
            'video_url' => $this->video_url,
            'why_choose_us_title' => $this->why_choose_us_title,
            'why_choose_us_subtitle' => $this->why_choose_us_subtitle,
            'about_points' => array_values(array_filter($this->about_points)),
        ];

        if ($this->new_about_image) {
            if ($this->about_image) {
                Storage::disk('public')->delete($this->about_image);
            }
            $data['about_image'] = $this->new_about_image->store('company', 'public');
        }

        if ($this->new_about_image_2) {
            if ($this->about_image_2) {
                Storage::disk('public')->delete($this->about_image_2);
            }
            $data['about_image_2'] = $this->new_about_image_2->store('company', 'public');
        }

        if ($this->new_video_image) {
            if ($this->video_image) {
                Storage::disk('public')->delete($this->video_image);
            }
            $data['video_image'] = $this->new_video_image->store('company', 'public');
        }

        if ($this->new_video_file) {
            if ($this->video_file) {
                Storage::disk('public')->delete($this->video_file);
            }
            $data['video_file'] = $this->new_video_file->store('videos', 'public');
        }

        if ($this->companyInfo) {
            $this->companyInfo->update($data);
        } else {
            CompanyInfo::create($data);
        }

        session()->flash('success', 'Settings updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.content.manage-company-info');
    }
}
