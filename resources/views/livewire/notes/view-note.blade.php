<?php

use App\Models\Note;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public Note $note;

    public function mount(Note $note)
    {
        $this->fill($note);

        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteSendDate = $note->send_date;
        $this->noteRecipient = $note->recipient;
        $this->noteIsPublished = $note->is_published;
    }
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();

        redirect(route('notes.index'));
    }
}; ?>
<div class="py-12 px-6">
    <div class="mx-auto space-y-4 max-w-7xl p-4 shadow-md rounded">
        <h1 class="text-xl font-bold">{{ $note->title }}</h1>
        <p>{{ $note->body }}</p>
        <p class="text-xs">Recipient: <span class="font-bold">{{ $note->recipient }}</span></p>
        <p class="text-xs text-gray-500">
            Send date: {{ \Carbon\Carbon::parse($note->send_date)->format('d M Y') }}
        </p>
        <div class="flex gap-2">
            <x-button.circle href="{{route('notes.edit', $note)}}" icon="pencil" green></x-button.circle>
            <x-button.circle icon='trash' wire:click="delete('{{ $note->id }}')" wire:confirm='Are you sure you want to delete the note &quot;{{ $note->title}}&quot;?' negative>
            </x-button.circle>
        </div>
    </div>
</div>