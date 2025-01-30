<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class FakeUser extends Component
{
    public $user;

    public function mount()
    {
        $this->fetchFakeUser();
    }

    public function fetchFakeUser()
    {
        $response = Http::get("https://randomuser.me/api/");

        if ($response->successful()) {
            $this->user = $response->json()['results'][0];
        } else {
            $this->user = null;
            $this->dispatchBrowserEvent('show-alert', ['message' => 'Failed to fetch user data', 'type' => 'danger']);
        }
    }

    public function render()
    {
        return view('livewire.fake-user');
    }
}
