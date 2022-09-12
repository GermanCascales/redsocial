<div class="post-container relative border @if ($post->signature) border-green @endif hover:shadow-card transition duration-150 ease-in bg-white dark:bg-slate-800 rounded-xl flex pr-5 md:p-0">
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
    <div class="hidden md:block border-r border-gray-100 dark:border-zinc-700 px-5 py-8">
        <div class="text-center">
            <div class="font-semibold text-2xl dark:text-white @if($likedPost) text-blue @endif">{{ $likes }}</div>
            <div class="text-gray-500 dark:text-slate-400">me gusta</div>
        </div>
        <div class="mt-8">
            <button wire:click="like_button" class="border @if($likedPost) text-white bg-blue border-blue hover:bg-blue-hover @else bg-gray-200 dark:bg-slate-600 border-gray-200 dark:border-slate-600 hover:border-gray-400 dark:hover:border-slate-800 @endif font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
            </button>
        </div>
    </div>
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                <img src="{{ $post->user->profile_photo_url }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>
        <div class="w-full flex flex-col justify-between mx-2 md:mx-4">
            <h4 class="text-xl dark:text-white font-semibold mt-2 md:mt-0">
                <a href="{{ route('posts.show', $post) }}" class="hover:underline">{{ $post->title }}</a>
            </h4>
            <div class="text-gray-600 dark:text-slate-400 mt-3 line-clamp-3">
                {!! trim(strip_tags(htmlspecialchars_decode($post->description))) !!}
            </div>

            <div class="photoThumbs mt-2">
                @php
                    $shownPhotos = 0;    
                @endphp
                @foreach($post->uploads as $upload)
                    @if (Str::startsWith($upload->mimeType(), 'image') && $shownPhotos < 5)
                        @php
                            $shownPhotos++;
                        @endphp
                        <div>
                            <a href="{{ route('posts.show', $post) }}">
                                <img class="inline-flex" src="{{ Storage::url($upload->file) }}" alt="{{ $upload->file }}">
                            </a>
                        </div>
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
                    <div>{{ $post->created_at->diffForHumans() }}</div>
                    <div>&bull;</div>
                    <div>{{ $post->category->name }}</div>
                    <div>&bull;</div>
                    <div class="text-gray-900 dark:text-white">{{ $comments }} {{ Str::plural('comentario', $comments) }}</div>
                </div>
                <div class="flex items-center space-x-2 mt-4 md:mt-0">
                    <div class="flex items-center w-2/3 md:hidden mr-5 md:mt-0">
                        <div class="bg-gray-100 text-center rounded-xl h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none @if($likedPost) text-blue @endif">{{ $likes }}</div>
                            <div class="text-xxs font-semibold leading-none text-gray-400">me gusta</div>
                        </div>
                        <button wire:click="like_button" class="border @if($likedPost) text-white bg-blue border-blue hover:bg-blue-hover @else bg-gray-200 border-gray-200 hover:border-gray-400 @endif font-bold text-xxs uppercase rounded-xl hover:border-gray-400 transition duration-150 ease-in px-3 py-2 -mx-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="{{ $post->type->style ? $post->type->style : 'bg-gray-200' }} text-xxs font-bold uppercase leading-none rounded-full text-center h-7 py-2 px-4">{{ $post->type->name }}</div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end post-container -->