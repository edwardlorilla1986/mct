<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Page;
use Carbon\Carbon;

class SitemapController extends Controller
{
    public function index()
    {
        // Start building the sitemap XML
        $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemapContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        Page::translated()
            ->where('custom_tool_link', null)
            ->where('post_status', true)
            ->where('page_status', true)
            ->where('tool_status', true)
            ->orderBy('id', 'DESC')
            ->chunk(100, function ($pages) use (&$sitemapContent) {
                foreach ($pages as $page) {
                    switch ($page->type) {
                        case 'page':
                        case 'tool':
                        case 'contact':
                        case 'report':
                            // Handle generic pages (e.g., page, tool, contact)
                            foreach ($page->translations as $value) {
                                if ($value->robots_meta) {
                                    try {
                                        // Generate localized URL for page types
                                        $url = localization()->getLocalizedURL($value->locale, route('home') . '/' . $page->slug, [], false);
                                        $lastMod = Carbon::parse($page->updated_at)->tz('UTC')->toAtomString();

                                        // Append URL and lastmod to sitemap
                                        $sitemapContent .= "<url>";
                                        $sitemapContent .= "<loc>{$url}</loc>";
                                        $sitemapContent .= "<lastmod>{$lastMod}</lastmod>";
                                        $sitemapContent .= "</url>";
                                    } catch (\Exception $e) {
                                        continue; // Skip if any error occurs
                                    }
                                }
                            }
                            break;

                        case 'post':
                            // Handle blog posts
                            foreach ($page->translations as $value) {
                                if ($value->robots_meta) {
                                    try {
                                        // Generate localized URL for posts
                                        $url = localization()->getLocalizedURL($value->locale, route('home') . '/blog/' . $page->slug, [], false);
                                        $lastMod = Carbon::parse($page->updated_at)->tz('UTC')->toAtomString();

                                        // Append URL and lastmod to sitemap
                                        $sitemapContent .= "<url>";
                                        $sitemapContent .= "<loc>{$url}</loc>";
                                        $sitemapContent .= "<lastmod>{$lastMod}</lastmod>";
                                        $sitemapContent .= "</url>";
                                    } catch (\Exception $e) {
                                        continue; // Skip if any error occurs
                                    }
                                }
                            }
                            break;

                        case 'home':
                            // Handle home page
                            foreach ($page->translations as $value) {
                                if ($value->robots_meta) {
                                    try {
                                        // Generate localized URL for homepage
                                        $url = localization()->getLocalizedURL($value->locale, route('home'), [], false);
                                        $lastMod = Carbon::parse($page->updated_at)->tz('UTC')->toAtomString();

                                        // Append URL and lastmod to sitemap
                                        $sitemapContent .= "<url>";
                                        $sitemapContent .= "<loc>{$url}</loc>";
                                        $sitemapContent .= "<lastmod>{$lastMod}</lastmod>";
                                        $sitemapContent .= "</url>";
                                    } catch (\Exception $e) {
                                        continue; // Skip if any error occurs
                                    }
                                }
                            }
                            break;

                        default:
                            // If no match, skip processing this page
                            continue 2;
                    }
                }
            });

        // Close the sitemap XML
        $sitemapContent .= '</urlset>';

        // Return the sitemap as an XML response
        return response($sitemapContent, 200)->header('Content-Type', 'text/xml');
    }
}
