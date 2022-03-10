<nav class="hidden md:flex items-center justify-between text-gray-400 text-xs">
    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="$set('category', null)" href="#" class="border-b-4 pb-3 @if ($category === null) border-blue text-gray-900 @else transition duration-150 ease-in border-b-4 hover:border-blue @endif">Todas</a></li>
        <li><a wire:click.prevent="$set('category', 'Categoría 1')" href="#" class="border-b-4 pb-3 @if ($category === 'Categoría 1') border-blue text-gray-900 @else transition duration-150 ease-in border-b-4 hover:border-blue @endif">Categoría 1</a></li>
        <li><a wire:click.prevent="$set('category', 'Categoría 2')" href="#" class="border-b-4 pb-3 @if ($category === 'Categoría 2') border-blue text-gray-900 @else transition duration-150 ease-in border-b-4 hover:border-blue @endif">Categoría 2</a></li>
    </ul>

    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="$set('category', 'Categoría 3')" href="#" class="border-b-4 pb-3 @if ($category === 'Categoría 3') border-blue text-gray-900 @else transition duration-150 ease-in border-b-4 hover:border-blue @endif">Categoría 3</a></li>
        <li><a wire:click.prevent="$set('category', 'Categoría 4')" href="#" class="border-b-4 pb-3 @if ($category === 'Categoría 4') border-blue text-gray-900 @else transition duration-150 ease-in border-b-4 hover:border-blue @endif">Categoría 4</a></li>
    </ul>
</nav>