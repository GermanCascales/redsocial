<div x-cloak x-data="{ creatingPost: false }" :class="creatingPost ? 'md:flex-col' : 'md:flex-row'" class="flex flex-col">
<div :class="creatingPost ? 'w-full md:mb-8' : 'w-70'" class="mx-auto md:mx-0 md:mr-5 transition-all transition-slowest ease">
    <div class="bg-white dark:bg-slate-800 md:sticky md:top-8 border border-blue rounded-xl md:mt-16">

        <div x-show="creatingPost" class="absolute right-0 pt-4 pr-4">
            <button @click="creatingPost = false" class="text-gray-400 hover:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="text-center px-6 py-2 pt-6">
            <h3 class="font-semibold text-base">Crea un post</h3>
            <p class="text-xs mt-4">Escribe tu pregunta o lo que piensas</p>
        </div>

        <div @click="creatingPost = true">
            @if(auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'create'))
                <livewire:create-post :categories="$categories" :post_types="$post_types" />
            @else
                <p class="text-center text-red text-s mt-4">No tiene permiso para publicar</p>
            @endif
        </div>
    </div>
</div>

<div :class="creatingPost ? 'md:w-full' : 'md:w-175'" class="w-full px-2 md:px-0 md:w-175 transition-all">
    <livewire:categories-links />

    <div class="mt-8">
        <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
            <div class="w-full md:w-1/3">
                <select name="category" id="category" class="dark:bg-slate-600 w-full rounded-xl border-none px-4 py-2">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full md:w-1/3">
                <select name="other_filters" id="other_filters" class="dark:bg-slate-600 w-full rounded-xl border-none px-4 py-2">
                    <option value="Mensaje">Mensaje</option>
                    <option value="PreguntaTwo">Pregunta</option>
                    <option value="Sugerencia">Sugerencia</option>
                </select>
            </div>
            <div class="w-full md:w-2/3 relative">
                <input wire:model.debounce.500ms="search" type="search" placeholder="buscar..." class="w-full rounded-xl bg-white dark:bg-slate-600 border-none placeholder-gray-900 dark:placeholder-slate-100 px-4 py-2 pl-8">
                <div class="absolute top-0 flex itmes-center h-full ml-2">
                    <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
        </div> <!-- end filters -->

        <div class="posts-container space-y-6 my-8">
            @forelse ($posts as $post)
                <livewire:index-post :post="$post" :likes="$post->likes_count" :comments="$post->comments_count" :key="$post->id" />
            @empty
                <div class="mx-auto w-70 mt-12">
                    <img src="{{ asset('img/no-results.png') }}" alt="Sin resultados" class="mx-auto"/>
                    <div class="text-gray text-center font-bold mt-6">No se encontró ningún post con los parámetros indicados.</div>
                </div>
            @endforelse
        </div> <!-- end posts-container -->

        <div class="my-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
</div>