<div>

    @php

        $preview = new \Jenssegers\Agent\Agent;

    @endphp

      <form wire:submit.prevent="onWhatIsMyBrowser">

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
                        <td class="fw-bold">{{ __('Your Browser') }}</td>
                        <td>{{ $preview->browser() }}</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">{{ __('Browser Version') }}</td>
                        <td>{{ $preview->version( $preview->browser() ) }}</td>
                    </tr>

                    @if ( !empty($data) )
                        <tr>
                            <td class="fw-bold">{{ __('Your User Agent') }}</td>
                            <td>{{ $data['user_agent'] }}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">{{ __('Operating System') }}</td>
                            <td>{{ $data['os']  . ' ' . $data['os_version']}}</td>
                        </tr>

                        <tr>
                            <td class="fw-bold">{{ __('Languages') }}</td>
                            <td>{{ $data['languages'] }}</td>
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
                <div wire:loading.inline wire:target="onWhatIsMyBrowser">
                  <x-loading />
                </div>
                <span wire:target="onWhatIsMyBrowser">{{ __('Show More Details') }}</span>
              </span>
            </button>
        </div>

      </form>
</div>