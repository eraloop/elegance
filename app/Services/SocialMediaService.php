<?php

namespace App\Services;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SocialMediaService
{
    protected $fb;

    public function __construct()
    {
        try {
            $this->fb = new Facebook([
                'app_id' => config('services.facebook.app_id'),
                'app_secret' => config('services.facebook.app_secret'),
                'default_graph_version' => 'v18.0',
            ]);
        } catch (FacebookSDKException $e) {
            Log::error('Facebook SDK initialization failed: ' . $e->getMessage());
            $this->fb = null;
        }
    }

    /**
     * Post to Facebook Page.
     * @param string $content The text content to post
     * @param string|null $imagePath Relative path to image in storage
     * @param string|null $customContent Optional platform-specific content
     * @return array ['success' => bool, 'post_id' => string|null, 'error' => string|null]
     */
    public function postToFacebook(string $content, ?string $imagePath = null, ?string $customContent = null)
    {
        if (!$this->fb) {
            return ['success' => false, 'post_id' => null, 'error' => 'Facebook SDK not initialized'];
        }

        $pageAccessToken = config('services.facebook.page_access_token');
        $pageId = config('services.facebook.page_id');

        if (!$pageAccessToken || !$pageId) {
            Log::warning('Facebook credentials missing');
            return ['success' => false, 'post_id' => null, 'error' => 'Facebook credentials missing'];
        }

        try {
            $postContent = $customContent ?: $content;
            $data = ['message' => $postContent];

            // If there's an image, upload it with the post
            if ($imagePath) {
                $fullPath = Storage::disk('public')->path($imagePath);

                if (file_exists($fullPath)) {
                    $data['source'] = $this->fb->fileToUpload($fullPath);
                    $endpoint = "/{$pageId}/photos";
                } else {
                    Log::warning("Image file not found: {$fullPath}");
                    $endpoint = "/{$pageId}/feed";
                }
            } else {
                $endpoint = "/{$pageId}/feed";
            }

            $response = $this->fb->post($endpoint, $data, $pageAccessToken);
            $graphNode = $response->getGraphNode();
            $postId = $graphNode['id'] ?? $graphNode['post_id'] ?? null;

            Log::info('Facebook post successful', ['post_id' => $postId]);
            return ['success' => true, 'post_id' => $postId, 'error' => null];

        } catch (FacebookSDKException $e) {
            Log::error('Facebook posting failed: ' . $e->getMessage());
            return ['success' => false, 'post_id' => null, 'error' => $e->getMessage()];
        }
    }

    /**
     * Post to Instagram Business Account.
     * @param string $content The caption for the post
     * @param string|null $imagePath Relative path to image in storage (REQUIRED for Instagram)
     * @param string|null $customContent Optional platform-specific caption
     * @return array ['success' => bool, 'post_id' => string|null, 'error' => string|null]
     */
    public function postToInstagram(string $content, ?string $imagePath = null, ?string $customContent = null)
    {
        if (!$this->fb) {
            return ['success' => false, 'post_id' => null, 'error' => 'Facebook SDK not initialized'];
        }

        $accessToken = config('services.facebook.page_access_token');
        $instagramAccountId = config('services.facebook.instagram_account_id');

        if (!$accessToken || !$instagramAccountId) {
            Log::warning('Instagram credentials missing');
            return ['success' => false, 'post_id' => null, 'error' => 'Instagram credentials missing'];
        }

        // Instagram requires an image
        if (!$imagePath) {
            return ['success' => false, 'post_id' => null, 'error' => 'Instagram requires an image'];
        }

        $fullPath = Storage::disk('public')->path($imagePath);

        if (!file_exists($fullPath)) {
            return ['success' => false, 'post_id' => null, 'error' => 'Image file not found'];
        }

        try {
            $postContent = $customContent ?: $content;

            // Step 1: Get the public URL of the image
            $imageUrl = url('storage/' . $imagePath);

            // Step 2: Create media container
            $containerData = [
                'image_url' => $imageUrl,
                'caption' => $postContent,
            ];

            $containerResponse = $this->fb->post(
                "/{$instagramAccountId}/media",
                $containerData,
                $accessToken
            );

            $containerId = $containerResponse->getGraphNode()['id'];

            // Step 3: Publish the media container
            $publishResponse = $this->fb->post(
                "/{$instagramAccountId}/media_publish",
                ['creation_id' => $containerId],
                $accessToken
            );

            $postId = $publishResponse->getGraphNode()['id'];

            Log::info('Instagram post successful', ['post_id' => $postId]);
            return ['success' => true, 'post_id' => $postId, 'error' => null];

        } catch (FacebookSDKException $e) {
            Log::error('Instagram posting failed: ' . $e->getMessage());
            return ['success' => false, 'post_id' => null, 'error' => $e->getMessage()];
        }
    }
}
