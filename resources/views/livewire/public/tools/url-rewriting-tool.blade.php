<div>

      <form wire:submit.prevent="onUrlRewritingTool">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="row">
            <label class="form-label">{{ __('Enter URL') }}</label>
            <div class="form-group mb-3">
                <div class="input-group input-group-flat">
                    <input type="text" class="form-control" wire:model.defer="link" placeholder="https://..." required />
                    <span class="input-group-text">
                        <a id="paste" class="link-secondary cursor-pointer" title="{{ __('Paste') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Paste') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path><rect x="9" y="3" width="6" height="4" rx="2"></rect></svg>
                        </a>
                    </span>
                </div>
            </div>

            @if ( \App\Models\Admin\General::first()->captcha_status )
              <x-public.recaptcha />
            @endif

            <div class="form-group text-center">
                    <button class="btn btn-info" wire:loading.attr="disabled">
                      <span>
                        <div wire:loading.inline wire:target="onUrlRewritingTool">
                          <i class="spinner-border spinner-border-sm me-1"></i>
                        </div>
                          <span wire:target="onUrlRewritingTool">{{ __('Rewrite') }}</span>
                      </span>
                  </button>

                  <button class="btn btn-lime" wire:click.prevent="onSample" wire:loading.attr="disabled">
                      <span>
                        <div wire:loading.inline wire:target="onSample">
                          <i class="spinner-border spinner-border-sm me-1"></i>
                        </div>
                          <span wire:target="onSample">{{ __('Sample') }}</span>
                      </span>
                  </button>

                  <button class="btn btn-warning" wire:click.prevent="onReset" wire:loading.attr="disabled">
                      <span>
                        <div wire:loading.inline wire:target="onReset">
                          <i class="spinner-border spinner-border-sm me-1"></i>
                        </div>
                          <span wire:target="onReset">{{ __('Reset') }}</span>
                      </span>
                  </button>
            </div>
        </div>

        @if ( !empty($data) )

              <div class="table-responsive my-3">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="bg-secondary text-center text-white" colspan="2">{{ __('Type 1 - Single Page URL') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>{{ __('Generated URL') }}</th>
                      <td>{{ $data['arr1']['fexpl'] }}</td>
                    </tr>
                    <tr>
                      <th>{{ __('Example URL') }}</th>
                      <td>{{ $data['arr1']['expl'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p class="bg-info text-white p-3">{{ __('Create a .htaccess file with the code below The .htaccess file needs to be placed in') }} {{ $data['host'] }}</p>

              <div class="form-group position-relative mb-3">
                  <textarea class="form-control" rows="6">{{ $data['type1'] }}</textarea>
                  <a value="copy" onclick="copyToClipboard(this)" class="btn btn-icon btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                  </a>
              </div>

              <div class="table-responsive mb-3">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="bg-secondary text-center text-white" colspan="2">{{ __('Type 2 - Single Page URL') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>{{ __('Generated URL') }}</th>
                      <td>{{ $data['arr2']['fexpl'] }}</td>
                    </tr>
                    <tr>
                      <th>{{ __('Example URL') }}</th>
                      <td>{{ $data['arr2']['expl'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p class="bg-info text-white p-3">{{ __('Create a .htaccess file with the code below The .htaccess file needs to be placed in') }} {{ $data['host'] }}</p>
              
              <div class="form-group position-relative mb-3">
                  <textarea class="form-control" rows="6">{{ $data['type2'] }}</textarea>
                  <a value="copy" onclick="copyToClipboard(this)" class="btn btn-icon btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                  </a>
              </div>

              <div class="table-responsive mb-3">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="bg-secondary text-center text-white" colspan="2">{{ __('Type 3 - Single Page URL') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>{{ __('Generated URL') }}</th>
                      <td>{{ $data['arr3']['fexpl'] }}</td>
                    </tr>
                    <tr>
                      <th>{{ __('Example URL') }}</th>
                      <td>{{ $data['arr3']['expl'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p class="bg-info text-white p-3">{{ __('Create a .htaccess file with the code below The .htaccess file needs to be placed in') }} {{ $data['host'] }}</p>
              
              <div class="form-group position-relative mb-3">
                  <textarea class="form-control" rows="6">{{ $data['type3'] }}</textarea>
                  <a value="copy" onclick="copyToClipboard(this)" class="btn btn-icon btn-success cursor-pointer position-absolute top-0 end-0 m-2" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="8" y="8" width="12" height="12" rx="2"></rect> <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path> </svg>
                  </a>
              </div>

              <div class="table-responsive mb-3">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th class="bg-secondary text-center text-white" colspan="2">{{ __('Type 4 - Single Page URL') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th>{{ __('Generated URL') }}</th>
                      <td>{{ $data['arr4']['fexpl'] }}</td>
                    </tr>
                    <tr>
                      <th>{{ __('Example URL') }}</th>
                      <td>{{ $data['arr4']['expl'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <p class="bg-info text-white p-3">{{ __('Create a .htaccess file with the code below The .htaccess file needs to be placed in') }} {{ $data['host'] }}</p>
              
              <div class="form-group position-relative mt-3">
                  <textarea class="form-control" rows="6">{{ $data['type4'] }}</textarea>
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