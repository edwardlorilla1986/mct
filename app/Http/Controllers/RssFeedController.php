<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use App\Models\Admin\Page;

class RssFeedController extends Controller
{
    public function generateFeed()
    {
        $rss_feed = '<?xml version="1.0" encoding="UTF-8" ?>';
        $rss_feed .= '<rss version="2.0">';
        $rss_feed .= '<channel>';
        $rss_feed .= '<title>MultiCulturalToolbox Blog</title>';
        $rss_feed .= '<link>' . url('/') . '</link>';
        $rss_feed .= '<description>Latest articles from MultiCulturalToolbox</description>';
        $rss_feed .= '<language>en-us</language>';

        $page = 1;
        $perPage = 20; // Fetch in smaller chunks
        $totalPages = 10; // Limit to 100 items (5 chunks of 20)
        
        do {
            $posts = Page::translated()->latest()->paginate($perPage, ['*'], 'page', $page);

            foreach ($posts as $post) {
                try {
                    if ($post->translations) {
                        foreach ($post->translations as $translation) {
                            if (!isset($translation['robots_meta'])) {
                                continue;
                            }
                            $rss_feed .= '<item>';
                            $rss_feed .= '<title>' . htmlspecialchars($translation['title']) . '</title>';
                            $rss_feed .= '<link>' . url('/blog/' . $post->slug) . '</link>';
                            $rss_feed .= '<description>' . htmlspecialchars($translation['description'] ?? '') . '</description>';

                            if (!empty($post->featured_image)) {
                                $rss_feed .= '<enclosure url="' . $post->featured_image . '" type="image/jpeg"/>';
                            }
                            
                            $rss_feed .= '<pubDate>' . date(DATE_RSS, strtotime($post->created_at)) . '</pubDate>';
                            $rss_feed .= '</item>';
                        }
                    }
                } catch (\Exception $e) {
                    Log::error("Error generating RSS item for page {$post->slug}: {$e->getMessage()}");
                    continue;
                }
            }
            
            $page++;
        } while ($page <= $totalPages && $posts->hasMorePages());

        $rss_feed .= '</channel>';
        $rss_feed .= '</rss>';

        return Response::make($rss_feed, 200)->header('Content-Type', 'application/xml');
    }
}
