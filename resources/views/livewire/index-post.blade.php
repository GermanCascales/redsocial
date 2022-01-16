<div class="post-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex">
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
        <div class="text-center">
            <div class="font-semibold text-2xl @if($likedPost) text-blue @endif">{{ $post->likes_count }}</div>
            <div class="text-gray-500">me gusta</div>
        </div>

        <div class="mt-8">
            <button class="border @if($likedPost) text-white bg-blue border-blue hover:bg-blue-hover @else bg-gray-200 border-gray-200 hover:border-gray-400 @endif font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
            </button>
        </div>
    </div>
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
            <h4 class="text-xl font-semibold mt-2 md:mt-0">
                <a href="{{ route('posts.show', $post) }}" class="hover:underline">{{ $post->title }}</a>
            </h4>
            <div class="text-gray-600 mt-3 line-clamp-3">
                {{ $post->description }}
            </div>

            <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div>{{ $post->created_at->diffForHumans() }}</div>
                    <div>&bull;</div>
                    <div>{{ $post->category->name }}</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">3 comentarios</div>
                </div>
                <div x-data="{ isOpen: false }" class="flex items-center space-x-2 mt-4 md:mt-0">
                    <div class="{{ $post->type->style ? $post->type->style : 'bg-gray-200' }} text-xxs font-bold uppercase leading-none rounded-full text-center h-7 py-2 px-4">{{ $post->type->name }}</div>
                    <button @click="isOpen = !isOpen" class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                        <svg fill="currentColor" width="24" height="6">
                            <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                        </svg>
                        <ul x-cloak x-show="isOpen" x-transition.origin.top.left @click.away="isOpen = false" @keydown.escape.window="isOpen = false" class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0">
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Marcar como inapropiado</a></li>
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Eliminar post</a></li>
                        </ul>
                    </button>
                </div>

                <div class="flex items-center md:hidden mt-4 md:mt-0">
                    <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                        <div class="text-sm font-bold leading-none @if($likedPost) text-blue @endif">{{ $post->likes_count }}</div>
                        <div class="text-xxs font-semibold leading-none text-gray-400">me gusta</div>
                    </div>
                    <button class="border @if($likedPost) text-white bg-blue border-blue hover:bg-blue-hover @else bg-gray-200 border-gray-200 hover:border-gray-400 @endif font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-3 py-2 -mx-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end post-container -->