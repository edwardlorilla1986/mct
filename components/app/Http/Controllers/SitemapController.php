<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Jobs\GenerateSitemap;
class SitemapController extends Controller
{
    public function index()
    {
        
        // Check if the sitemap file exists
        if (!Storage::disk('public')->exists('sitemap.xml')) {
            return response()->json(['error' => 'Sitemap not found'], 404);
        }
        GenerateSitemap::dispatch();
        // Retrieve and return the sitemap file as an XML response
        return Response::make(Storage::disk('public')->get('sitemap.xml'), 200, [
            'Content-Type' => 'text/xml'
        ]);
    }
}
