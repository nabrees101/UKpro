<?php

use Livewire\Volt\Component;
use App\Models\Artical; 
use Livewire\Attributes\On; 
use Illuminate\Database\Eloquent\Collection; 

new class extends Component {
    public Collection $articals; 

    public ?Artical $editing = null; 
 
    public function mount(): void
    {
        $this->getArticals(); 
    } 

    #[On('artical-created')]
    public function getArticals(): void
    {
        $userId = auth()->user()->id;
        $this->articals = Artical::with('user')
        ->where('user_id', $userId) 
        ->latest()
        ->get();
    } 
    public function delete(Artical $artical): void
    {
 
        $artical->delete();
        $this->getArticals();
    } 

    public function edit(Artical $artical): void
    {
        $this->editing = $artical;
        $this->getArticals();
    } 

    #[On('artical-edit-canceled')]
    #[On('artical-updated')] 
    public function disableEditing(): void
    {
        $this->editing = null;
        $this->getArticals();
    } 
}; ?>

<div>
<div class="mt-6 bg-white shadow-sm rounded-lg divide-y"> 
    @foreach ($articals as $artical)
        <div class="p-6 flex space-x-2" wire:key="{{ $artical->id }}">
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                    
                        <small class="ml-2 text-sm text-gray-600">{{ $artical->created_at->format('j M Y, g:i a') }}</small>
                        @unless ($artical->created_at->eq($artical->updated_at))
                            <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                    </div>
                    <x-dropdown>
                            <x-slot name="trigger">
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                    </svg>
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <x-dropdown-link wire:click="edit({{ $artical->id }})">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                                <x-dropdown-link wire:click="delete({{ $artical->id }})" wire:confirm="Are you sure to delete this artical?"> 
                                    {{ __('Delete') }}
                                </x-dropdown-link> 
                            </x-slot>
                        </x-dropdown>
                </div>
                @if ($artical->is($editing)) 
                    <livewire:articals.edit :artical="$artical" :key="$artical->id" />
                @else
                    <p class="mt-4 text-lg text-gray-900">{{ $artical->message }}</p>
                  
                @endif 
            </div>
        </div>
    @endforeach 
</div>
