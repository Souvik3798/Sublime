<x-filament-panels::page>
    <form wire:submit.prevent="submit" class="w-full bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Update Website Information</h2>

        <div class="mb-4">
            {{ $this->form->getComponent('url')->render() }}
            <small class="text-gray-500">Enter the full URL, including http:// or https://</small>
        </div>

        <iframe src="{{ $this->url }}" frameborder="0" width="100%" height="100%" style="height: 100%;"></iframe>

        <div class="mb-4">
            {{ $this->form->getComponent('query')->render() }}
            <small class="text-gray-500">Enter the query parameters, if any.</small>
        </div>

        <div class="flex justify-end mt-6">
            <x-filament::button type="submit" form="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Send Query
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
