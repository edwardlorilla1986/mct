<div>
    <div class="container mt-5">
        <h2 class="mb-4">AI Story Writer</h2>

        <div class="card mb-4">
            <div class="card-body">
                <form wire:submit.prevent="generateStory">
                    <div class="mb-3">
                        <label for="prompt" class="form-label">Enter Story Prompt</label>
                        <textarea id="prompt" class="form-control" wire:model="prompt" rows="4" placeholder="Write your story idea here..."></textarea>
                        @error('prompt') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Generate Story</span>
                        <span wire:loading>Generating...</span>
                    </button>
                </form>
            </div>
        </div>

        @if($errorMessage)
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        @if($story)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Generated Story</h5>
                    <div id="generated-story" style="white-space: pre-wrap;">{{ $story }}</div>

                    <button class="btn btn-success mt-3" onclick="saveStoryToLocalStorage()">Save Story</button>
                </div>
            </div>
        @else
            <div class="text-muted">Enter a story prompt above and click "Generate Story" to see the result.</div>
        @endif

        <div class="mt-5">
            <h4>Saved Stories</h4>
            <ul id="saved-stories-list" class="list-group"></ul>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            loadSavedStories();

            window.addEventListener('save-story', event => {
                const story = event.detail.story;
                saveStoryToLocalStorage(story);
            });
        });

        function saveStoryToLocalStorage(story = null) {
            if (!story) {
                story = document.getElementById('generated-story').innerText;
            }
            
            const stories = JSON.parse(localStorage.getItem('savedStories')) || [];
            stories.push(story);
            localStorage.setItem('savedStories', JSON.stringify(stories));

            loadSavedStories();
        }

        function loadSavedStories() {
            const stories = JSON.parse(localStorage.getItem('savedStories')) || [];
            const list = document.getElementById('saved-stories-list');
            list.innerHTML = '';

            stories.forEach((story, index) => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item');
                listItem.innerText = `Story ${index + 1}: ${story.substring(0, 50)}...`;

                const deleteButton = document.createElement('button');
                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'float-end');
                deleteButton.innerText = 'Delete';
                deleteButton.onclick = () => {
                    stories.splice(index, 1);
                    localStorage.setItem('savedStories', JSON.stringify(stories));
                    loadSavedStories();
                };

                listItem.appendChild(deleteButton);
                list.appendChild(listItem);
            });
        }
    </script>
</div>
