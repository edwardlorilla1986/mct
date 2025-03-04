<div>

      <form wire:submit.prevent="onYoutubeVideoStatistics">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
    
            <div class="form-group mb-3">
                <label class="form-label">{{ __('Enter YouTube Video URL') }}</label>
                <div class="col">
                    <div class="input-group input-group-flat">
                        <input type="text" class="form-control" wire:model.defer="link" placeholder="https://..." required />
                        <span class="input-group-text">
                            <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect></svg>
                            </a>
                        </span>
                    </div>
                </div>
            </div>

            @if ( \App\Models\Admin\General::first()->captcha_status )
              <x-public.recaptcha />
            @endif

            <div class="form-group">
                <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
                    <span>
                        <div wire:loading.inline wire:target="onYoutubeVideoStatistics">
                            <x-loading />
                        </div>
                        <span wire:target="onYoutubeVideoStatistics">{{ __('Statistic') }}</span>
                    </span>
                </button>
            </div>

            @if ( !empty($data) )
                 <div class="card mt-3">
                    <div class="card-header bg-success d-block text-center text-white fw-bold">
                        <h3 class="card-title">{{ __('Results') }}</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-hover table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td class="w-25">{{ __('Channel ID') }}</td>
                                        <td>{{ $data['channelId'] }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Channel Title') }}</td>
                                        <td>{{ $data['channelTitle'] }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Video Title') }}</td>
                                        <td>{{ $data['title'] }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Video Views') }}</td>
                                        <td>{{ number_format( $data['viewCount'] ) }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Video Likes') }}</td>
                                        <td>{{ number_format( $data['likeCount'] ) }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Video Comments') }}</td>
                                        <td>{{ number_format( $data['commentCount'] ) }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Published at') }}</td>
                                        <td>{{ $data['publishedAt'] }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Description') }}</td>
                                        <td>{{ $data['description'] }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Thumbnails') }}</td>
                                        <td class="badges-list">
                                            @foreach ($data['thumbnails'] as $k => $v)
                                                <span class="badge bg-green">
                                                    <a class="text-white" target="_blank" href="{{ $v['url'] }}">{{ $k }} ({{ $v['width'] . 'x' . $v['height'] }})</a>
                                                </span>
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Tags') }}</td>
                                        <td class="badges-list">
                                            @foreach ($data['tags'] as $element)
                                                <span class="badge bg-green">{{ $element }}</span>
                                            @endforeach
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Category') }}</td>
                                        <td>{{ $data['category'] }}</td>
                                    </tr>

                                    <tr>
                                        <td>{{ __('Default Language') }}</td>
                                        <td>{{ $data['defaultLanguage'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

      </form>

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