<?php 

namespace App\Classes;

class BacklinkCheckerClass {

    public function get_data($link)
    {
        // Validate URL
        if (!filter_var($link, FILTER_VALIDATE_URL)) {
            session()->flash('status', 'error');
            session()->flash('message', 'Invalid URL provided.');
            return null;
        }

        try {
            // Use Google Search to find backlinks
            $googleSearchUrl = "https://www.google.com/search?q=link:" . urlencode($link);
            
            // Get the HTML content of the search results
            $html = file_get_contents($googleSearchUrl);

            // Parse links from the search results
            $backlinks = $this->parse_links($html);

            // Prepare output data
            $data = [
                'link' => $link,
                'domain_authority' => 'Not Available (Free Version)', // Placeholder for free version
                'linking_domains' => count($backlinks),
                'total_links' => count($backlinks),
                'backlinks' => $backlinks, // Optional: List of backlinks found
            ];

            return $data;

        } catch (\Exception $e) {
            // Log errors and flash user-friendly messages
            \Log::error('Error in BacklinkCheckerClass: ' . $e->getMessage());
            session()->flash('status', 'error');
            session()->flash('message', 'Failed to retrieve backlink data.');
            return null;
        }
    }

    /**
     * Parse backlinks from Google search results.
     *
     * @param string $html The HTML content of the search results.
     * @return array List of backlinks found.
     */
    private function parse_links($html)
    {
        $backlinks = [];

        // Suppress warnings from invalid HTML
        libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);

        // Extract all anchor tags
        $nodes = $xpath->query("//a");

        foreach ($nodes as $node) {
            $href = $node->getAttribute('href');

            // Filter out irrelevant links
            if ($href && strpos($href, 'http') !== false && !strpos($href, 'google.com')) {
                $backlinks[] = $href;
            }
        }

        return $backlinks;
    }
}
