<div>

      <form wire:submit.prevent="onYoutubeEmbedCodeGenerator">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
        
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Enter YouTube Video URL') }}</label>

                <div class="input-group input-group-flat">
                    <input type="text" class="form-control" wire:model.defer="link" placeholder="https://..." required />
                    <span class="input-group-text">
                        <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect></svg>
                        </a>
                    </span>
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Size') }}
                    (<small class="text-sm text-muted">{{ __('Leave blank if you do not want to specify. Default: 560x315') }}</small>)
                </label>

                <div class="input-group">
                    <input type="text" class="form-control" wire:model.defer="size_width" placeholder="{{ __('Width') }}">
                    <div class="input-group-prepend bg-secondary">
                        <span class="input-group-text bg-secondary border-0 text-white">{{ __('x') }}</span>
                    </div>
                    <input type="text" class="form-control ps-2" wire:model.defer="size_height" placeholder="{{ __('Height') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Start time') }}
                    (<small class="text-sm text-muted">{{ __('Leave blank if you do not want to specify') }}</small>)
                </label>

                <div class="input-group">
                    <input type="text" class="form-control" wire:model.defer="start_min" placeholder="{{ __('Minute(s)') }}">
                    <div class="input-group-prepend bg-secondary">
                        <span class="input-group-text bg-secondary border-0 text-white">{{ __(':') }}</span>
                    </div>
                    <input type="text" class="form-control ps-2" wire:model.defer="start_sec" placeholder="{{ __('Second(s)') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('End time') }}
                    (<small class="text-sm text-muted">{{ __('Leave blank if you do not want to specify') }}</small>)
                </label>

                <div class="input-group">
                    <input type="text" class="form-control" wire:model.defer="end_min" placeholder="{{ __('Minute(s)') }}">
                    <div class="input-group-prepend bg-secondary">
                        <span class="input-group-text bg-secondary border-0 text-white">{{ __(':') }}</span>
                    </div>
                    <input type="text" class="form-control ps-2" wire:model.defer="end_sec" placeholder="{{ __('Second(s)') }}">
                </div>
            </div>

            <div class="form-group mb-3">
                <div class="card">
                    <div class="card-header bg-success text-white fw-bold">
                        {{ __('Options') }}
                    </div>

                    <div class="card-body">
                        <div class="form-check">
                          <input id="loop_video" class="form-check-input" type="checkbox" wire:model.defer="loop_video">
                          <label for="loop_video" class="cursor-pointer">{{ __('Loop video') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="auto_play_video" class="form-check-input" type="checkbox" wire:model.defer="auto_play_video">
                          <label for="auto_play_video" class="cursor-pointer">{{ __('Auto play video') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="hide_full_screen_button" class="form-check-input" type="checkbox" wire:model.defer="hide_full_screen_button">
                          <label for="hide_full_screen_button" class="cursor-pointer">{{ __('Hide Full-screen button') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="hide_player_controls" class="form-check-input" type="checkbox" wire:model.defer="hide_player_controls">
                          <label for="hide_player_controls" class="cursor-pointer">{{ __('Hide player controls') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="hide_youtube_logo" class="form-check-input" type="checkbox" wire:model.defer="hide_youtube_logo">
                          <label for="hide_youtube_logo" class="cursor-pointer">{{ __('Hide YouTube logo') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="no_cookie" class="form-check-input" type="checkbox" wire:model.defer="no_cookie">
                          <label for="no_cookie" class="cursor-pointer">{{ __('Privacy enhanced (only cookie when user starts video)') }}</label>
                        </div>

                        <div class="form-check">
                          <input id="responsive" class="form-check-input" type="checkbox" wire:model.defer="responsive">
                          <label for="responsive" class="cursor-pointer">{{ __('Responsive (auto scale to available width)') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            @if ( \App\Models\Admin\General::first()->captcha_status )
              <x-public.recaptcha />
            @endif

            <div class="form-group">
                <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onYoutubeEmbedCodeGenerator">
                            <x-loading />
                        </div>
                        <span wire:target="onYoutubeEmbedCodeGenerator">{{ __('Generate') }}</span>
                    </span>
                </button>
            </div>

            @if ( !empty($data) )

                <fieldset class="form-fieldset mt-3">
                    <div class="form-group mb-3">
                      <label class="form-label">{{ __('HTML embed code') }}</label>
                      <textarea id="text" class="form-control" rows="6">{{ $data }}</textarea>
                    </div>

                    <div class="form-group text-center">
                        <a class="btn btn-success" value="copy" onclick="copyToClipboard()">{{ __('Copy HTML to clipboard') }}</a>
                    </div>
                </fieldset>

                <fieldset class="form-fieldset">
                    <div class="form-group">
                        <label class="form-label">{{ __('Preview') }}</label>
                    </div>
                    
                    <div class="form-group">
                      {!! $data !!}
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