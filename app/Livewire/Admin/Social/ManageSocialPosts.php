<?php

namespace App\Livewire\Admin\Social;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ManageSocialPosts extends Component
{
    use \Livewire\WithFileUploads;

    public $content;
    public $facebook_content;
    public $instagram_content;
    public $whatsapp_content;
    public $image;
    public $platforms = [
        'facebook' => false,
        'instagram' => false,
        'whatsapp' => true,
    ];
    public $posts;

    protected $rules = [
        'content' => 'required|string|max:2000',
        'facebook_content' => 'nullable|string|max:2000',
        'instagram_content' => 'nullable|string|max:2000',
        'whatsapp_content' => 'nullable|string|max:2000',
        'image' => 'nullable|image|max:5120', // 5MB
    ];

    public function mount()
    {
        abort_if(!auth()->user()->can('view_social_posts'), 403);
    }

    public function render()
    {
        $this->posts = \App\Models\SocialPost::latest()->get();
        return view('livewire.admin.social.manage-social-posts');
    }

    public function save()
    {
        $this->validate();

        $selectedPlatforms = array_keys(array_filter($this->platforms));

        if (empty($selectedPlatforms)) {
            $this->addError('platforms', 'Please select at least one platform.');
            return;
        }

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('social-posts', 'public');
        }

        $post = \App\Models\SocialPost::create([
            'content' => $this->content,
            'facebook_content' => $this->facebook_content,
            'instagram_content' => $this->instagram_content,
            'whatsapp_content' => $this->whatsapp_content,
            'image_path' => $imagePath,
            'platforms' => $selectedPlatforms,
            'status' => 'posted',
            'posted_at' => now(),
        ]);

        // Post to Facebook if selected
        if (in_array('facebook', $selectedPlatforms)) {
            $socialService = new \App\Services\SocialMediaService();
            $fbContent = $this->facebook_content ?: $this->content;
            $result = $socialService->postToFacebook($fbContent, $imagePath, $this->facebook_content);

            if (!$result['success']) {
                session()->flash('warning', 'Post saved but Facebook posting failed: ' . $result['error']);
            }
        }

        // Post to Instagram if selected
        if (in_array('instagram', $selectedPlatforms)) {
            $socialService = $socialService ?? new \App\Services\SocialMediaService();
            $igContent = $this->instagram_content ?: $this->content;
            $result = $socialService->postToInstagram($igContent, $imagePath, $this->instagram_content);

            if (!$result['success']) {
                session()->flash('warning', 'Post saved but Instagram posting failed: ' . $result['error']);
            }
        }

        session()->flash('success', 'Post created successfully!');
        $this->reset(['content', 'facebook_content', 'instagram_content', 'whatsapp_content', 'image']);

        // Keep WhatsApp selected as default
        $this->platforms = [
            'facebook' => false,
            'instagram' => false,
            'whatsapp' => true,
        ];
    }

    public function getWhatsappUrl($postId)
    {
        $post = \App\Models\SocialPost::find($postId);
        if (!$post)
            return '#';

        $content = $post->whatsapp_content ?: $post->content;

        // If there's an image, include the link in the message
        if ($post->image_path) {
            $imageUrl = url('storage/' . $post->image_path);
            $content .= "\n\nImage: " . $imageUrl;
        }

        $text = urlencode($content);
        return "https://wa.me/?text={$text}";
    }

    public function delete($id)
    {
        $post = \App\Models\SocialPost::find($id);
        if ($post) {
            $post->delete();
            session()->flash('success', 'Post deleted successfully.');
        }
    }
}
