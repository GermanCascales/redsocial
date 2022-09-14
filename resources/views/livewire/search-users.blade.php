<div x-data="{ showResults: @entangle('showResults') }">
    <div class="relative">
        <div class="flex rounded-md shadow-sm">
            <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-white px-2 text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>
            <input wire:model.debounce.500ms="search" type="search" class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 border-l-0 pl-1 py-1.5 focus:ring-0 focus:border-gray-300 sm:text-sm" placeholder="buscar a alguien...">
        </div>

        <ul x-cloak x-show="showResults"
            @click.away="showResults = false"
            @keydown.escape.window="showResults = false"
            x-transition.origin.top.duration.400ms
            class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" tabindex="-1" role="listbox" aria-labelledby="listbox-label" aria-activedescendant="listbox-option-3">
            @foreach ($results as $user)
                <a href="{{ route('users.show', $user->id) }}">
                    <li wire:key="result-{{ $user->id }}" class="text-gray-900 relative select-none py-3 pl-3 pr-9 hover:bg-gray-100 focus:bg-gray-100" id="listbox-option-0" role="option">
                        <div class="flex items-center">
                            <img src="{{ $user->profilePhotoThumbnail(64) }}" alt="Foto de {{ $user->name }}" class="h-6 w-6 flex-shrink-0 rounded-full">
                            <span class="font-normal ml-3 block truncate">{{ $user->name }}</span>
                        </div>
                    </li>
                </a>
            @endforeach
        </ul>
    </div>
</div>