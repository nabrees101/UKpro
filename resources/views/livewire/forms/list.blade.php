<?php

use Livewire\Volt\Component;
use App\Models\Form;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public Collection $forms;

    public function mount(): void
    {
        $this->getForms();
    }

    #[On('form-created')]
    public function getForms(): void
    {
        $this->forms = Form::with('user')
            ->latest()
            ->get();
    }

    public function delete(Form $form): void
    {
        $form->delete();
        $this->getForms();
    }
}; ?>

<div>
    <div class="mt-6 bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Message</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Delete</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($forms as $form)
                <tr wire:key="{{ $form->id }}">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-gray-800">{{ $form->name }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-gray-800">{{ $form->email }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-gray-800">{{ $form->subject }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <small class="text-sm text-gray-600">{{ $form->created_at->format('j M Y, g:i a') }}</small>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <p class="text-lg text-gray-900">{{ $form->message }}</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button type="button" 
                                wire:click="delete({{ $form->id }})" 
                                onclick="confirm('Are you sure you want to delete this chirp?')" 
                                class="px-4 py-2 bg-red-600 text-white rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                            {{ __('Delete') }}
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
