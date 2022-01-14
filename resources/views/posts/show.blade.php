<x-app-layout>
    <div x-data="{ isCommentsOpen: false }">
        <div class="px-3 md:px-0">
            <a href="/posts" class="flex items-center font-semibold hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="ml-1">Posts</span>
            </a>
        </div>

        <div class="post-container bg-white rounded-xl flex mt-4">
            <div class="flex flex-col md:flex-row flex-1 px-5 py-6">
                <div class="flex-none mx-2 md:mx-0">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full md:min-w-75vh flex flex-col justify-between mx-2 md:mx-4">
                    <h4 class="text-xl font-semibold mt-2 md:mt-0">
                        {{ $post->title }}
                    </h4>
                    <div class="text-gray-600 mt-3">
                        {{ $post->description }}
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                            <div class="font-bold text-gray-900">{{ $post->user->name }}</div>
                            <div>&bull;</div>
                            <div>{{ $post->created_at->diffForHumans() }}</div>
                            <div>&bull;</div>
                            <div>{{ $post->category->name }}</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 comentarios</div>
                        </div>
                        <div x-data="{ isOptionsOpen: false }" class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="{{ $post->type->style ? $post->type->style : 'bg-gray-200' }} text-xxs font-bold uppercase leading-none rounded-full text-center h-7 py-2 px-4">{{ $post->type->name }}</div>
                            <button @click="isOptionsOpen = !isOptionsOpen" class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                <svg fill="currentColor" width="24" height="6">
                                    <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>
                                <ul x-cloak x-show="isOptionsOpen" x-transition.origin.top.left @click.away="isOptionsOpen = false" @keydown.escape.window="isOptionsOpen = false" class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0">
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Marcar como inapropiado</a></li>
                                    <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Eliminar post</a></li>
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end post-container -->

        <div class="buttons-container flex items-center justify-between mt-4 md:mt-6 px-3 md:px-0">
            <div class="flex flex-col md:flex-row items-center space-x-4">
                <button @click="isCommentsOpen = !isCommentsOpen" class="flex items-center justify-center h-11 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <span class="ml-1">Comentar</span>
                </button>
            </div>

            <div class="flex items-center space-x-3">
                <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                    <div class="text-xl leading-snug @if($liked_post) text-blue @endif">{{ $likes }}</div>
                    <div class="text-gray-400 text-xs leading-none">me gusta</div>
                </div>
                <button type="button" class="text-xs @if($liked_post) text-white bg-blue border-blue hover:bg-blue-hover @else bg-gray-200 border-gray-200 hover:border-gray-400 @endif font-semibold uppercase rounded-xl border transition duration-150 ease-in p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-cloak x-show="isCommentsOpen" x-transition.origin.top class="font-semibold text-sm bg-white shadow-sm rounded-xl mt-6">
            <form action="#" class="space-y-4 px-4 py-6">
                <div>
                    <textarea name="post_comment" id="post_comment" cols="30" rows="4" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Escribe un comentario..."></textarea>
                </div>

                <div class="flex flex-col md:flex-row items-center md:space-x-3">
                    <button type="button" class="flex items-center justify-center w-full md:w-1/2 h-11 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <span class="ml-1">Adjuntar archivo</span>
                    </button>
                    <button type="button" class="flex items-center justify-center w-full md:w-1/2 h-11 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 mt-2 md:mt-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span class="ml-1">Publicar</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="comments-container relative space-y-6 md:ml-20 mt-4 md:my-6">
            <div class="comment-container relative bg-white rounded-xl flex mt-4">
                <div class="flex flex-col md:flex-row flex-1 px-5 py-6">
                    <div class="flex-none mx-2 md:mx-0">
                        <a href="#">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                        </a>
                    </div>
                    <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
                        <div class="text-gray-600 mt-3">
                            {{ $post->description }}
                        </div>

                        <div class="flex md:items-center justify-between mt-6">
                            <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                                <div class="font-bold text-gray-900">{{ $post->user->name }}</div>
                                <div>&bull;</div>
                                <div>{{ $post->created_at->diffForHumans() }}</div>
                            </div>

                            <div x-data="{ isCommentOptionsOpen: false }" class="flex items-center mt-4 md:mt-0">
                                <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-3 md:py-2 pr-8">
                                    <div class="text-sm font-bold leading-none">12</div>
                                    <div class="hidden md:block text-xxs font-semibold leading-none text-gray-400">me gusta</div>
                                </div>
                                <button class="bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-3 py-2 -mx-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                </button>
                                <button @click="isCommentOptionsOpen = !isCommentOptionsOpen" class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3 ml-8">
                                    <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                                    <ul
                                        class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                                        x-cloak
                                        x-show.transition.origin.top.left="isCommentOptionsOpen"
                                        @click.away="isCommentOptionsOpen = false"
                                        @keydown.escape.window="isCommentOptionsOpen = false"
                                    >
                                        <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Marcar como inapropiado</a></li>
                                        <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Eliminar comentario</a></li>
                                    </ul>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end comment-container -->
            <div class="comment-container relative bg-white rounded-xl flex mt-4">
                <div class="flex flex-col md:flex-row flex-1 px-5 py-6">
                    <div class="flex-none mx-2 md:mx-0">
                        <a href="#">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                        </a>
                    </div>
                    <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
                        <div class="text-gray-600 mt-3">
                            {{ $post->description }}
                        </div>

                        <div class="flex md:items-center justify-between mt-6">
                            <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                                <div class="font-bold text-gray-900">{{ $post->user->name }}</div>
                                <div>&bull;</div>
                                <div>{{ $post->created_at->diffForHumans() }}</div>
                            </div>

                            <div x-data="{ isCommentOptionsOpen: false }" class="flex items-center mt-4 md:mt-0">
                                <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-3 md:py-2 pr-8">
                                    <div class="text-sm font-bold leading-none">12</div>
                                    <div class="hidden md:block text-xxs font-semibold leading-none text-gray-400">me gusta</div>
                                </div>
                                <button class="bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-3 py-2 -mx-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                    </svg>
                                </button>
                                <button @click="isCommentOptionsOpen = !isCommentOptionsOpen" class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3 ml-8">
                                    <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                                    <ul
                                        class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                                        x-cloak
                                        x-show.transition.origin.top.left="isCommentOptionsOpen"
                                        @click.away="isCommentOptionsOpen = false"
                                        @keydown.escape.window="isCommentOptionsOpen = false"
                                    >
                                        <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Marcar como inapropiado</a></li>
                                        <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Eliminar comentario</a></li>
                                    </ul>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end comment-container -->
        </div>
    </div>
</x-app-layout>