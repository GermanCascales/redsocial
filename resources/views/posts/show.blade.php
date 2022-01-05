<x-app-layout>
    <div x-data="{ isOpen: false }" class="flex-col">
        <div>
            <a href="/posts" class="flex items-center font-semibold hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="ml-1">Posts</span>
            </a>
        </div>

        <div class="post-container bg-white rounded-xl flex mt-4">
            <div class="flex flex-1 px-5 py-6">
                <div class="flex-none mx-2 md:mx-0">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
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
                            <div>Categoría 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 comentarios</div>
                        </div>
                        <div x-data="{ isOpen: false }" class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Consulta</div>
                        </div>

                        <div class="flex items-center md:hidden mt-4 md:mt-0">
                            <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                                <div class="text-sm font-bold leading-none">12</div>
                                <div class="text-xxs font-semibold leading-none text-gray-400">me gusta</div>
                            </div>
                            <button class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5">
                                Me gusta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end post-container -->

        <div class="buttons-container flex items-center justify-between mt-6">
            <div class="flex items-center space-x-4">
                <button @click="isOpen = !isOpen" class="flex items-center justify-center h-11 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                    <span class="ml-1">Comentar</span>
                </button>
                <button type="button" class="flex items-center justify-center h-11 text-sm bg-yellow text-white font-semibold rounded-xl border border-yellow hover:bg-yellow-hover transition duration-150 ease-in px-6 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="ml-1">Marcar como inapropiado</span>
                </button>
                <button type="button" class="flex items-center justify-center h-11 text-sm bg-red text-white font-semibold rounded-xl border border-red hover:bg-red-hover transition duration-150 ease-in px-6 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span class="ml-1">Eliminar post</span>
                </button>
            </div>

            <div class="flex items-center space-x-3">
                <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                    <div class="text-xl leading-snug">12</div>
                    <div class="text-gray-400 text-xs leading-none">me gusta</div>
                </div>
                <button type="button" class="text-xs bg-gray-200 font-semibold uppercase rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-cloak x-show="isOpen" x-transition.origin.top class="font-semibold text-sm bg-white shadow-sm rounded-xl mt-6">
            <form action="#" class="space-y-4 px-4 py-6">
                <div>
                    <textarea name="post_comment" id="post_comment" cols="30" rows="4" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Escribe un comentario..."></textarea>
                </div>

                <div class="flex items-center space-x-3">
                    <button type="button" class="flex items-center justify-center w-1/2 h-11 text-sm bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg>
                        <span class="ml-1">Adjuntar archivo</span>
                    </button>
                    <button type="button" class="flex items-center justify-center h-11 w-1/2 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        <span class="ml-1">Publicar</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="comments-container relative space-y-6 ml-20 my-6">
            <div class="comment-container relative bg-white rounded-xl flex mt-4">
                <div class="flex flex-1 px-5 py-6">
                    <div class="flex-none mx-2 md:mx-0">
                        <a href="#">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                        </a>
                    </div>
                    <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
                        <div class="text-gray-600 mt-3">
                            {{ $post->description }}
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                            <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                                <div class="font-bold text-gray-900">{{ $post->user->name }}</div>
                                <div>&bull;</div>
                                <div>{{ $post->created_at->diffForHumans() }}</div>
                            </div>

                            <div class="flex items-center md:hidden mt-4 md:mt-0">
                                <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                                    <div class="text-sm font-bold leading-none">12</div>
                                    <div class="text-xxs font-semibold leading-none text-gray-400">me gusta</div>
                                </div>
                                <button class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5">
                                    Me gusta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end comment-container -->
            <div class="comment-container relative bg-white rounded-xl flex mt-4">
                <div class="flex flex-1 px-5 py-6">
                    <div class="flex-none mx-2 md:mx-0">
                        <a href="#">
                            <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                        </a>
                    </div>
                    <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
                        <div class="text-gray-600 mt-3">
                            {{ $post->description }}
                        </div>

                        <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                            <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                                <div class="font-bold text-gray-900">{{ $post->user->name }}</div>
                                <div>&bull;</div>
                                <div>{{ $post->created_at->diffForHumans() }}</div>
                            </div>

                            <div class="flex items-center md:hidden mt-4 md:mt-0">
                                <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                                    <div class="text-sm font-bold leading-none">12</div>
                                    <div class="text-xxs font-semibold leading-none text-gray-400">me gusta</div>
                                </div>
                                <button class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-4 py-3 -mx-5">
                                    Me gusta
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end comment-container -->
        </div>
    </div>
</x-app-layout>