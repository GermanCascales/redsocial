<x-app-layout>
    <div class="w-70 mx-auto md:mx-0 md:mr-5">
    <div
                    class="bg-white md:sticky md:top-8 border-2 border-blue rounded-xl md:mt-16"
                    style="
                          border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            border-image-slice: 1;
                            background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            background-origin: border-box;
                            background-clip: content-box, border-box;
                    "
                >
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="font-semibold text-base">Crea un post</h3>
                        <p class="text-xs mt-4">Escribe tu pregunta o lo que piensas</p>
                    </div>

                    <form action="#" method="POST" class="space-y-4 px-4 py-6">
                        <div>
                            <input type="text" name="title" class="w-full text-sm bg-gray-100 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Título">
                        </div>
                        <div>
                            <select name="category_add" id="category_add" class="w-full bg-gray-100 text-sm rounded-xl border-none px-4 py-2">
                                <option value="Categoría 1">Categoría 1</option>
                                <option value="Categoría 2">Categoría 2</option>
                                <option value="Categoría 3">Categoría 3</option>
                                <option value="Categoría 4">Categoría 4</option>
                            </select>
                        </div>
                        <div>
                            <textarea name="description" id="description" cols="30" rows="4" class="w-full bg-gray-100 rounded-xl border-none placeholder-gray-900 text-sm px-4 py-2" placeholder="Descripción"></textarea>
                        </div>
                        <div class="flex items-center justify-between space-x-3">
                            <button
                                type="button"
                                class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                            >
                                <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="ml-1">Adjuntar archivo</span>
                            </button>
                            <button
                                type="submit"
                                class="flex items-center justify-center w-1/2 h-11 text-xs bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span class="ml-1">Publicar</span>
                            </button>
                        </div>
                    </form>
                </div>
    </div>

    <div class="w-full px-2 md:px-0 md:w-175">
        <nav class="hidden md:flex items-center justify-between text-xs">
            <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                <li><a href="#" class="border-b-4 pb-3 border-blue">Todas</a></li>
                <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Categoría 1</a></li>
                <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Categoría 2</a></li>
            </ul>

            <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Categoría 3</a></li>
                <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Categoría 4</a></li>
            </ul>
        </nav>

        <div class="mt-8">
            <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
                <div class="w-full md:w-1/3">
                    <select name="category" id="category" class="w-full rounded-xl border-none px-4 py-2">
                        <option value="Category One">Category One</option>
                        <option value="Category Two">Category Two</option>
                        <option value="Category Three">Category Three</option>
                        <option value="Category Four">Category Four</option>
                    </select>
                </div>
                <div class="w-full md:w-1/3">
                    <select name="other_filters" id="other_filters" class="w-full rounded-xl border-none px-4 py-2">
                        <option value="Filter One">Filter One</option>
                        <option value="Filter Two">Filter Two</option>
                        <option value="Filter Three">Filter Three</option>
                        <option value="Filter Four">Filter Four</option>
                    </select>
                </div>
                <div class="w-full md:w-2/3 relative">
                    <input type="search" placeholder="buscar..." class="w-full rounded-xl bg-white border-none placeholder-gray-900 px-4 py-2 pl-8">
                    <div class="absolute top-0 flex itmes-center h-full ml-2">
                        <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div> <!-- end filters -->

            <div class="posts-container space-y-6 my-8">
                @foreach ($posts as $post)
                <div class="post-container hover:shadow-card transition duration-150 ease-in bg-white rounded-xl flex">
                    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
                        <div class="text-center">
                            <div class="font-semibold text-2xl">12</div>
                            <div class="text-gray-500">me gusta</div>
                        </div>

                        <div class="mt-8">
                            <button class="bg-gray-200 border border-gray-200 hover:border-gray-400 font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">
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
                                    <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Consulta</div>
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
                                        <div class="text-sm font-bold leading-none">12</div>
                                        <div class="text-xxs font-semibold leading-none text-gray-400">me gusta</div>
                                    </div>
                                    <button class="bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-3 py-2 -mx-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end post-container -->
                @endforeach
            </div> <!-- end posts-container -->

            <div class="my-8">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>