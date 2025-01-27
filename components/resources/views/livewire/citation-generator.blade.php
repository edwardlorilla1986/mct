<div>
    <div class="container mt-5">
        <h2 class="mb-4">Advanced Citation Generator</h2>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Add New Reference</h5>
                <form wire:submit.prevent="addReference">
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" id="author" class="form-control" wire:model="newReference.author">
                        @error('newReference.author') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" class="form-control" wire:model="newReference.title">
                        @error('newReference.title') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" id="year" class="form-control" wire:model="newReference.year">
                        @error('newReference.year') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="publisher" class="form-label">Publisher</label>
                        <input type="text" id="publisher" class="form-control" wire:model="newReference.publisher">
                        @error('newReference.publisher') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="format" class="form-label">Format</label>
                        <select id="format" class="form-select" wire:model="newReference.format">
                            <option value="APA">APA</option>
                            <option value="MLA">MLA</option>
                            <option value="Chicago">Chicago</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Reference</button>
                </form>
            </div>
        </div>

        <h3 class="mb-3">References</h3>

        @if($references)
            <ul class="list-group">
                @foreach($references as $index => $reference)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            {{ $this->formatReference($reference) }}
                        </div>
                        <button class="btn btn-danger btn-sm" wire:click="deleteReference({{ $index }})">Delete</button>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No references added yet.</p>
        @endif
    </div>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('reference-form');
            const referencesList = document.getElementById('references-list');
            const noReferencesMessage = document.getElementById('no-references');
            const addReferenceButton = document.getElementById('add-reference');

            // Load references from local storage
            let references = JSON.parse(localStorage.getItem('references')) || [];
            renderReferences();

            addReferenceButton.addEventListener('click', function() {
                const reference = {
                    author: form.author.value,
                    title: form.title.value,
                    year: form.year.value,
                    publisher: form.publisher.value,
                    format: form.format.value,
                };

                if (!reference.author || !reference.title || !reference.year || !reference.publisher) {
                    alert('Please fill out all fields.');
                    return;
                }

                references.push(reference);
                localStorage.setItem('references', JSON.stringify(references));
                renderReferences();
                form.reset();
            });

            function renderReferences() {
                referencesList.innerHTML = '';

                if (references.length === 0) {
                    noReferencesMessage.style.display = 'block';
                } else {
                    noReferencesMessage.style.display = 'none';
                }

                references.forEach((reference, index) => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item d-flex justify-content-between align-items-center';

                    let formattedReference = '';
                    switch (reference.format) {
                        case 'APA':
                            formattedReference = `${reference.author} (${reference.year}). ${reference.title}. ${reference.publisher}`;
                            break;
                        case 'MLA':
                            formattedReference = `${reference.author}. "${reference.title}." ${reference.publisher}, ${reference.year}.`;
                            break;
                        case 'Chicago':
                            formattedReference = `${reference.author}. ${reference.title}. ${reference.publisher}, ${reference.year}.`;
                            break;
                    }

                    listItem.innerHTML = `
                        <div>${formattedReference}</div>
                        <button class="btn btn-danger btn-sm" data-index="${index}">Delete</button>
                    `;

                    listItem.querySelector('button').addEventListener('click', function() {
                        references.splice(index, 1);
                        localStorage.setItem('references', JSON.stringify(references));
                        renderReferences();
                    });

                    referencesList.appendChild(listItem);
                });
            }
        });
    </script>