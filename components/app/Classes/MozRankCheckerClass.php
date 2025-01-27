<?php 

namespace App\Classes;

class MozRankCheckerClass
{
    public function get_data($link)
    {
        // Validate the input link
        if (!filter_var($link, FILTER_VALIDATE_URL)) {
            session()->flash('status', 'error');
            session()->flash('message', 'Invalid URL provided.');
            return null;
        }

        try {
            // Use Google Search to simulate backlink checking
            $googleSearchUrl = "https://www.google.com/search?q=link:" . urlencode($link);

            // Get the HTML content of the search results
            $html = file_get_contents($googleSearchUrl);

            // Parse links and calculate metrics
            $backlinks = $this->parse_links($html);
            $linkingDomains = array_unique(array_map([$this, 'extract_domain'], $backlinks));

            // Simulated authority and rank (basic approximation)
            $domainAuthority = $this->calculate_authority(count($linkingDomains));
            $pageAuthority = $this->calculate_authority(count($backlinks));

            // Return data
            return [
                'link' => $link,
                'moz_rank' => $domainAuthority, // Simulated Moz Rank
                'domain_authority' => $domainAuthority,
                'page_authority' => $pageAuthority,
                'linking_domains' => count($linkingDomains),
                'total_links' => count($backlinks),
            ];
        } catch (\Exception $e) {
            // Log and handle errors
            \Log::error('MozRankCheckerClass Error: ' . $e->getMessage());
            session()->flash('status', 'error');
            session()->flash('message', 'Failed to retrieve Moz Rank data.');
            return null;
        }
    }

    /**
     * Parse backlinks from HTML.
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

    /**
     * Extract the domain from a URL.
     *
     * @param string $url The URL to extract the domain from.
     * @return string The extracted domain.
     */
    private function extract_domain($url)
    {
        return parse_url($url, PHP_URL_HOST);
    }

    /**
     * Calculate authority based on the number of backlinks or linking domains.
     *
     * @param int $count The number of backlinks or linking domains.
     * @return int Simulated authority score (0-100).
     */
    private function calculate_authority($count)
    {
        if ($count === 0) {
            return 0;
        }

        // Simulate authority: log-scale calculation
        return min(100, round(log($count) * 20));
    }
}
