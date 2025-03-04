<div>

        <div class="image-container mb-3">

            <div>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />
                                            
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
            </div>
            
            <div class="image-wrapper {{ ($convertType == 'remoteURL') ? 'show-remote-box' : '' }}">

                <form method="post" action="{{ url('image-compressor') }}" class="local-image-box dropzone cursor-pointer">
                    @csrf
                    <div class="dropzone-box">
                        <div class="dz-message">
                            <div class="m-4 text-center">
                                <h3 class="text-muted">{{ __('Drag and drop an image here') }}</h3>
                                <p>- {{ __('or') }} - </p>
                                <a class="btn btn-success cursor-pointer">{{ __('Choose an image') }}</a>
                                <p class="mt-3">{{ __('Maximum upload file size') }}: {{ \App\Models\Admin\General::first()->file_size }} {{ __(' MB') }}</p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive" id="previews" wire:ignore>
            <table id="template" class="table table-vcenter table-bordered">
                <thead>
                    <tr>
                      <th>{{ __('Preview') }}</th>
                      <th>{{ __('File Name') }}</th>
                      <th>{{ __('Status') }}</th>
                      <th>{{ __('Old Size') }}</th>
                      <th>{{ __('New Size') }}</th>
                      <th>{{ __('Saved') }}</th>
                      <th>{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="blur-shadow-image"><img class="avatar" data-dz-thumbnail /></td>
                        <td><span data-dz-name></span></td>
                        <td>
                            <span class="file-status">
                                <div class="progress">
                                  <div class="progress-bar progress-bar-indeterminate bg-primary"></div>
                                </div>
                            </span>
                        </td>
                        <td><span class="old_size">--</span></td>
                        <td><span class="new_size">--</span></td>
                        <td><span class="saved">--</span></td>
                        <td><a class="action btn btn-success" download>{{ __('Download') }}</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <script src="{{ asset('assets/js/dropzone.min.js') }}"></script>
        <link href="{{ asset('assets/css/dropzone.min.css') }}" rel="stylesheet">

        <script>
        (function( $ ) {
          "use strict";

            Dropzone.autoDiscover = false;

            document.addEventListener('livewire:load', function () {

                const previewNode = document.querySelector("#template");

                previewNode.id = "";

                const previewTemplate = previewNode.parentNode.innerHTML;

                previewNode.parentNode.removeChild(previewNode);

                let errors = false;

                const myDropzone = new Dropzone(".dropzone", {
                    maxFilesize: {{ \App\Models\Admin\General::first()->file_size }},
                    previewTemplate: previewTemplate,
                    previewsContainer: "#previews",
                    uploadMultiple: true,
                    parallelUploads: 1,
                    maxFiles: 1,
                    acceptedFiles: ".jpeg,.jpg,.png",
                    addRemoveLinks: false,
                    timeout: 60000,
                    maxfilesexceeded: function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    },
                   success: function (file, response) {
                        document.querySelector('.old_size').textContent = response['old_size'];
                        document.querySelector('.file-status').textContent = response['status'];
                        document.querySelector('.new_size').textContent = response['new_size'];
                        document.querySelector('.saved').textContent = response['saved'];
                        document.querySelector('a.action').href = response['link'];
                    },
                    error: function (file, response) {
                        this.removeAllFiles();
                        return false;
                    }
                });

            });

        })( jQuery );
        </script>
</div>

