<nav class="hidden md:flex items-center justify-between text-gray-400 text-xs">
    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
        <li><a wire:click.prevent="setCategory(null)" href="{{ route('posts.index') }}" class="border-b-4 pb-3 @if ($selectedCategory === null) border-blue text-gray-900 dark:text-white @else transition duration-150 ease-in border-b-4 hover:border-blue @endif">Todas</a></li>
        @foreach ($categories as $category)
            <li><a wire:click.prevent="setCategory('{{ $category->id }}')" href="{{ route('posts.index', ['category' => $category->id]) }}" class="border-b-4 pb-3 @if ($selectedCategory == $category->id) border-blue text-gray-900 dark:text-white @else transition duration-150 ease-in border-b-4 hover:border-blue @endif">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</nav>