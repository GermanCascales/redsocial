<x-jet-form-section submit="updateCategories">
    <x-slot name="title">
        Cambiar categorías
    </x-slot>

    <x-slot name="description">
        Modifica las categorías que se verán en la pantalla principal.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="categories" value="Categorías" />
            <div class="mt-1 block w-full">
                <select wire:model="selectedCategories" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <x-jet-input-error for="selectedCategories" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
