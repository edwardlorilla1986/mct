<div>

      <form wire:submit.prevent="onSetScreenResolution">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>
        <div class="table-responsive mb-3">
            <h3 class="p-2 text-center bg-success text-white fw-bold mb-0">{{ __('Results') }}</h3>
            <table class="table table-hover table-bordered table-striped">
                <tbody>
                        <tr>
                            <td class="fw-bold">{{ __('Your Screen Resolution') }}</td>
                            <td><span id="resolution" wire:ignore></span></td>
                        </tr>

                        @if ( !empty($data) )

                            <tr>
                                <td class="fw-bold">{{ __('Screen Width') }}</td>
                                <td>{{ $data['width'] }} {{ __('Pixels') }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Screen Height') }}</td>
                                <td>{{ $data['height'] }} {{ __('Pixels') }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('DPR (Device Pixel Ratio)') }}</td>
                                <td>{{ $data['dpr'] }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Color depth') }}</td>
                                <td>{{ $data['color'] }} {{ __('bits per pixel') }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Browser Viewport Width') }}</td>
                                <td>{{ $data['viewport_width'] }} {{ __('Pixels') }}</td>
                            </tr>

                            <tr>
                                <td class="fw-bold">{{ __('Browser Viewport Height') }}</td>
                                <td>{{ $data['viewport_height'] }} {{ __('Pixels') }}</td>
                            </tr>

                        @endif
                </tbody>
            </table>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif

        <div class="form-group">
            <button class="btn btn-info d-block mx-auto" wire:loading.attr="disabled">
              <span>
                <div wire:loading.inline wire:target="onSetScreenResolution">
                  <x-loading />
                </div>
                <span wire:target="onSetScreenResolution">{{ __('Show More Details') }}</span>
              </span>
            </button>
        </div>

      </form>

        <script>
        (function( $ ) {
          "use strict";

            document.addEventListener('livewire:load', function () {

                  jQuery('#resolution').text(screen.width + 'x' + screen.height);

                    var viewport_width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
                    var viewport_height = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;

                    window.addEventListener('onSetScreenResolution', event => {
                        window.livewire.emit('onWhatIsMyScreenResolution', screen.width, screen.height, window.devicePixelRatio, screen.colorDepth, viewport_width, viewport_height)
                    });
            });

        })( jQuery );
        </script>
</div>