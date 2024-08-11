<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{

    public User $user;
    public Company $company;
    public $imagePreview;

    public function mount()
    {
        $this->user = User::find(Auth::id());
        $this->company = $this->user->company;
    }

    public function rules()
    {
        return [
            'user.name' => 'required|string:max:100|min:2',
            'user.adrress' => 'requirred|string:max:100,',
            'user.password' => 'nullable|string|min:8|max:12',
            'user.newPassword' => 'nullable|string|min:8|max:12',
            'user.phone' => 'required|numeric|digits_between:6,12',
            'user.document_number' => 'required|numeric|digits_between:8,22',
        ];
    }

    public function updatedImage()
    {
        $this->imagePreview = $this->image->temporaryUrl();
    }

    public function updateUserProfile()
    {
        $this->validate($this->rules());
        
    }
    public function render()
    {
        return view('livewire.profile.index');
    }
}
