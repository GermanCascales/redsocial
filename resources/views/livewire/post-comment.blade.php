<div id="comment-{{ $comment->id }}" class="comment-container relative bg-white rounded-xl @if($comment->user_id === auth()->id()) border border-blue @endif flex mt-4 transition duration-500 ease-in">
    <div class="flex flex-col md:flex-row flex-1 px-5 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                <img src="{{ $comment->user->profile_photo_url }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
            <div class="text-gray-600 mt-1">
                {{ $comment->message }}
            </div>

            <div class="flex md:items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="font-bold @if($comment->user_id === auth()->id()) text-blue @else text-gray-900 @endif">{{ $comment->user->name }}</div>
                    <div>&bull;</div>
                    <div>{{ $comment->created_at->diffForHumans() }}</div>
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
                    <div class="relative">
                        <button @click="isCommentOptionsOpen = !isCommentOptionsOpen" class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3 ml-8">
                            <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                        </button>
                        <ul
                            class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                            x-cloak
                            x-show="isCommentOptionsOpen"
                            x-transition.origin.top.left
                            @click.away="isCommentOptionsOpen = false"
                            @keydown.escape.window="isCommentOptionsOpen = false"
                        >
                            @can('update', $comment)
                                <li><a href="#" @click.prevent="isOptionsOpen = false; Livewire.emit('setCommentToEdit', {{ $comment->id }})" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Editar comentario</a></li>
                            @endcan
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Marcar como inapropiado</a></li>
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Eliminar comentario</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>