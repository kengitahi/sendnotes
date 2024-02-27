<?php


use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use App\Models\User;
use App\Models\Note;

new class extends Component
{
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }

    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
    }
}; ?>

<div>
    <div class="space-y-4">
        @if ($notes->isEmpty())
        <div class="space-y-2 text-left">
            <p class="text-xl font-bold"> Hi {{ User::getFirstName() }}, you haven't added any notes yet.</p>
            <p class="text-sm">Let's create the first note you would like to send.</p>
            <x-button href="{{ route('notes.create') }}" primary right-icon="plus" wire:navigate>Create
                Note</x-button>
        </div>
        @else
        <div class="space-y-2 text-left">
            <x-button href="{{ route('notes.create') }}" primary right-icon="plus" wire:navigate>Add New
                Note</x-button>
        </div>
        <h2 class="text-xl font-bold">Here are your the notes you have already created</h2>
        @foreach ($notes as $note)
        <x-card wire:key='{{ $note->id }}'>
            <div class="grid grid-cols-2 gap-4 p-4">
                <div class="flex flex-col justify-between gap-4">
                    <a class="text-xl font-bold hover:text-blue-500 hover:underline" href="{{route('notes.edit', $note)}}">{{ $note->title }}</a>
                    <p>{{ $note->body }}</p>
                    <p class="text-xs">Recipient: <span class="font-bold">{{ $note->recipient }}</span></p>

                </div>
                <div class="flex flex-col items-end justify-between space-x-1">
                    <p class="text-xs text-gray-500">
                        Send date: {{ \Carbon\Carbon::parse($note->send_date)->format('d M Y') }}
                    </p>
                    <div class="flex gap-2">
                        <x-button.circle href="{{ route('notes.view', ['id' => $note->id]) }}"></x-button.circle>
                        <x-button.circle icon='trash' wire:click="delete('{{ $note->id }}')" wire:confirm="Are you sure you want to delete this note?">
                        </x-button.circle>
                    </div>
                </div>
            </div>
        </x-card>
        @endforeach
        @endif
    </div>
</div>