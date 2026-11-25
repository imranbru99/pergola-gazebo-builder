<x-filament-panels::page>
    <form wire:submit="generate" class="space-y-6">
        {{ $this->form }}
        <x-filament::button type="submit">Generate</x-filament::button>
    </form>

    @if ($output)
        <div class="mt-8 rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <h3 class="mb-3 text-lg font-semibold">Output</h3>
            <pre class="whitespace-pre-wrap text-sm leading-relaxed text-gray-700 dark:text-gray-200">{{ $output }}</pre>
        </div>
    @endif
</x-filament-panels::page>
