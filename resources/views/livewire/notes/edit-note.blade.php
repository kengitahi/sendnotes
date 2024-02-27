<?php


use App\Models\Note;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public Note $note;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
    }
}; ?>

<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-4 lg:px-6">
        <div class="px-6 py-2 text-gray-900 dark:text-gray-100 space-y-4">
            <p>{{$note->title}}</p>
            <p>{{$note->body}}</p>
            <p>{{$note->send_date}}</p>
        </div>
    </div>
</div>