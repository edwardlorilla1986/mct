<?php

namespace App\Http\Livewire\Public;

use Livewire\Component;
use App\Models\Admin\Page as PublicPage;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

use App\Models\Admin\General;
use App\Models\Admin\Social;
use App\Models\Admin\User;
use App\Models\Admin\Menu;
use App\Models\Admin\Header;
use App\Models\Admin\Footer;
use App\Models\Admin\Gdpr;
use App\Models\Admin\Advanced;
use App\Models\Admin\Advertisement;
use App\Models\Admin\FooterTranslation;
use App\Models\Admin\Redirect;
use App\Models\Admin\Sidebar;
use App\Models\Admin\PageCategory;
use Illuminate\Support\Facades\Cache;
class Home extends Component
{
    public $searchQuery = '';
    
    public function render()
    {

        try {

            $pageTrans = Cache::remember('homepage_translation' . app()->getLocale(), 1440 , function () {
                return PublicPage::withTranslation()->translatedIn(app()->getLocale())->where('type', 'home')->first();
            });

            $general = Cache::remember('general_settings'. app()->getLocale(), 1440 , function () {
                return General::first();
            });

            $url         = localization()->getLocalizedURL(app()->getLocale(), '/', [], false);
            $image       = $pageTrans->featured_image;
            $name        = config('app.name');

            switch ($general->maintenance_mode) {
                case true:
                        $title       = __('This site is undergoing maintenance!');
                        $description = __('Site is currently under maintenance. We are working hard to give you the best experience and will be back shortly.');
                    break;
                
                default:
                        $title       = $pageTrans->page_title;
                        $description = $pageTrans->short_description;
                    break;
            }

            //Meta
            $siteName = $pageTrans->sitename_status ? ' ' . env('APP_SEPARATOR') . ' ' . env('APP_NAME') : '';
            SEOMeta::setTitle($title . $siteName);
            SEOMeta::setDescription($description);
            SEOMeta::setCanonical($url);
            if ( $pageTrans->robots_meta ) {
                SEOMeta::addMeta('robots', 'follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large', 'name');
            }
            else SEOMeta::addMeta('robots', 'noindex, follow', 'name');

            //Facebook
            OpenGraph::addProperty('type', 'website')
                                    ->addProperty('locale', localization()->getCurrentLocaleRegional() )
                                    ->addImage($image)
                                    ->setTitle($title)
                                    ->setDescription($description)
                                    ->setUrl($url)
                                    ->setSiteName($name);

            //Twitter
            TwitterCard::setType('summary_large_image')
                                ->setImage($image)
                                ->setTitle($title)
                                ->setDescription($description)
                                ->setUrl($url);

            $tool_with_categories = Cache::rememberForever('tool_with_categories'. app()->getLocale() , function () {
    return PageCategory::with(['pages' => function ($query) {
        $query->withTranslation(app()->getLocale());
    }])->orderBy('sort', 'ASC')->get()
    ->transform(function ($category) {
        $category->setRelation('pages', $category->pages->map(function ($page) {
            $translatedPage = $page->translate(app()->getLocale());
            if ($translatedPage) {
                $translatedPage->slug             = $page->slug;
                $translatedPage->target           = $page->target;
                $translatedPage->icon_image       = $page->icon_image;
                $translatedPage->custom_tool_link = $page->custom_tool_link;
            }
            return $translatedPage;
        })->filter());

        return $category;
    })->filter()->toArray();
});


            $tools = Cache::rememberForever('all_tools' . app()->getLocale(), function () {
    $tools = [];

    PublicPage::where('type', 'tool')
        ->where('tool_status', true)
        ->orderBy('position', 'ASC')
        ->chunk(100, function ($pages) use (&$tools) {
            foreach ($pages as $page) {
                $translatedPage = $page->translate(app()->getLocale());
                if ($translatedPage) {
                    $tools[] = $translatedPage;
                }
            }
        });

    return array_filter($tools);
});



            $recent_posts = Cache::remember('recent_posts' . app()->getLocale(), 1440, function () {
    $limit = Sidebar::first()->tool_count; // Fetch only once
    $recent_posts = [];

    PublicPage::where('type', 'post')
        ->where('post_status', true)
        ->orderBy('id', 'DESC')
        ->chunk(100, function ($pages) use (&$recent_posts, $limit) {
            foreach ($pages as $page) {
                $translatedPage = $page->translate(app()->getLocale());
                if ($translatedPage) {
                    $translatedPage->slug = $page->slug;
                    $translatedPage->target = $page->target;
                    $translatedPage->featured_image = $page->featured_image;
                    $recent_posts[] = $translatedPage;
                }
                if (count($recent_posts) >= $limit) {
                    return false; // Stop when enough records are collected
                }
            }
        });

    return array_filter($recent_posts);
});


            $popular_tools = Cache::remember('popular_tools' . app()->getLocale(), 1440, function () {
    $limit = Sidebar::first()->tool_count; // Fetch once
    $popular_tools = [];

    PublicPage::where('type', 'tool')
        ->where('popular', true)
        ->where('tool_status', true)
        ->orderBy('id', 'DESC')
        ->chunk(100, function ($tools) use (&$popular_tools, $limit) {
            foreach ($tools as $page) {
                $translatedPage = $page->translate(app()->getLocale());
                if ($translatedPage) {
                    $translatedPage->slug = $page->slug;
                    $translatedPage->target = $page->target;
                    $translatedPage->custom_tool_link = $page->custom_tool_link;
                    $popular_tools[] = $translatedPage;
                }
                if (count($popular_tools) >= $limit) {
                    return false; // Stop when we reach the required limit
                }
            }
        });

    return array_filter($popular_tools);
});



            $page = Cache::remember('homepage'. app()->getLocale(), 1440 , function () {
    return PublicPage::where('type', 'home')->first();
});
            
            $advertisement = Advertisement::first();


            $advanced = Cache::remember('advanced_settings'. app()->getLocale(), 1440 , function () {
    return Advanced::first();
});



            return view('livewire.public.home', [
                'general'              => $general,
                'tool_with_categories' => $tool_with_categories,
                'tools'                => $tools,
                'page'                 => $page,
                'advertisement'        => $advertisement
            ])->layout('layouts.public', [
                'page'          => $page,
                'pageTrans'     => $pageTrans,
                'general'       => $general,
                'profile'       => User::with('user_socials')->where('is_admin', true)->first(),
                'advertisement' => $advertisement,
                'sidebar'       => Sidebar::first(),
                'recent_posts'  => $recent_posts,
                'popular_tools' => $popular_tools,
                'siteTitle'     => env('APP_NAME'),
                'menus'         => Menu::with('children')->where(['parent_id' => 'id'])->orderBy('sort','ASC')->get()->toArray(),
                'header'        => Header::first(),
                'advanced'      => $advanced,
                'footer'        => FooterTranslation::where('locale', app()->getLocale())->first(),
                'socials'       => Social::orderBy('id', 'ASC')->get()->toArray(),
                'notice'        => Gdpr::first()
            ]);

        } catch (\Exception $e) {
            return view('livewire.public.install.welcome')->layout('layouts.install');
        }
    }
}
