<div
    x-data="{ isCommentsOpen: false, isLightboxOpen: false, imageUrl: '', imageText: '', commentId: null,
              shareData: {title: '{{ config('app.name', 'Laravel') }}', text: '{{ $post->title }}', url: '{{ url()->current() }}'} }"
    x-init="Livewire.on('commentCreated', (newComment) => {
                isCommentsOpen = false;
                commentId = newComment;
            });
            Livewire.hook('message.processed', (message, component) => {
                if (['gotoPage', 'previousPage', 'nextPage'].includes(message.updateQueue[0].method)) {
                    document.querySelector('.comment-container:first-child').scrollIntoView({ behavior: 'smooth', block: 'center' })
                }
                if (message.updateQueue[0].payload.event === 'commentCreated' && message.component.fingerprint.name === 'post-comments') {
                    const newComment = document.querySelector('#comment-' + commentId);
                    newComment.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    newComment.classList.replace('bg-white', 'bg-green-50');
                    newComment.classList.replace('border-blue', 'border-green');
                    setTimeout(() => {
                        newComment.classList.replace('bg-green-50', 'bg-white')
                        newComment.classList.replace('border-green', 'border-blue');
                    }, 3500);
                }
            });
            
            @if (session('scrollComment'))
                const commentToScroll = document.querySelector('#comment-{{ session('scrollComment') }}');
                commentToScroll.scrollIntoView({ behavior: 'smooth', block: 'center' });
                commentToScroll.classList.replace('bg-white', 'bg-green-50');
                commentToScroll.classList.replace('border-blue', 'border-green');
                setTimeout(() => {
                    commentToScroll.classList.replace('bg-green-50', 'bg-white')
                    commentToScroll.classList.replace('border-green', 'border-blue');
                }, 3500);
            @endif">
    <div class="post-container relative border @if ($post->signature) border-green @endif bg-white dark:bg-slate-800 rounded-xl flex mt-4">
        @if ($post->signature)
        <div class="absolute rounded-full bg-green text-white text-xs w-5 h-5 flex justify-center items-center -top-2 -right-2" title="Firmado">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        @else
        <div class="absolute rounded-full bg-yellow text-white text-xs w-5 h-5 flex justify-center items-center -top-2 -right-2" title="Sin firmar">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M 12 6 L 12 13 M 12 17 L 12.01 17.5" />
            </svg>
        </div>
        @endif
        <div class="flex flex-col md:flex-row flex-1 px-5 py-6">
            <div class="flex-none mx-2 md:mx-0">
                <a href="#">
                    <img src="{{ $post->user->profile_photo_url }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            <div class="w-full md:min-w-75vh flex flex-col justify-between mx-2 md:mx-4">
                <h4 class="text-xl font-semibold mt-2 md:mt-0">
                    {{ $post->title }}
                </h4>
                <div class="text-gray-600 dark:text-slate-400 mt-3">
                    {!! $post->description !!}
                </div>
                <div class="mt-2 space-y-2">
                    @foreach($post->uploads as $upload)
                        @if (Str::startsWith($upload->mimeType(), 'image'))
                            <div @click="imageUrl = '{{ Storage::url($upload->file) }}'; imageText = '{{ $upload->name }}'; isLightboxOpen = true"
                                class="p-1 bg-white cursor-pointer border rounded max-w-sm"
                                title="Pulsa para ver imagen a tamaño completo">
                                <img src="{{ Storage::url($upload->file) }}" alt="{{ $upload->file }}">
                            </div>
                        @else
                            <a href="{{ Storage::url($upload->file) }}"
                               class="flex items-center justify-center max-w-sm py-1 text-sm font-semibold rounded-xl border border-blue hover:bg-blue-hover hover:text-white transition duration-150 ease-in"
                               title="Pulsa para descargar archivo"
                               target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M15.621 4.379a3 3 0 00-4.242 0l-7 7a3 3 0 004.241 4.243h.001l.497-.5a.75.75 0 011.064 1.057l-.498.501-.002.002a4.5 4.5 0 01-6.364-6.364l7-7a4.5 4.5 0 016.368 6.36l-3.455 3.553A2.625 2.625 0 119.52 9.52l3.45-3.451a.75.75 0 111.061 1.06l-3.45 3.451a1.125 1.125 0 001.587 1.595l3.454-3.553a3 3 0 000-4.242z" clip-rule="evenodd" />
                                </svg>
                                <div class="w-5/6 ml-2">{{ $upload->name }}</div>
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                        @if (count($post->uploads) > 0)
                            <div title="Contiene archivos adjuntos">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                </svg>
                            </div>
                        @endif
                        <div class="font-bold text-gray-900 dark:text-white">{{ $post->user->name }}</div>
                        <div>&bull;</div>
                        <div>{{ $post->created_at->diffForHumans() }}</div>
                        <div>&bull;</div>
                        <div>{{ $post->category->name }}</div>
                        <div>&bull;</div>
                        <div class="text-gray-900 dark:text-white">{{ $post->comments->count() }} {{ Str::plural('comentario', $post->comments->count()) }}</div>
                    </div>
                    <div x-data="{ isOptionsOpen: false }" class="flex items-center space-x-2 mt-4 md:mt-0">
                        <div class="{{ $post->type->style ? $post->type->style : 'bg-gray-200' }} text-xxs font-bold uppercase leading-none rounded-full text-center h-7 py-2 px-4">{{ $post->type->name }}</div>
                        <div class="relative">
                            <button @click="isOptionsOpen = !isOptionsOpen" class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 transition duration-150 ease-in py-2 px-3">
                                <svg fill="currentColor" width="24" height="6">
                                    <path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>
                            </button>
                            <ul x-cloak x-show="isOptionsOpen" x-transition.origin.top.left @click.away="isOptionsOpen = false" @keydown.escape.window="isOptionsOpen = false" class="absolute w-44 text-left font-semibold bg-white shadow-dialog rounded-xl z-10 py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0">
                                <li><a href="#" @click.prevent="await navigator.share(shareData)" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Compartir post</a></li>
                                @can('update', $post)
                                    <li><a href="#" @click.prevent="isOptionsOpen = false; $dispatch('custom-show-edit')" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Editar post</a></li>
                                @endcan
                                @can('report', $post)
                                    <li><a href="#" @click.prevent="isOptionsOpen = false; $dispatch('custom-show-report')" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Marcar como inapropiado</a></li>
                                @endcan
                                @can('delete', $post)
                                    <li><a href="#" @click.prevent="isOptionsOpen = false; $dispatch('custom-show-delete')" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Eliminar post</a></li>
                                @endcan
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end post-container -->

    <div class="buttons-container flex items-center justify-between mt-4 md:mt-6 px-3 md:px-0">
        <div class="flex flex-col md:flex-row items-center space-x-4">
            <button @click="isCommentsOpen = !isCommentsOpen; if (isCommentsOpen) { $nextTick(() => $refs.comment.focus()) }" class="flex items-center justify-center h-11 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <span class="ml-1">Comentar</span>
            </button>
        </div>

        <div class="flex items-center space-x-3">
            <div class="bg-white dark:bg-slate-800 font-semibold text-center rounded-xl px-3 py-2">
                <div class="text-xl leading-snug @if($likedPost) text-blue dark:text-blue-400 @endif">{{ $likes }}</div>
                <div class="text-gray-400 text-xs leading-none">me gusta</div>
            </div>
            <button type="button" wire:click="like_button" class="text-xs @if($likedPost) text-white bg-blue border-blue hover:bg-blue-hover @else bg-gray-200 dark:bg-slate-600 border-gray-200 dark:border-slate-600 hover:border-gray-400 dark:hover:border-slate-800 @endif font-semibold uppercase rounded-xl border transition duration-150 ease-in p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
            </button>
        </div>
    </div>

    <div x-cloak x-show="isCommentsOpen" x-transition.origin.top class="font-semibold text-sm bg-white dark:bg-slate-800 shadow-sm rounded-xl mt-6">
        <form wire:submit.prevent="create_comment" action="#" class="space-y-4 px-4 py-6">
            <div>
                <textarea x-ref="comment" wire:model.defer="comment" name="post_comment" id="post_comment" cols="30" rows="4" class="w-full text-sm bg-gray-100 dark:bg-slate-600 rounded-xl placeholder-gray-900 dark:placeholder-slate-100 @error('comment') border-red @else border-none @enderror px-4 py-2" placeholder="Escribe un comentario..."></textarea>
                @error('comment')
                    <p class="text-red text-xs my-1 px-1">{{ $message }} </p>
                @enderror
            </div>

            <div class="flex flex-col md:flex-row items-center md:space-x-3">
                <button type="button" class="flex items-center justify-center w-full md:w-1/2 h-11 text-sm bg-gray-200 dark:bg-slate-700 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600 dark:text-white w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    <span class="ml-1">Adjuntar archivo</span>
                </button>
                <button type="submit" class="flex items-center justify-center w-full md:w-1/2 h-11 text-sm bg-blue text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3 mt-2 md:mt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="ml-1">Publicar</span>
                </button>
            </div>
        </form>
    </div>

    <div x-cloak
        x-show="isLightboxOpen"
        x-transition.opacity.duration.400ms
        @keydown.escape.window="isLightboxOpen = false"
        class="fixed top-0 left-0 z-20 w-screen h-screen bg-black/70 flex justify-center items-center">
        <a @click="isLightboxOpen = false" class="fixed z-30 top-6 right-8 cursor-pointer text-white text-5xl font-bold">&times;</a>
        <div @click.away="isLightboxOpen = false" class="flex flex-col items-center">
            <img :src="imageUrl" class="max-w-[800px] max-h-[600px] object-cover" />
            <div class="flex justify-center rounded-xl border border-white bg-black text-white font-semibold py-1 px-2 mt-2" x-text="imageText"></div>
        </div>
    </div>
</div>