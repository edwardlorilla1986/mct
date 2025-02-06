@if ( $page->type == 'tool')
    <section id="tool-box">
        <div class="card mb-3">
        <div class="card-body">

          @switch($page->tool_name)
          
          @case('json-to-ubjson-converter')
          @livewire('json-to-ubjson-converter')
        @break 
          @case('bson-to-json')
          @livewire('bson-to-json')
        @break 
          @case('jsonl-to-json')
          @livewire('jsonl-to-json')
        @break 
          @case('bencode-to-json')
          @livewire('bencode-to-json')
        @break 
          @case('toml-to-json')
          @livewire('toml-to-json')
        @break 
          @case('json-to-toml')
          @livewire('json-to-toml')
        @break 
          @case('cson-to-json')
          @livewire('cson-to-json')
        @break  
          @case('json-to-cson')
          @livewire('json-to-cson')
        @break  
          @case('json-to-table')
          @livewire('json-to-table')
        @break  
          @case('form-to-json-converter')
          @livewire('form-to-json-converter')
        @break  
           @case('json-to-form-data')
          @livewire('json-to-form-data')
        @break  
          @case('json-list')
          @livewire('json-list')
        @break
           @case('properties-to-json')
          @livewire('properties-to-json')
        @break
          @case('json-to-properties')
          @livewire('json-to-properties')
        @break
          @case('json-analyzer')
          @livewire('json-analyzer')
        @break
          @case('json-censor')
          @livewire('json-censor')
        @break
          @case('json-obfuscator')
          @livewire('json-obfuscator')
        @break
          @case('json-string-hider')
          @livewire('json-string-hider')
        @break
          @case('json-flattener')
          @livewire('json-flattener')
        @break
         @case('json-array-flattener')
          @livewire('json-array-flattener')
        @break
          @case('json-value-extractor')
          @livewire('json-value-extractor')
        @break
          @case('json-key-extractor')
          @livewire('json-key-extractor')
        @break
           @case('json-to-text-converter')
          @livewire('json-to-text-converter')
        @break
          @case('json-url-decoder')
          @livewire('json-url-decoder')
        @break
          @case('json-url-encoder')
          @livewire('json-url-encoder')
        @break
          @case('base64-to-json-converter')
          @livewire('base64-to-json-converter')
        @break
           @case('json-to-base64-converter')
          @livewire('json-to-base64-converter')
        @break
          @case('json-to-bson-converter')
         @livewire('json-to-bson-converter')
        @break
          @case('csv-to-json-converter')
         @livewire('csv-to-json-converter')
        @break
          @case('json-to-csv-converter')
         @livewire('json-to-csv-converter')
        @break
 @case('tsv-to-json-converter')
         @livewire('tsv-to-json-converter')
        @break
          @case('json-to-tsv-converter')
        @livewire('json-to-tsv-converter')
        @break
            @case('yaml-to-json-converter')
        @livewire('yaml-to-json-converter')
        @break
           @case('json-to-yaml-converter')
        @livewire('json-to-yaml-converter')
        @break
          @case('xml-to-json-converter')
        @livewire('xml-to-json-converter')
        @break
           @case('json-to-xml-converter')
        @livewire('json-to-xml-converter')
        @break
           @case('json-unescaper')
        @livewire('json-unescaper')
        @break
                    @case('json-escaper')
        @livewire('json-escaper')
        @break

          @case('advance-json-validator')
        @livewire('json-validator')
        @break
          @case('json-highlighter')
        @livewire('json-highlighter')
        @break
           @case('title-case-converter')
        @livewire('title-case-converter')
        @break
          @case('random-meal')
        @livewire('random-meal')
        @break
          @case('url-extractor')
        @livewire('url-extractor')
        @break
          @case('html-select-extractor')
        @livewire('html-select-extractor')
        @break
           @case('json-to-markdown')
        @livewire('json-to-markdown')
        @break
          @case('xml-encoder')
        @livewire('xml-encoder')
        @break
          @case('kanji-explorer')
        @livewire('kanji-explorer')
        @break
          @case('bible-viewer')
        @livewire('bible-viewer')
        @break
          @case('place-bear')
        @livewire('place-bear')
        @break
          @case('fake-user')
        @livewire('fake-user')
        @break
           @case('random-joke')
        @livewire('random-joke')
        @break
          @case('random-dog')
        @livewire('random-dog')
        @break
          @case('name-predictor')
        @livewire('name-predictor')
        @break
          @case('sudoku')
        @livewire('sudoku')
        @break
           @case('image-to-ascii')
        @livewire('image-to-ascii')
        @break
           @case('random-cocktail')
        @livewire('random-cocktail')
        @break
           @case('video-converter')
        @livewire('video-converter')
        @break
           @case('tiktok-downloader')
        @livewire('tiktok-downloader')
        @break
          @case('you-tube-downloader')
        @livewire('you-tube-downloader')
        @break
           @case('ai-workout-generator')
        @livewire('ai-workout-generator')
        @break
           @case('ai-travel-planner')
        @livewire('ai-travel-planner')
        @break
           @case('ai-personality-quiz-builder')
        @livewire('ai-personality-quiz-builder')
        @break
           @case('ai-name-generator')
        @livewire('ai-name-generator')
        @break
          @case('ai-story-writer')
        @livewire('ai-story-writer')
        @break
          @case('seo-content-optimizer')
        @livewire('seo-content-optimizer')
        @break
           @case('meta-description-generator')
        @livewire('meta-description-generator')
        @break
           @case('ai-keyword-research-tool')
        @livewire('keyword-research-tool')
        @break
           @case('headline-generator')
        @livewire('headline-generator')
        @break
          @case('paraphrasing-tool')
        @livewire('paraphrasing-tool')
        @break
          @case('Ai Article Writer')
        @livewire('ai-article-writer')
        @break
          @case('Speed Reading Test')
        @livewire('speed-reading-test')
        @break
          @case('Citation Generator')
        @livewire('citation-generator')
        @break
                    @case('Plagiarism Checker')
        @livewire('plagiarism-checker')
        @break

          @case('Plastic Usage Calculator')
        @livewire('plastic-usage-calculator')
        @break
          @case('Solar Panel Calculator')
        @livewire('solar-panel-calculator')
        @break
          @case('Water Footprint Calculator')
        @livewire('water-footprint-calculator')
        @break
          @case('Workout Planner')
        @livewire('workout-planner')
        @break
           @case('Step Counter')
        @livewire('step-counter')
        @break
          @case('Body Fat Percentage Calculator')
        @livewire('body-fat-percentage-calculator')
        @break
          @case('Heart Rate Zone Calculator')
        @livewire('heart-rate-zone-calculator')
        @break
          @case('Hydration Tracker')
        @livewire('hydration-tracker')
        @break
          @case('Sleep Tracker')
        @livewire('sleep-tracker')
        @break
                     @case('Net Worth Tracker')
        @livewire('net-worth-tracker')
        @break

           @case('Stock Roi Calculator')
        @livewire('stock-roi-calculator')
        @break
          @case('Debt Snowball Calculator')
        @livewire('debt-snowball-calculator')
        @break
          @case('Event Budget Planner')
        @livewire('event-budget-planner')
        @break
           @case('Countdown Timer')
        @livewire('countdown-timer')
        @break
          @case('Meeting Scheduler')
        @livewire('meeting-scheduler')
        @break
          @case('Kanban Board')
        @livewire('kanban-board')
        @break
          @case('Habit Tracker')
        @livewire('habit-tracker')
        @break
          @case('Daily Planner')
        @livewire('daily-planner')
        @break
          @case('Calorie Calculator')
        @livewire('calorie-calculator')
        @break
          @case('Task Prioritization Matrix')
        @livewire('task-prioritization-matrix')
        @break
           @case('Pomodoro Timer')
        @livewire('pomodoro-timer')
        @break
           @case('Carbon Footprint Calculator')
        @livewire('carbon-footprint-calculator')
        @break
          @case('Fuel Cost Calculator')
        @livewire('fuel-cost-calculator')
        @break
           @case('GPA Calculator')
        @livewire('gpa-calculator')
        @break
           @case('Payoff Calculator')
        @livewire('payoff-calculator')
        @break
          @case('BMI Calculator')
        @livewire('b-m-i-calculator')
        @break
           @case('Compound Interest Calculator')
        @livewire('compound-interest-calculator')
        @break
          @case('Mortgage Calculator')
        @livewire('mortgage-calculator')
        @break
          @case('Split Bill Calculator')
        @livewire('split-bill-calculator')
        @break
          @case('Investment Return Calculator')
        @livewire('investment-return-calculator')
        @break
          @case('Expense Tracker')
        @livewire('expense-tracker ')
        @break
           @case('Retirement Calculator')
        @livewire('retirement-calculator')
        @break
           @case('Savings Calculator')
        @livewire('savings-calculator')
        @break
          @case('Interest Rate Converter')
        @livewire('interest-rate-converter')
        @break
@case('EMI Calculator')
    @livewire('public.tools.emi-calculator')
@break

@case('Image to Text')
        @livewire('public.tools.image-to-text')
    @break

    @case('Image Compressor')
        @livewire('public.tools.image-compressor')
    @break

    @case('PowerPoint to PDF')
        @livewire('public.tools.powerpoint-to-pdf')
    @break

    @case('Word to PDF')
        @livewire('public.tools.word-to-pdf')
    @break

    @case('Excel to PDF')
        @livewire('public.tools.excel-to-pdf')
    @break

    @case('HTML to PDF')
        @livewire('public.tools.html-to-pdf')
    @break

    @case('PNG to PDF')
        @livewire('public.tools.png-to-pdf')
    @break

    @case('JPG to PDF')
        @livewire('public.tools.jpg-to-pdf')
    @break

    @case('Text to PDF')
        @livewire('public.tools.text-to-pdf')
    @break

    @case('RTF to PDF')
        @livewire('public.tools.rtf-to-pdf')
    @break

    @case('ODT to PDF')
        @livewire('public.tools.odt-to-pdf')
    @break

    @case('Word to ODT')
        @livewire('public.tools.word-to-odt')
    @break

    @case('Word to HTML')
        @livewire('public.tools.word-to-html')
    @break

    @case('WEBP to PDF')
        @livewire('public.tools.webp-to-pdf')
    @break
							@case('YouTube Channel Search')
									@livewire('public.tools.youtube-channel-search')
								@break
								
							@case('YouTube Money Calculator')
									@livewire('public.tools.youtube-money-calculator')
								@break
								
							@case('YouTube Channel Banner Downloader')
									@livewire('public.tools.youtube-channel-banner-downloader')
								@break

							@case('YouTube Channel Logo Downloader')
									@livewire('public.tools.youtube-channel-logo-downloader')
								@break

							@case('YouTube Region Restriction Checker')
									@livewire('public.tools.youtube-region-restriction-checker')
								@break

							@case('YouTube Video Statistics')
									@livewire('public.tools.youtube-video-statistics')
								@break

							@case('YouTube Channel Statistics')
									@livewire('public.tools.youtube-channel-statistics')
								@break
								
							@case('YouTube Channel ID')
									@livewire('public.tools.youtube-channel-id')
								@break

							@case('YouTube Embed Code Generator')
									@livewire('public.tools.youtube-embed-code-generator')
								@break
								
							@case('YouTube Description Generator')
									@livewire('public.tools.youtube-description-generator')
								@break

							@case('YouTube Description Extractor')
									@livewire('public.tools.youtube-description-extractor')
								@break

							@case('YouTube Title Generator')
									@livewire('public.tools.youtube-title-generator')
								@break

							@case('YouTube Title Extractor')
									@livewire('public.tools.youtube-title-extractor')
								@break

							@case('YouTube Hashtag Generator')
									@livewire('public.tools.youtube-hashtag-generator')
								@break

							@case('YouTube Hashtag Extractor')
									@livewire('public.tools.youtube-hashtag-extractor')
								@break
								
							@case('YouTube Tag Generator')
									@livewire('public.tools.youtube-tag-generator')
								@break

							@case('YouTube Tag Extractor')
									@livewire('public.tools.youtube-tag-extractor')
								@break

							@case('YouTube Trend')
									@livewire('public.tools.youtube-trend')
								@break

							@case('URL Rewriting Tool')
									@livewire('public.tools.url-rewriting-tool')
								@break
								
							@case('Backlink Checker')
									@livewire('public.tools.backlink-checker')
								@break

							@case('Article Rewriter')
									@livewire('public.tools.article-rewriter')
								@break

							@case('Keywords Suggestion Tool')
									@livewire('public.tools.keywords-suggestion-tool')
								@break
								
							@case('Adsense Calculator')
									@livewire('public.tools.adsense-calculator')
								@break
								
							@case('WordPress Theme Detector')
									@livewire('public.tools.wordpress-theme-detector')
								@break

							@case('Credit Card Validator')
									@livewire('public.tools.credit-card-validator')
								@break
								
							@case('Credit Card Generator')
									@livewire('public.tools.credit-card-generator')
								@break

							@case('URL Opener')
									@livewire('public.tools.url-opener')
								@break

							@case('Page Size Checker')
									@livewire('public.tools.page-size-checker')
								@break

							@case('Screen Resolution Simulator')
									@livewire('public.tools.screen-resolution-simulator')
								@break
								
							@case('What Is My Screen Resolution')
									@livewire('public.tools.what-is-my-screen-resolution')
								@break

							@case('Twitter Card Generator')
									@livewire('public.tools.twitter-card-generator')
								@break

							@case('Get HTTP Headers')
									@livewire('public.tools.get-http-headers')
								@break

							@case('Open Graph Generator')
									@livewire('public.tools.open-graph-generator')
								@break

							@case('Open Graph Checker')
									@livewire('public.tools.open-graph-checker')
								@break

							@case('What Is My User Agent')
									@livewire('public.tools.what-is-my-user-agent')
								@break

							@case('What Is My Browser')
									@livewire('public.tools.what-is-my-browser')
								@break
								
							@case('Hosting Checker')
									@livewire('public.tools.hosting-checker')
								@break

							@case('Server Status Checker')
									@livewire('public.tools.server-status-checker')
								@break

							@case('Moz Rank Checker')
									@livewire('public.tools.moz-rank-checker')
								@break
								
							@case('Redirect Checker')
									@livewire('public.tools.redirect-checker')
								@break

							@case('Meta Tags Analyzer')
									@livewire('public.tools.meta-tags-analyzer')
								@break

							@case('Meta Tag Generator')
									@livewire('public.tools.meta-tag-generator')
								@break

							@case('Whois Domain Lookup')
									@livewire('public.tools.whois-domain-lookup')
								@break

							@case('Htaccess Redirect Generator')
									@livewire('public.tools.htaccess-redirect-generator')
								@break

							@case('DA PA Checker')
									@livewire('public.tools.da-pa-checker')
								@break
								
							@case('Page Authority Checker')
									@livewire('public.tools.page-authority-checker')
								@break

							@case('Domain Authority Checker')
									@livewire('public.tools.domain-authority-checker')
								@break

							@case('Domain Age Checker')
									@livewire('public.tools.domain-age-checker')
								@break

							@case('HTTP Status Code Checker')
									@livewire('public.tools.http-status-code-checker')
								@break

							@case('Domain to IP')
									@livewire('public.tools.domain-to-ip')
								@break

							@case('Robots.txt Generator')
									@livewire('public.tools.robots-txt-generator')
								@break

							@case('Google Cache Checker')
									@livewire('public.tools.google-cache-checker')
								@break

							@case('Google Index Checker')
									@livewire('public.tools.google-index-checker')
								@break

							@case('Keyword Density Checker')
									@livewire('public.tools.keyword-density-checker')
								@break

              @case('WebP to PNG')
                    @livewire('public.tools.webp-to-png')
                  @break

              @case('JPG to ICO')
                    @livewire('public.tools.jpg-to-ico')
                  @break
                  
              @case('JPG to GIF')
                    @livewire('public.tools.jpg-to-gif')
                  @break

              @case('JPG to BMP')
                    @livewire('public.tools.jpg-to-bmp')
                  @break

              @case('JPG to WebP')
                    @livewire('public.tools.jpg-to-webp')
                  @break

              @case('PNG to ICO')
                    @livewire('public.tools.png-to-ico')
                  @break

              @case('PNG to GIF')
                    @livewire('public.tools.png-to-gif')
                  @break

              @case('PNG to BMP')
                    @livewire('public.tools.png-to-bmp')
                  @break

              @case('PNG to WebP')
                    @livewire('public.tools.png-to-webp')
                  @break

              @case('UTM Builder')
                    @livewire('public.tools.utm-builder')
                  @break
                  
              @case('URL Parser')
                    @livewire('public.tools.url-parser')
                  @break

              @case('UUID Generator')
                    @livewire('public.tools.uuid-generator')
                  @break

              @case('Comma Separator')
                    @livewire('public.tools.comma-separator')
                  @break
                  
              @case('Text Sorter')
                    @livewire('public.tools.text-sorter')
                  @break

              @case('Text Repeater')
                    @livewire('public.tools.text-repeater')
                  @break
                  
              @case('Disclaimer Generator')
                    @livewire('public.tools.disclaimer-generator')
                  @break

              @case('Terms And Condition Generator')
                    @livewire('public.tools.terms-and-condition-generator')
                  @break
                  
              @case('Privacy Policy Generator')
                    @livewire('public.tools.privacy-policy-generator')
                  @break

              @case('XML to JSON')
                    @livewire('public.tools.xml-to-json')
                  @break
                  
              @case('CSV to JSON')
                    @livewire('public.tools.csv-to-json')
                  @break

              @case('TSV to JSON')
                    @livewire('public.tools.tsv-to-json')
                  @break

              @case('JSON to XML')
                    @livewire('public.tools.json-to-xml')
                  @break

              @case('JSON to CSV')
                    @livewire('public.tools.json-to-csv')
                  @break

              @case('JSON to Text')
                    @livewire('public.tools.json-to-text')
                  @break

              @case('JSON to TSV')
                    @livewire('public.tools.json-to-tsv')
                  @break

              @case('JSON Minify')
                    @livewire('public.tools.json-minify')
                  @break

              @case('JSON Editor')
                    @livewire('public.tools.json-editor')
                  @break

              @case('JSON Validator')
                    @livewire('public.tools.json-validator')
                  @break

              @case('JSON Formatter')
                    @livewire('public.tools.json-formatter')
                  @break

              @case('JSON Viewer')
                    @livewire('public.tools.json-viewer')
                  @break

              @case('Roman Numerals to Number')
                    @livewire('public.tools.roman-numerals-to-number')
                  @break

              @case('Number to Roman Numerals')
                    @livewire('public.tools.number-to-roman-numerals')
                  @break
                  
              @case('Charge Converter')
                    @livewire('public.tools.charge-converter')
                  @break

              @case('Torque Converter')
                    @livewire('public.tools.torque-converter')
                  @break

              @case('Word to Number Converter')
                    @livewire('public.tools.word-to-number-converter')
                  @break

              @case('Number to Word Converter')
                    @livewire('public.tools.number-to-word-converter')
                  @break

              @case('Currency Converter')
                    @livewire('public.tools.currency-converter')
                  @break

              @case('Angle Converter')
                    @livewire('public.tools.angle-converter')
                  @break

              @case('Frequency Converter')
                    @livewire('public.tools.frequency-converter')
                  @break

              @case('Illuminance Converter')
                    @livewire('public.tools.illuminance-converter')
                  @break

              @case('Volumetric Flow Rate Converter')
                    @livewire('public.tools.volumetric-flow-rate-converter')
                  @break

              @case('Reactive Energy Converter')
                    @livewire('public.tools.reactive-energy-converter')
                  @break

              @case('Energy Converter')
                    @livewire('public.tools.energy-converter')
                  @break

              @case('Apparent Power Converter')
                    @livewire('public.tools.apparent-power-converter')
                  @break

              @case('Reactive Power Converter')
                    @livewire('public.tools.reactive-power-converter')
                  @break

              @case('Power Converter')
                    @livewire('public.tools.power-converter')
                  @break

              @case('Voltage Converter')
                    @livewire('public.tools.voltage-converter')
                  @break

              @case('Current Converter')
                    @livewire('public.tools.current-converter')
                  @break

              @case('Pressure Converter')
                    @livewire('public.tools.pressure-converter')
                  @break

              @case('Pace Converter')
                    @livewire('public.tools.pace-converter')
                  @break

              @case('Speed Converter')
                    @livewire('public.tools.speed-converter')
                  @break

              @case('Parts Per Converter')
                    @livewire('public.tools.parts-per-converter')
                  @break

              @case('Digital Converter')
                    @livewire('public.tools.digital-converter')
                  @break

              @case('Time Converter')
                    @livewire('public.tools.time-converter')
                  @break

              @case('Each Converter')
                    @livewire('public.tools.each-converter')
                  @break

              @case('Temperature Converter')
                    @livewire('public.tools.temperature-converter')
                  @break

              @case('Volume Converter')
                    @livewire('public.tools.volume-converter')
                  @break

              @case('Weight Converter')
                    @livewire('public.tools.weight-converter')
                  @break

              @case('Area Converter')
                    @livewire('public.tools.area-converter')
                  @break

              @case('Length Converter')
                    @livewire('public.tools.length-converter')
                  @break

              @case('GST Calculator')
                    @livewire('public.tools.gst-calculator')
                  @break

              @case('Loan Calculator')
                    @livewire('public.tools.loan-calculator')
                  @break

              @case('CPM Calculator')
                    @livewire('public.tools.cpm-calculator')
                  @break
                  
              @case('Discount Calculator')
                    @livewire('public.tools.discount-calculator')
                  @break

              @case('Paypal Fee Calculator')
                    @livewire('public.tools.paypal-fee-calculator')
                  @break

              @case('Probability Calculator')
                    @livewire('public.tools.probability-calculator')
                  @break

              @case('Margin Calculator')
                    @livewire('public.tools.margin-calculator')
                  @break

              @case('Sales Tax Calculator')
                    @livewire('public.tools.sales-tax-calculator')
                  @break
                  
              @case('Confidence Interval Calculator')
                    @livewire('public.tools.confidence-interval-calculator')
                  @break
                  
              @case('Average Calculator')
                    @livewire('public.tools.average-calculator')
                  @break

              @case('Percentage Calculator')
                    @livewire('public.tools.percentage-calculator')
                  @break

              @case('Age Calculator')
                    @livewire('public.tools.age-calculator')
                  @break

              @case('Decimal to Text')
                    @livewire('public.tools.decimal-to-text')
                  @break

              @case('Text to Decimal')
                    @livewire('public.tools.text-to-decimal')
                  @break

              @case('HEX to Text')
                    @livewire('public.tools.hex-to-text')
                  @break

              @case('Text to HEX')
                    @livewire('public.tools.text-to-hex')
                  @break

              @case('Octal to Text')
                    @livewire('public.tools.octal-to-text')
                  @break

              @case('Text to Octal')
                    @livewire('public.tools.text-to-octal')
                  @break

              @case('Octal to HEX')
                    @livewire('public.tools.octal-to-hex')
                  @break

              @case('HEX to Octal')
                    @livewire('public.tools.hex-to-octal')
                  @break

              @case('Decimal to Octal')
                    @livewire('public.tools.decimal-to-octal')
                  @break

              @case('Octal to Decimal')
                    @livewire('public.tools.octal-to-decimal')
                  @break

              @case('Binary to Octal')
                    @livewire('public.tools.binary-to-octal')
                  @break

              @case('Octal to Binary')
                    @livewire('public.tools.octal-to-binary')
                  @break

              @case('Decimal to HEX')
                    @livewire('public.tools.decimal-to-hex')
                  @break

              @case('HEX to Decimal')
                    @livewire('public.tools.hex-to-decimal')
                  @break

              @case('Text to ASCII')
                    @livewire('public.tools.text-to-ascii')
                  @break

              @case('ASCII to Text')
                    @livewire('public.tools.ascii-to-text')
                  @break

              @case('Binary to Decimal')
                    @livewire('public.tools.binary-to-decimal')
                  @break

              @case('Decimal to Binary')
                    @livewire('public.tools.decimal-to-binary')
                  @break
                  
              @case('Binary to ASCII')
                    @livewire('public.tools.binary-to-ascii')
                  @break

              @case('ASCII to Binary')
                    @livewire('public.tools.ascii-to-binary')
                  @break
                  
              @case('Binary to HEX')
                    @livewire('public.tools.binary-to-hex')
                  @break

              @case('HEX to Binary')
                    @livewire('public.tools.hex-to-binary')
                  @break
                  
              @case('Random Word Generator')
                    @livewire('public.tools.random-word-generator')
                  @break
                  
              @case('WebP to JPG')
                    @livewire('public.tools.webp-to-jpg')
                  @break

              @case('JPG Converter')
                    @livewire('public.tools.jpg-converter')
                  @break

              @case('PNG to JPG')
                    @livewire('public.tools.png-to-jpg')
                  @break

              @case('JPG to PNG')
                    @livewire('public.tools.jpg-to-png')
                  @break

              @case('RGB to HEX')
                    @livewire('public.tools.rgb-to-hex')
                  @break

              @case('HEX to RGB')
                    @livewire('public.tools.hex-to-rgb')
                  @break

              @case('Random Word Generator')
                    @livewire('public.tools.random-word-generator')
                  @break

              @case('Binary to Text')
                    @livewire('public.tools.binary-to-text')
                  @break

              @case('Text to Binary')
                    @livewire('public.tools.text-to-binary')
                  @break

              @case('SRT to VTT')
                    @livewire('public.tools.srt-to-vtt')
                  @break

              @case('VTT to SRT')
                    @livewire('public.tools.vtt-to-srt')
                  @break

              @case('YouTube Thumbnail Downloader')
                    @livewire('public.tools.youtube-thumbnail-downloader')
                  @break

              @case('Image Resizer')
                    @livewire('public.tools.image-resizer')
                  @break

              @case('Image Converter')
                    @livewire('public.tools.image-converter')
                  @break

              @case('Image Enlarger')
                    @livewire('public.tools.image-enlarger')
                  @break

              @case('Image Cropper')
                    @livewire('public.tools.image-cropper')
                  @break

              @case('Rotate Image')
                    @livewire('public.tools.rotate-image')
                  @break

              @case('Flip Image')
                    @livewire('public.tools.flip-image')
                  @break

              @case('Base64 to Image')
                    @livewire('public.tools.base64-to-image')
                  @break

              @case('Image to Base64')
                    @livewire('public.tools.image-to-base64')
                  @break

              @case('Find Facebook ID')
                    @livewire('public.tools.find-facebook-id')
                  @break

              @case('Remove Line Breaks')
                    @livewire('public.tools.remove-line-breaks')
                  @break

              @case('Word Counter')
                    @livewire('public.tools.word-counter')
                  @break

              @case('Password Generator')
                    @livewire('public.tools.password-generator')
                  @break

              @case('Color Converter')
                    @livewire('public.tools.color-converter')
                  @break

              @case('ICO Converter')
                    @livewire('public.tools.ico-converter')
                  @break

              @case('ICO to PNG')
                    @livewire('public.tools.ico-to-png')
                  @break

              @case('Case Converter')
                    @livewire('public.tools.case-converter')
                  @break

              @case('Lorem Ipsum Generator')
                    @livewire('public.tools.lorem-ipsum-generator')
                  @break

              @case('QR Code Generator')
                    @livewire('public.tools.qr-code-generator')
                  @break

              @case('QR Code Decoder')
                    @livewire('public.tools.qr-code-decoder')
                  @break

              @case('Javascript Obfuscator')
                    @livewire('public.tools.javascript-obfuscator')
                  @break

              @case('Javascript DeObfuscator')
                    @livewire('public.tools.javascript-de-obfuscator')
                  @break

              @case('Base64 Encode')
                    @livewire('public.tools.base64-encode')
                  @break

              @case('Base64 Decode')
                    @livewire('public.tools.base64-decode')
                  @break

              @case('HTML Encode')
                    @livewire('public.tools.html-encode')
                  @break

              @case('HTML Decode')
                    @livewire('public.tools.html-decode')
                  @break

              @case('URL Encode')
                    @livewire('public.tools.url-encode')
                  @break

              @case('URL Decode')
                    @livewire('public.tools.url-decode')
                  @break

              @case('HTML Minifier')
                    @livewire('public.tools.html-minifier')
                  @break

              @case('HTML Beautifier')
                    @livewire('public.tools.html-beautifier')
                  @break

              @case('CSS Minifier')
                    @livewire('public.tools.css-minifier')
                  @break

              @case('CSS Beautifier')
                    @livewire('public.tools.css-beautifier')
                  @break

              @case('JavaScript Minifier')
                    @livewire('public.tools.javascript-minifier')
                  @break

              @case('JavaScript Beautifier')
                    @livewire('public.tools.javascript-beautifier')
                  @break

              @case('Text to Slug')
                    @livewire('public.tools.text-to-slug')
                  @break

              @case('MD5 Generator')
                    @livewire('public.tools.md5-generator')
                  @break

              @case('What Is My IP')
                    @livewire('public.tools.what-is-my-ip')
                  @break

              @case('IP Address Lookup')
                    @livewire('public.tools.ip-address-lookup')
                  @break
                  
              @default
          @endswitch
          
        </div>
        </div>
        
        @if ( !empty($related_tools) && $general->related_tools && $page->type == 'tool' )
            <section>
                <div class="card mb-3">
                    <div class="d-block card-header related-tools-box text-start {{ ($general->related_tools_background !== 'bg-white') ? $general->related_tools_background . ' text-white' : 'bg-transparent' }}">
                      <h3 class="card-title">{{ __('Related Tools') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          @foreach ($related_tools as $key => $value)
                            <div class="col-12 col-md-6 col-lg-4 mb-3">
                                <a class="card text-decoration-none cursor-pointer item-box" href="{{ ( empty( $value['custom_tool_link'] ) ) ? route('home') . '/' . $value['slug'] : $value['custom_tool_link'] }}" target="{{ $value['target'] }}">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            @if ( $general->icon_before_tool_name_status )
                                              <img class="avatar me-3 bg-transparent {{ ($general->lazy_loading) ? 'lazyload' : '' }}" data-src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}" @if (!$general->lazy_loading) src="{{ ($value['icon_image']) ? $value['icon_image'] : asset('assets/img/no-thumb.svg') }}" @endif alt="{{ $value['title'] }}">
                                            @endif
                                            <div class="fw-medium">{{ $value['title'] }}</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                          @endforeach
                      </div>
                    </div>
                </div>
            </section>
        @endif
    </section>
@endif