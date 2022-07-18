<x-app-layout>
    <div>
        <div class="px-3 md:px-0">
            <a href="/posts" class="flex items-center font-semibold hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="ml-1">Posts</span>
            </a>
        </div>

        <x-alert/>

        <livewire:show-post :post="$post"/>

        @push('modals')
            @can('update', $post)
                <livewire:edit-post :post="$post"/>
            @endcan
            
            @can('delete', $post)
                <livewire:delete-post :post="$post"/>
            @endcan

            <livewire:report-post :post="$post"/>
        @endpush

        <livewire:post-comments :post="$post"/>
    </div>
</x-app-layout>