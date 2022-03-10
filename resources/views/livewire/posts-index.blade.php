<div class="flex">
<div class="w-70 mx-auto md:mx-0 md:mr-5">
    <div class="bg-white md:sticky md:top-8 border-2 border-blue rounded-xl md:mt-16" style="
                            border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            border-image-slice: 1;
                            background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                            background-origin: border-box;
                            background-clip: content-box, border-box;">
        <div class="text-center px-6 py-2 pt-6">
            <h3 class="font-semibold text-base">Crea un post</h3>
            <p class="text-xs mt-4">Escribe tu pregunta o lo que piensas</p>
        </div>

        <livewire:create-post :categories="$categories" :post_types="$post_types" />
    </div>
</div>

<div class="w-full px-2 md:px-0 md:w-175">
    <livewire:categories-links />

    <div class="mt-8">
        <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
            <div class="w-full md:w-1/3">
                <select name="category" id="category" class="w-full rounded-xl border-none px-4 py-2">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
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
            <livewire:index-post :post="$post" :likes="$post->likes_count" :key="$post->id" />
            @endforeach
        </div> <!-- end posts-container -->

        <div class="my-8">
            {{ $posts->links() }}
        </div>
    </div>
</div>
</div>