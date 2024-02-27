<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create a Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-4 max-w-7xl sm:px-4 lg:px-6">
            <x-button class="mb-8" href="{{ route('notes.index') }}" icon="arrow-left" secondary>Back To All
                Notes</x-button>
            <livewire:notes.create-note />
        </div>
    </div>
</x-app-layout>