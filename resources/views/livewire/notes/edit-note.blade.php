<?php




use App\Models\Note;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public Note $note;

    #[Validate('required', message: 'Please provide title for your note')]
    public $noteTitle;
    #[Validate('required', message: 'Please provide the message for your note')]
    public $noteBody;
    #[Validate('required', message: 'Please choose when you would like to send the note')]
    public $noteSendDate;
    #[Validate('required', message: 'Please enter an email address for the recipient')]
    #[Validate('email', message: 'Please enter a valid email address')]
    public $noteRecipient;
    public $noteIsPublished;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);

        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteSendDate = $note->send_date;
        $this->noteRecipient = $note->recipient;
        $this->noteIsPublished = $note->is_published;
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:20'],
            'noteSendDate' => ['required', 'date'],
            'noteRecipient' => ['required', 'email'],
            'noteIsPublished' => 'boolean'
        ]);

        $this->note->update(
            [
                'title' => $this->noteTitle,
                'body' => $this->noteBody,
                'slug' => Str::slug($this->noteTitle),
                'recipient' => $this->noteRecipient,
                'send_date' => $this->noteSendDate,
                'is_published' => $this->noteIsPublished
            ]
        );

        redirect(route('notes.index'));
    }
}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
        {{ __('Edit Note') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-4 lg:px-6">
        <div class="px-6 py-2 text-gray-900 dark:text-gray-100">
            <form class="space-y-4" wire:submit='saveNote'>
                <x-input label='Title of the note' placeholder="What's the note's title?" right-icon="inbox" wire:model='noteTitle' />
                <x-textarea label='Your Note' placeholder="What's the note's message?" right-icon="inbox" wire:model='noteBody' />
                {{-- //Validate this as email --}}
                <x-input label='Recipient of the note' placeholder="Who are you sending the note to? (Please enter an email address)" right-icon="at-symbol" type="email" wire:model='noteRecipient' />
                <x-datetime-picker :min="now()" label="Send Date" placeholder="When would you like to send the note?" wire:model="noteSendDate" />
                <x-checkbox label="Publish Note?" wire:model="noteIsPublished" />
                <x-button primary right-icon="calendar" spinner wire:click='saveNote'>Save Edited Note</x-button>
            </form>
        </div>
    </div>
</div>