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
            SEOMeta::addKeyword([
    "Text Analysis Tools", "SEO Optimization", "Keyword Density", "Readability Checker", "Plagiarism Detector", "Sentiment Analysis", "Content Writing", "Grammar Checker", "Blogging Tools",
    "Website Tracking", "Visitor Analytics", "Traffic Sources", "SEO Rankings", "Conversion Optimization", "User Engagement", "Business Growth", "Web Performance", "Google Index Checker", "Domain Authority",
    "YouTube SEO", "Video Optimization", "YouTube Analytics", "Thumbnail Generator", "Tag Extractor", "Title Generator", "YouTube Growth", "YouTube Monetization", "Channel Insights", "Video Performance",
    "PDF Converter", "Word to PDF", "Excel to PDF", "JPG to PDF", "PNG to PDF", "Online PDF Tools", "PowerPoint to PDF", "RTF to PDF", "HTML to PDF", "PDF Editing",
    "Text Content Tools", "Word Counter", "Case Converter", "Text Repeater", "Random Word Generator", "Privacy Policy Generator", "Terms and Conditions Generator", "Disclaimer Generator", "Lorem Ipsum Generator",
    "Image Editing", "Image Compressor", "JPG to PNG", "PNG to JPG", "Image Resizer", "Image Cropper", "WebP Converter", "ICO Converter", "Flip Image", "Rotate Image", "Base64 Image Converter",
    "Online Calculators", "Age Calculator", "Discount Calculator", "Loan Calculator", "Mortgage Calculator", "EMI Calculator", "GPA Calculator", "Carbon Footprint Calculator", "Compound Interest", "Investment Calculator", "Payoff Calculator",
    "AI Tools", "AI Article Writer", "AI Paraphrasing", "AI Resume Builder", "AI Email Generator", "AI Logo Creator", "AI Content Generator", "AI Story Writer", "AI Keyword Research", "AI SEO Optimizer", "AI Headline Generator",
    "Unit Converters", "Currency Converter", "Temperature Converter", "Speed Converter", "Power Converter", "Time Converter", "Area Converter", "Weight Converter", "Pressure Converter", "Digital Unit Converter",
    "Binary Tools", "Text to Binary", "Binary to Decimal", "HEX to Binary", "ASCII Converter", "Binary to Octal", "Octal to HEX", "Decimal to HEX", "Text to HEX", "HEX to Text Converter",
    "Website Management", "URL Encoder", "URL Shortener", "Meta Tag Generator", "Robots.txt Generator", "WordPress Tools", "Adsense Calculator", "Domain Lookup", "Server Status Checker", "Keyword Density Checker",
    "Development Tools", "JSON Formatter", "JSON Validator", "JSON to XML", "CSV to JSON", "JSON to Base64", "XML to JSON", "HTML Minifier", "CSS Beautifier", "JavaScript Formatter", "UTM Builder",
    "Other Tools", "IP Address Lookup", "QR Code Generator", "Password Generator", "Whois Lookup", "Task Management", "Sudoku Game", "Meeting Scheduler", "Pomodoro Timer", "Habit Tracker", "Step Counter", "Workout Planner", "Free text analysis tools", "SEO keyword density checker", "AI content optimizer", "Best grammar checker online",
    "Readability score checker", "Plagiarism checker free", "Sentiment analysis tool", "Free blogging tools for SEO",
    "AI-powered writing assistant", "Best free keyword research tool",

    "Best website tracking tools", "Free visitor analytics software", "Google index checker tool", "SEO backlink checker free",
    "Domain authority checker online", "Improve website ranking fast", "Best conversion rate optimization tools",
    "Real-time traffic analysis tool", "Website performance optimization", "Boost organic traffic fast",

    "YouTube keyword research tool", "Free YouTube video optimizer", "YouTube tag generator free",
    "Best YouTube thumbnail maker", "Grow YouTube channel fast", "YouTube title generator AI",
    "Video SEO optimization tool", "YouTube hashtag generator", "YouTube video description generator",
    "Increase YouTube views fast",

    "Convert Word to PDF free", "Best free PDF converter", "Convert JPG to PDF online", "Compress PDF file size",
    "Free PDF editor online", "Convert Excel to PDF", "Best online document converter", "Fastest PDF to Word converter",
    "Merge PDF files free", "Extract text from PDF",

    "Free online image resizer", "Best image compressor tool", "Convert PNG to JPG free", "Image cropper online",
    "Resize images without losing quality", "Convert WebP to JPG", "ICO to PNG converter", "Best image to text converter",
    "Flip and rotate images online", "Compress PNG images for SEO",

    "Best AI article writer", "AI-powered paraphrasing tool", "Generate blog post ideas with AI",
    "AI resume builder online", "Best AI email generator", "AI-powered logo maker", "SEO content optimizer AI",
    "AI-generated headlines for blogs", "AI-powered travel planner", "Best AI keyword research tool","best free text analysis tools", "AI content optimizer online", "SEO keyword density checker tool", "plagiarism checker free online",
    "best grammar checker for bloggers", "readability score checker tool", "sentiment analysis tool free", "AI-powered writing assistant free",
    "best keyword research tool for SEO", "SEO content optimization tool",

    "best website tracking tools 2024", "free visitor analytics software", "Google index checker free", "SEO backlink checker online",
    "domain authority checker tool", "how to improve website ranking fast", "best conversion rate optimization tools",
    "real-time website traffic analysis", "boost organic traffic instantly", "best free SEO audit tool",

    "YouTube keyword research tool 2024", "best free YouTube video optimizer", "YouTube tag generator online",
    "grow YouTube channel fast free", "best YouTube thumbnail maker AI", "YouTube SEO optimization tool",
    "increase YouTube video views organically", "best YouTube title generator AI", "YouTube hashtag generator free",
    "best YouTube description generator",

    "convert Word to PDF free online", "best free PDF converter tool", "compress PDF file size without losing quality",
    "extract text from PDF online", "fastest PDF to Word converter free", "merge PDF files free without watermark",
    "best PDF editor online 2024", "convert Excel to PDF instantly", "JPG to PDF high quality", "best online document converter",

    "best image compressor online", "convert PNG to JPG free", "image resizer without losing quality", "best free image cropper tool",
    "flip and rotate images online", "convert WebP to JPG free", "best ICO to PNG converter", "image to text converter AI",
    "compress PNG images for SEO", "best free image optimization tool",

    "best AI article writer free", "AI-powered paraphrasing tool online", "generate blog post ideas with AI",
    "best AI resume builder free", "best AI email generator online", "AI-powered logo maker free", "SEO content optimizer AI",
    "best AI-generated headlines for blogs", "AI-powered travel planner 2024", "best AI keyword research tool",

    "best online age calculator", "mortgage calculator with amortization", "loan payment calculator free", "EMI calculator online 2024",
    "best retirement savings calculator", "GPA calculator free online", "stock ROI calculator free", "investment return calculator",
    "best discount calculator tool", "carbon footprint calculator online 2024",

    "convert text to binary online free", "best binary to decimal converter", "HEX to binary tool free",
    "convert ASCII to binary instantly", "decimal to HEX converter online", "best currency converter tool",
    "temperature converter Celsius to Fahrenheit", "best length conversion tool", "fastest time zone converter free",
    "weight to volume converter online",

    "best free meta tag generator", "Robots.txt generator online", "how to optimize keyword density for SEO",
    "fastest WordPress theme detector", "free website uptime checker tool", "how to find Facebook ID online",
    "best QR code generator free", "HTML minifier online free", "CSS to minified CSS converter", "best JSON formatter tool",
"Auto insurance quote", "Car insurance quotes", "Best auto insurance companies", "Compare car insurance rates",
    "Home insurance policy", "Business insurance coverage", "Health insurance plans", "Life insurance premium calculator",

    "Motorcycle injury lawyer", "Personal injury attorney", "Spinal cord injury attorney", "Medical malpractice lawyer",
    "Workers' compensation attorney", "Best DUI lawyer", "Birth injury attorney", "Wrongful death attorney",

    "Fidelity crypto", "Best crypto trading platform", "Investing in cryptocurrency", "Bitcoin investment strategy",
    "Ethereum price prediction", "Crypto mining profitability", "How to buy Bitcoin safely", "Best crypto wallet 2024",

    "Online college degree programs", "Best online MBA programs", "Free online courses with certificates",
    "Online school accreditation", "Top online universities", "Affordable online degree programs", "E-learning platforms",
    "Online certification courses",

    "Sell my house fast", "Best real estate agent near me", "Buy house with no money down", "Best real estate websites",
    "Real estate market trends", "Luxury homes for sale", "Commercial property investment", "How to flip houses for profit",

    "Best weight loss programs", "Affordable health insurance", "Private health care plans", "Medical insurance quotes",
    "Home workout routines", "Best diet for weight loss", "Top fitness apps", "Best supplements for muscle gain",

    "Best financial planners", "High-interest savings accounts", "Credit score improvement tips", "Best budgeting tools",
    "How to invest in stocks", "Retirement savings calculator", "Debt consolidation loans", "How to build wealth fast",

    "Best SEO companies", "Search engine marketing services", "Email marketing automation", "Social media advertising",
    "Pay-per-click advertising", "Affiliate marketing strategies", "Best content marketing agencies", "YouTube video monetization",

    "Best web hosting for WordPress", "Cloud hosting providers", "Cheap VPS hosting", "Dedicated server hosting plans",
    "GoDaddy website builder", "Bluehost vs SiteGround", "How to start a blog", "Best website builders for SEO",

    "Best online banking apps", "Top fintech startups", "Mobile payment solutions", "Cryptocurrency banking services",
    "How to transfer money internationally", "Best online payment gateways", "Digital banking security", "Best credit cards with cashback",
    "check my IP address online", "best password generator free", "QR code scanner free online", "find domain age checker free",
    "track my website visitors instantly", "what is my user agent tool", "best free stopwatch and countdown timer",
    "top habit tracker app free", "best AI-powered workout planner", "best free event budget planner 2024",

    "Free online age calculator", "Best mortgage calculator", "Loan payment calculator", "EMI calculator online",
    "Best retirement savings calculator", "GPA calculator free", "Stock ROI calculator", "Investment return calculator",
    "Best discount calculator", "Carbon footprint calculator online",

    "Convert text to binary online", "Best binary to decimal converter", "HEX to binary tool",
    "Convert ASCII to binary", "Decimal to HEX converter", "Best currency converter online",
    "Temperature converter Celsius to Fahrenheit", "Best length conversion tool", "Time zone converter free",
    "Weight to volume converter",

    "Best free meta tag generator", "Robots.txt generator online", "Optimize keyword density for SEO",
    "Fastest WordPress theme detector", "Website uptime checker free", "Find Facebook ID online",
    "Best QR code generator free", "HTML minifier online", "CSS to minified CSS converter", "Free JSON formatter tool",

    "Check my IP address", "Best password generator online", "QR code scanner free", "Find domain age checker",
    "Track my website visitors", "What is my user agent", "Free stopwatch and countdown timer",
    "Best habit tracker online", "AI-powered workout planner", "Best free event budget planner"
]);
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


            $tools = Cache::rememberForever('all_tools' . "en", function () {
    $tools = [];

    PublicPage::where('type', 'tool')
        ->where('tool_status', true)
        ->orderBy('position', 'ASC')
        ->chunk(100, function ($pages) use (&$tools) {
            foreach ($pages as $page) {
                $translatedPage = $page->translate("en");
                if ($translatedPage) {
                    $tools[] = $translatedPage;
                }
            }
        });

    return array_filter($tools);
});



            $recent_posts = Cache::remember('recent_posts' . "en", 1440, function () {
    $limit = Sidebar::first()->tool_count; // Fetch only once
    $recent_posts = [];

    PublicPage::where('type', 'post')
        ->where('post_status', true)
        ->orderBy('id', 'DESC')
        ->chunk(100, function ($pages) use (&$recent_posts, $limit) {
            foreach ($pages as $page) {
                $translatedPage = $page->translate("en");
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


            $popular_tools = Cache::remember('popular_tools' . "en", 1440, function () {
    $limit = Sidebar::first()->tool_count; // Fetch once
    $popular_tools = [];

    PublicPage::where('type', 'tool')
        ->where('popular', true)
        ->where('tool_status', true)
        ->orderBy('id', 'DESC')
        ->chunk(100, function ($tools) use (&$popular_tools, $limit) {
            foreach ($tools as $page) {
                $translatedPage = $page->translate("en");
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
