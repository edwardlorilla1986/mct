{{$page}}
@if ( $page->type == 'tool')
    <section id="tool-box">
        <div class="card mb-3">
        <div class="card-body">

          @switch($page->tool_name)
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

    @default
        <p>Tool not found or not supported.</p>
@endswitch
</div>
</div>
    </section>
@endif