<div>

      <form wire:submit.prevent="onCreditCardGenerator">

        <div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
                                        
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </div>

        <div class="form-group mb-3">
            <label class="form-label">{{ __('Select card') }}</label>
            <div class="col">
                <select wire:model.defer="type" class="form-control form-select">
                    <option value="amex">{{ __('American Express') }}</option>
                    <option value="diners">{{ __('Diners Club') }}</option>
                    <option value="discover">{{ __('Discover') }}</option>
                    <option value="jcb">{{ __('JCB') }}</option>
                    <option value="mastercard">{{ __('MasterCard') }}</option>
                    <option value="visa">{{ __('Visa') }}</option>
                </select>
            </div>
        </div>

        @if ( \App\Models\Admin\General::first()->captcha_status )
          <x-public.recaptcha />
        @endif
         
        <div class="form-group">
            <button class="btn btn-info mx-auto d-block" wire:loading.attr="disabled">
                <span>
                    <div wire:loading.inline wire:target="onCreditCardGenerator">
                        <x-loading />
                    </div>
                    <span wire:target="onCreditCardGenerator">{{ __('Generate') }}</span>
                </span>
            </button>
        </div>    

        @if ( !empty($data) )
            <div class="form-group mt-3">
                <label class="form-label">{{ __('Credit Card Number') }}</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="text" id="text" class="form-control" value="{{ $data['code'] }}">
                    </div>
                    <div class="col-auto">
                        <a class="btn btn-icon btn-success" value="copy" onclick="copyToClipboard()" title="{{ __('Copy') }}" data-bs-toggle="tooltip" data-bs-original-title="{{ __('Copy') }}">
                            <i class="fas fa-copy"></i>
                        </a>
                    </div>
                </div>
            </div>
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