<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-4 lg:px-6">
            <div class="px-6 py-2 text-gray-900 dark:text-gray-100">
                <livewire:notes.show-notes />
            </div>
        </div>
    </div>
</x-app-layout>
