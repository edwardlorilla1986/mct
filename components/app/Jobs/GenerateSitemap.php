<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\Log;

class GenerateSitemap implements ShouldQueue
{
    use Dispatchable, Queueable;

    // Handle the job
    public function handle()
    {
        // Start building the sitemap XML
        $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Process pages in chunks to optimize memory usage
        Page::translated()
            ->where('custom_tool_link', null)
            ->where('post_status', true)
            ->where('page_status', true)
            ->where('tool_status', true)
            ->orderBy('id', 'DESC')
            ->chunk(100, function ($pages) use (&$sitemapContent) {
                foreach ($pages as $page) {
                    // Log page type for debugging
                    Log::info("Processing page of type: {$page->type}");

                    // Switch on the type of page to handle URL generation
                    switch ($page->type) {
                        case 'page':
                        case 'tool':
                        case 'contact':
                        case 'report':
                            $this->processPageType($page, $sitemapContent);
                            break;

                        case 'post':
                            $this->processPost($page, $sitemapContent);
                            break;

                        case 'home':
                            $this->processHomePage($page, $sitemapContent);
                            break;

                        default:
                            continue 2; // Skip this page if no match
                    }
                }
            });

        // Close the sitemap XML
        $sitemapContent .= '</urlset>';

        // Save the sitemap to a file in the public storage directory
        try {
            file_put_contents(storage_path('app/public/sitemap.xml'), $sitemapContent);
            Log::info("Sitemap generated successfully.");
        } catch (\Exception $e) {
            Log::error("Failed to generate sitemap: {$e->getMessage()}");
        }
    }

    // Method to process page types (page, tool, contact, report)
    private function processPageType($page, &$sitemapContent)
    {
        foreach ($page->translations as $value) {
            if ($value['robots_meta']) {
                try {
                    // Generate localized URL for page types
                    $url = localization()->getLocalizedURL($value['locale'], route('home') . '/' . $page->slug, [], false);
                    $lastMod = Carbon::parse($page->updated_at)->tz('UTC')->toAtomString();

                    // Append URL and lastmod to sitemap
                    $sitemapContent .= $this->generateUrlEntry($url, $lastMod);
                } catch (\Exception $e) {
                    Log::error("Error generating URL for page {$page->slug}: {$e->getMessage()}");
                    continue;
                }
            }
        }
    }

    // Method to process blog posts
    private function processPost($page, &$sitemapContent)
    {
        foreach ($page->translations as $value) {
            if ($value['robots_meta']) {
                try {
                    // Generate localized URL for posts
                    $url = localization()->getLocalizedURL($value['locale'], route('home') . '/blog/' . $page->slug, [], false);
                    $lastMod = Carbon::parse($page->updated_at)->tz('UTC')->toAtomString();

                    // Append URL and lastmod to sitemap
                    $sitemapContent .= $this->generateUrlEntry($url, $lastMod);
                } catch (\Exception $e) {
                    Log::error("Error generating URL for post {$page->slug}: {$e->getMessage()}");
                    continue;
                }
            }
        }
    }

    // Method to process home page
    private function processHomePage($page, &$sitemapContent)
    {
        foreach ($page->translations as $value) {
            if ($value['robots_meta']) {
                try {
                    // Generate localized URL for homepage
                    $url = localization()->getLocalizedURL($value['locale'], route('home'), [], false);
                    $lastMod = Carbon::parse($page->updated_at)->tz('UTC')->toAtomString();

                    // Append URL and lastmod to sitemap
                    $sitemapContent .= $this->generateUrlEntry($url, $lastMod);
                } catch (\Exception $e) {
                    Log::error("Error generating URL for home page: {$e->getMessage()}");
                    continue;
                }
            }
        }
    }

    // Method to generate URL entry for the sitemap
    private function generateUrlEntry($url, $lastMod)
    {
        return "<url>
                    <loc>{$url}</loc>
                    <lastmod>{$lastMod}</lastmod>
                </url>";
    }
}
