<div>

      <form wire:submit.prevent="onYoutubeDescriptionGenerator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
    
        <div class="form-group">
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col">
                        <h4 class="text-info">{{ __('About the Video') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="about_the_video_status">
                        </div>
                    </div>
                </div>
                
                <p>{{ __('A Detailed explanation of what the video is about, including important keywords.') }}</p>
                <textarea wire:model.defer="about_the_video" class="form-control" rows="5"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col">
                        <h4 class="text-info">{{ __('Timestamps') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="timestamps_status">
                        </div>
                    </div>
                </div>

                <p>{{ __('A breakdown of the main sections of your video by time. Similar to a Table of Contents Ideally these should actually be links to the specific time section of the video as well.') }}</p>
                <textarea wire:model.defer="timestamps" class="form-control" rows="5"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col">
                        <h4 class="text-info">{{ __('About the Channel') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="about_the_channel_status">
                        </div>
                    </div>
                </div>

                <p>{{ __('Briefly explain the type of content you publish on your channel.') }}</p>
                <textarea wire:model.defer="about_the_channel" class="form-control" rows="5"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col">
                        <h4 class="text-info">{{ __('Other Recommended Videos / Playlists') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="recommended_status">
                        </div>
                    </div>
                </div>

                <textarea wire:model.defer="recommended" class="form-control" rows="4"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col">
                        <h4 class="text-info">{{ __('About Our Products & Company') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="about_our_products_status">
                        </div>
                    </div>
                </div>
                
                <textarea wire:model.defer="about_our_products" class="form-control" rows="4"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col">
                        <h4 class="text-info">{{ __('Our Website') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="our_website_status">
                        </div>
                    </div>
                </div>
                
                <textarea wire:model.defer="our_website" class="form-control" rows="2"></textarea>
            </fieldset>
        </div>

        <div class="form-group">
            <fieldset class="form-fieldset">
                <div class="row">
                    <div class="col">
                        <h4 class="text-info">{{ __('Contact & Social') }}</h4>
                    </div>
                    <div class="col-auto">
                        <div class="form-check form-switch">
                          <input class="form-check-input border-white" type="checkbox" wire:model.defer="contact_status">
                        </div>
                    </div>
                </div>
                
                <textarea wire:model.defer="contact" class="form-control" rows="9"></textarea>
            </fieldset>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
        
        <div class="form-group">
            <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onYoutubeDescriptionGenerator">
                        <x-loading />
                    </div>
                    <span wire:target="onYoutubeDescriptionGenerator">{{ __('Generate') }}</span>
                </span>
            </button>
        </div>

        @if ( !empty($data) )
            <fieldset class="form-fieldset mt-3">
                <div class="form-group mb-3">
                  <label class="form-label">{{ __('Result') }}</label>
                  <textarea id="text" class="form-control" rows="20">{{ $data }}</textarea>
                </div>

                <div class="form-group text-center">
                    <a class="btn btn-success" value="copy" onclick="copyToClipboard()">{{ __('Copy selected words') }}</a>
                    <a class="btn btn-warning" wire:click.prevent="onClearInList">{{ __('Clear selected words') }}</a>
                </div>
            </fieldset>
        @endif

      </form>

      <script>
          function copyToClipboard() {
            document.getElementById("text").select();
            document.execCommand('copy');
          }
      </script>

        <script>
           (function( $ ) {
              "use strict";

                document.addEventListener('livewire:load', function () {

                      var el = document.getElementById('paste');

                      if(el){

                        el.addEventListener('click', function(paste) {

                            paste = document.getElementById('paste');

                            '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>' === paste.innerHTML ? (link.value = "", paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect></svg>') : navigator.clipboard.readText().then(function(clipText) {

                                @this.set('link', clipText);

                            }, paste.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <line x1="4" y1="7" x2="20" y2="7"></line> <line x1="10" y1="11" x2="10" y2="17"></line> <line x1="14" y1="11" x2="14" y2="17"></line> <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path> <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path> </svg>');

                        });
                      }
                });

          })( jQuery );
        </script>
</div>