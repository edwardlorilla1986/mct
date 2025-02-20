<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;
use App\Models\Admin\Page as PublicPage;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use App\Models\Admin\{
    General, Social, User, Menu, Header, Footer, Gdpr, Advanced, Advertisement, FooterTranslation, Redirect, Sidebar
};
use Livewire\WithPagination;

class Blog extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $general   = General::orderBy('id', 'DESC')->first();
        $page      = PublicPage::where('type', 'home')->first();
        $pageTrans = PublicPage::withTranslation()
            ->translatedIn(app()->getLocale())
            ->where('type', 'post')
            ->where('post_status', true)
            ->orderByTranslation('id', 'DESC')
            ->paginate($general->blog_page_count ?? 10); // Default to 10 if null
        
        if ($pageTrans->isNotEmpty()) {

            // SEO Setup
            $this->setupSEO($general, $page);

            // Get Sidebar Limit
            $sidebarToolCount = Sidebar::first()->tool_count ?? 5; // Default to 5 if null

            // Fetch Recent Posts with Chunking
            $recent_posts = $this->getTranslatedPosts('post', $sidebarToolCount);

            // Fetch Popular Tools with Chunking
            $popular_tools = $this->getTranslatedTools($sidebarToolCount);

            return view('livewire.public.blog', [
                'page'          => $page,
                'general'       => $general,
                'pageTrans'     => $pageTrans
            ])->layout('layouts.blog', [
                'page'          => $page,
                'pageTrans'     => $pageTrans,
                'general'       => $general,
                'profile'       => User::with('user_socials')->where('is_admin', true)->latest('id')->first(),
                'advertisement' => Advertisement::latest('id')->first(),
                'sidebar'       => Sidebar::latest('id')->first(),
                'recent_posts'  => $recent_posts,
                'popular_tools' => $popular_tools,
                'siteTitle'     => env('APP_NAME'),
                'menus'         => Menu::with('children')->orderBy('sort', 'ASC')->get()->toArray(),
                'header'        => Header::latest('id')->first(),
                'advanced'      => Advanced::latest('id')->first(),
                'footer'        => FooterTranslation::where('locale', app()->getLocale())->first(),
                'socials'       => Social::orderBy('id', 'ASC')->get()->toArray(),
                'notice'        => Gdpr::latest('id')->first()
            ]);
        
        } else {
            abort(404);
        }
    }

    /**
     * Setup SEO metadata for the blog page.
     */
    private function setupSEO($general, $page)
    {
        $url   = localization()->getLocalizedURL(app()->getLocale(), '/blog', [], false);
        $image = $page->featured_image ?? '';
        $name  = config('app.name');

        // Define Title & Description based on Maintenance Mode
        if ($general->maintenance_mode ?? false) {
            $title       = __('This site is undergoing maintenance!');
            $description = __('Site is currently under maintenance. We are working hard to give you the best experience and will be back shortly.');
        } else {
            $title       = __('Our Blog');
            $description = __('Stay up to date with the latest news');
        }

        $siteName = ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME');

        // SEO Metadata
        SEOMeta::setTitle($title . $siteName);
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($url);
        SEOMeta::addMeta('robots', 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large', 'name');

        // Facebook Open Graph
        OpenGraph::addProperty('type', 'article')
                 ->addProperty('locale', localization()->getCurrentLocaleRegional())
                 ->addImage($image)
                 ->setTitle($title)
                 ->setDescription($description)
                 ->setUrl($url)
                 ->setSiteName($name);

        // Twitter Card
        TwitterCard::setType('summary_large_image')
                   ->setImage($image)
                   ->setTitle($title)
                   ->setDescription($description)
                   ->setUrl($url);
    }

    /**
     * Fetch recent posts with chunking.
     */
    private function getTranslatedPosts($type, $limit)
{
    $translatedPosts = [];

    PublicPage::with(['translations']) // Eager load translations to prevent N+1 queries
        ->where('type', $type)
        ->where('post_status', true)
        ->orderBy('id', 'DESC')
        ->chunk(50, function ($pages) use (&$translatedPosts, $limit) {
            foreach ($pages as $page) {
                if (count($translatedPosts) >= $limit) {
                    return false; // Stop processing once limit is reached
                }

                $translatedPage = $page->translate(app()->getLocale());
                if ($translatedPage) {
                    $translatedPage->slug           = $translatedPage->slug ?? $page->slug;
                    $translatedPage->target         = $translatedPage->target ?? $page->target;
                    $translatedPage->featured_image = $translatedPage->featured_image ?? $page->featured_image;
                    $translatedPosts[] = $translatedPage;
                }
            }
        });

    return $translatedPosts;
}


    /**
     * Fetch popular tools with chunking.
     */
   private function getTranslatedTools($limit)
{
    $translatedTools = [];

    PublicPage::with(['translations']) // Eager load translations to avoid N+1 query issue
        ->where('type', 'tool')
        ->where('popular', true)
        ->where('tool_status', true)
        ->orderBy('id', 'DESC')
        ->chunk(50, function ($pages) use (&$translatedTools, $limit) {
            foreach ($pages as $page) {
                if (count($translatedTools) >= $limit) {
                    return false; // Stop processing once limit is reached
                }

                $translatedPage = $page->translate(app()->getLocale());
                if ($translatedPage) {
                    $translatedPage->slug             = $translatedPage->slug ?? $page->slug;
                    $translatedPage->target           = $translatedPage->target ?? $page->target;
                    $translatedPage->custom_tool_link = $translatedPage->custom_tool_link ?? $page->custom_tool_link;
                    $translatedTools[] = $translatedPage;
                }
            }
        });

    return $translatedTools;
}

}
