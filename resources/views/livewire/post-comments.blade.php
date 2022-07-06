<div>
    @if ($comments->isEmpty())
        <div class="mx-auto">
            <div class="text-gray text-center font-bold mt-6">Aún no hay comentarios, ¡publica el tuyo!</div>
        </div>
    @else
        <div class="comments-container relative space-y-6 md:ml-20 mt-4 md:my-6">
            @foreach ($comments as $comment)
                <livewire:post-comment :key="$comment->id" :comment="$comment"/> 
            @endforeach
        </div>
    @endif
</div>