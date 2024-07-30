<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Validate;


new class extends Component {
    #[Validate('required|string|max:255')]
    public string $name = '';
    #[Validate('required|email|max:255')]
    public string $email = '';
    #[Validate('required|string|max:255')]
    public string $subject = '';
    #[Validate('required|string|max:255')]
    public string $message = '';


    public function store(): void
    {
        $validated = $this->validate();
 
        auth()->user()->forms()->create($validated);
 
        $this->name = '';
        $this->email = '';
        $this->subject = '';
        $this->message = '';
    } 
}; ?>



<form wire:submit="store" class="space-y-6 max-w-lg mx-auto p-4 bg-white rounded-lg shadow-md" data-aos="fade-up" data-aos-delay="200">
  <div class="space-y-4">

    <div class="flex flex-col">
      <label for="name-field" class="text-sm font-medium text-gray-700">Your Name</label>
      <input type="text" wire:model="name" id="name-field" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" required>
      <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-sm" />
    </div>

    <div class="flex flex-col">
      <label for="email-field" class="text-sm font-medium text-gray-700">Your Email</label>
      <input type="email" wire:model="email" id="email-field" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" required>
      <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
    </div>

    <div class="flex flex-col">
      <label for="subject-field" class="text-sm font-medium text-gray-700">Subject</label>
      <input type="text" wire:model="subject" id="subject-field" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" required>
      <x-input-error :messages="$errors->get('subject')" class="mt-2 text-red-500 text-sm" />
    </div>

    <div class="flex flex-col">
      <label for="message-field" class="text-sm font-medium text-gray-700">Message</label>
      <textarea wire:model="message" id="message-field" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 sm:text-sm" rows="4" required></textarea>
      <x-input-error :messages="$errors->get('message')" class="mt-2 text-red-500 text-sm" />
    </div>

    <div class="text-center">
      <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50" wire:loading.attr="disabled">Send Message</button>
    </div>

  </div>
</form>


