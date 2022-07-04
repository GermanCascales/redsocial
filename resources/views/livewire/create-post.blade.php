<form wire:submit.prevent="createPost" action="#" method="POST" class="space-y-4 px-4 py-6">
    <div>
        <input wire:model.defer="title" type="text" name="title" class="w-full text-sm bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Título">
        <x-jet-input-error for="title" class="text-red text-xs my-1 px-1" />
    </div>
    <div>
        <select wire:model.defer="category_id" name="category_id" id="category_id" class="w-full bg-gray-100 text-sm rounded-xl border-none px-4 py-2">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <x-jet-input-error for="category_id" class="text-red text-xs my-1 px-1" />
    </div>
    <div>
        <select wire:model.defer="post_type_id" name="post_type_id" id="post_type_id" class="w-full bg-gray-100 text-sm rounded-xl border-none px-4 py-2">
            @foreach ($post_types as $post_type)
                <option value="{{ $post_type->id }}">{{ $post_type->name }}</option>
            @endforeach
        </select>
        <x-jet-input-error for="post_type_id" class="text-red text-xs my-1 px-1" />
    </div>
    <x-ck-editor name="description"/>
    <x-jet-input-error for="description" class="text-red text-xs my-1 px-1" />

    <div class="flex items-center justify-between space-x-3">
        <button type="button" class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
            <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
            </svg>
            <span class="ml-1">Adjuntar archivo</span>
        </button>
        <button type="submit" class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            <span class="ml-1">Publicar</span>
        </button>
    </div>
</form>