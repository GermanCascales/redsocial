<div>
    @if (Gate::check('addTeamMember', $team))
        <x-jet-section-border />

        <!-- Add Team Member -->
        <div class="mt-10 sm:mt-0">
            <x-jet-form-section submit="createCategory">
                <x-slot name="title">
                    Crear categorías
                </x-slot>

                <x-slot name="description">
                    Crea una nueva categoría para este equipo.
                </x-slot>

                <x-slot name="form">
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="category" value="Nombre de la nueva categoría" />
                        <x-jet-input id="category" type="text" class="mt-1 block w-full" wire:model.defer="category" />
                        <x-jet-input-error for="category" class="mt-2" />
                    </div>

                    @if (count($this->categories) > 0)
                        <div class="col-span-6 lg:col-span-4">
                            <x-jet-label for="category" value="Categorías" />

                            <div class="relative z-0 mt-1 border border-gray-200 rounded-lg">
                                @foreach ($this->categories->sortBy('name') as $index => $category)
                                    <div class="relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 {{ $index > 0 ? 'border-t border-gray-200 rounded-t-none' : '' }} {{ ! $loop->last ? 'rounded-b-none' : '' }}">
                                        <div class="flex items-center">
                                            <div class="text-sm text-gray-600 font-semibold">
                                                {{ $category->name }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </x-slot>

                <x-slot name="actions">
                    <x-jet-action-message class="mr-3" on="saved">
                        {{ __('Saved.') }}
                    </x-jet-action-message>

                    <x-jet-button>
                        {{ __('Add') }}
                    </x-jet-button>
                </x-slot>
            </x-jet-form-section>
        </div>
    @endif
</div>
