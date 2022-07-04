<div
    x-cloak x-data="{ isOpen: false }"
    x-init="Livewire.on('postUpdated', () => {
                isOpen = false
            })"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    @custom-show-edit.window="isOpen = true; $nextTick(() => $refs.titleInput.focus())"
    class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div x-show="isOpen" x-transition.opacity.duration.400ms class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

  <div x-show="isOpen" x-transition.origin.top.duration.400ms class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end sm:items-center justify-center min-h-full">
      <div @click.away="isOpen = false" class="modal bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
        <div class="absolute top-0 right-0 pt-4 pr-4">
            <button @click="isOpen = false" class="text-gray-400 hover:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <form wire:submit.prevent="updatePost" action="#" method="POST">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <h3 class="text-center text-lg font-medium text-gray-900">Editar Post</h3>
            <div class="space-y-4 px-4 py-6">
                <div>
                    <input wire:model.defer="title" type="text" name="title" class="w-full text-sm bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Título" x-ref="titleInput">
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
                    <button type="button" class="flex items-center justify-center w-full h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                        <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <span class="ml-1">Adjuntar archivo</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">Editar</button>
          <button type="button" @click="isOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancelar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>