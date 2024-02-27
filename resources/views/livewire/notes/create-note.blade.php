<?php


use Illuminate\Support\Str;
use Livewire\Volt\Component;
use Livewire\Attributes\Validate;

new class extends Component
{
    #[Validate('required', message: 'Please provide title for your note')]
    public $noteTitle;
    #[Validate('required', message: 'Please provide the message for your note')]
    public $noteBody;
    #[Validate('required', message: 'Please choose when you would like to send the note')]
    public $noteSendDate;
    #[Validate('required', message: 'Please enter an email address for the recipient')]
    #[Validate('email', message: 'Please enter a valid email address')]
    public $noteRecipient;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteSendDate' => ['required', 'date'],
            'noteRecipient' => ['required', 'email'],
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $this->noteTitle,
                'body' => $this->noteBody,
                'slug' => Str::slug($this->noteTitle),
                'recipient' => $this->noteRecipient,
                'send_date' => $this->noteSendDate,
                'is_published' => true
            ]);

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <form class="space-y-4" wire:submit='submit'>
        <x-input label='Title of the note' placeholder="What's the note's title?" right-icon="inbox" wire:model='noteTitle' />
        <x-textarea label='Your Note' placeholder="What's the note's message?" right-icon="inbox" wire:model='noteBody' />
        {{-- //Validate this as email --}}
        <x-input label='Recipient of the note' placeholder="Who are you sending the note to? (Please enter an email address)" right-icon="at-symbol" type="email" wire:model='noteRecipient' />
        <x-datetime-picker :min="now()" label="Send Date" placeholder="When would you like to send the note?" wire:model="noteSendDate" />
        <x-button primary right-icon="calendar" spinner wire:click='submit'>Schedule note</x-button>
    </form>
</div>