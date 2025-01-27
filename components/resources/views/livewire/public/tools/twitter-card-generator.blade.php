<div>

    <form wire:submit.prevent="onTwitterCardGenerator">
        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Select type') }}</label>
            <select wire:model.defer="type" class="form-control form-select">
                <option value="app">{{ __('App') }}</option>
                <option value="player">{{ __('Player') }}</option>
                <option value="product">{{ __('Product') }}</option>
                <option value="summary">{{ __('Summary') }}</option>
                <option value="summary_large_image">{{ __('Summary With Large Image') }}</option>
            </select>
        </div>
   
        <div class="form-group mb-3">
            <label class="form-label">{{ __('Site Username') }}</label>
            <input type="text" class="form-control" wire:model.defer="site_username"/>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('App Name') }}</label>
            <input type="text" class="form-control" wire:model.defer="app_name"/>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('iPhone App ID') }}</label>
            <input type="text" class="form-control" wire:model.defer="iphone_app_id"/>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('iPad App ID') }}</label>
            <input type="text" class="form-control" wire:model.defer="ipad_app_id"/>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Google Play App ID') }}</label>
            <input type="text" class="form-control" wire:model.defer="google_play_app_id"/>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('App Country (If Not Available in US Store)') }}</label>
            <input type="text" class="form-control" wire:model.defer="app_country"/>
        </div>

        <div class="form-group mb-3">
          <label class="form-label col-3 col-form-label">{{ __('Number of Images') }}</label>
          <div class="col">
            <div class="col mb-3">
                <div class="input-group input-group-flat">
                    <input type="text" class="form-control" wire:model.defer="images.0">
                    @error('images.0') <span class="error">{{ $message }}</span> @enderror
                    <span class="input-group-text">
                        <button class="btn btn-sm btn-icon bg-success text-white rounded mb-0" wire:click.prevent="onAddImage( {{ $i }} )" title="{{ __('Add new') }}">
                            <i class="fas fa-plus fa-fw "></i>
                        </button>
                    </span>
                </div>
            </div>

            @foreach($inputs as $key => $value)
                <div class="col mb-3">
                    <div class="input-group input-group-flat">
                        <input type="text" class="form-control" wire:model.defer="images.{{ $value }}">
                        @error( 'images.' . $value ) <span class="error">{{ $message }}</span> @enderror
                        <span class="input-group-text">
                            <button class="btn btn-sm btn-icon bg-danger text-white rounded mb-0" wire:click.prevent="onDeleteImage({{ $key }})" title="{{ __('Delete') }}">
                                <i class="fas fa-trash fa-fw "></i>
                            </button>
                        </span>
                    </div>
                </div>
            @endforeach
          </div>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Description') }}</label>
            <textarea maxlength="200" wire:model.defer="description" rows="5" placeholder="{{ __('Up to 200 characters.') }}" class="form-control"></textarea>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif

        <div class="form-group">
            <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onTwitterCardGenerator">
                        <x-loading />
                    </div>
                    <span wire:target="onTwitterCardGenerator">{{ __('Generate') }}</span>
                </span>
            </button>
        </div>

        @if ( !empty($data) )
          <div class="form-group position-relative mt-3">
              <textarea class="form-control" rows="10" readonly>{{ $data }}</textarea>
              <a value="copy" onclick="copyToClipboard(this)" class="btn btn-icon btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
              </a>
          </div>
        @endif
    </form>

      <script>
          function copyToClipboard(element) {
              var text = element.parentElement.querySelector('textarea');
              text.select();
              document.execCommand("copy");
          }
      </script>
</div>