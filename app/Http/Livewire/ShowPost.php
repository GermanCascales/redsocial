<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Notifications\CommentPosted;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ShowPost extends Component {
    use AuthorizesRequests;

    public $post, $likedPost, $likes, $comment;

    protected $listeners = ['postUpdated' => '$refresh',
                            'commentCreated' => '$refresh',
                            'commentDeleted' => '$refresh'];
    protected $rules = ['comment' => 'required|min:3'];

    public function mount($post) {
        $this->likedPost = $post->user_liked(auth()->user());
        $this->likes = $post->likes()->count();
    }

    public function like_button() {
        if (!auth()->check()) {
            return redirect(route('login'));
        }

        if ($this->likedPost) {
            $this->post->delete_like(auth()->user());
            $this->likedPost = false;
            $this->likes--;
        } else {
            $this->post->create_like(auth()->user());
            $this->likedPost = true;
            $this->likes++;
        }
    }

    public function create_comment() {
        $this->validate();

        $newComment = Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
            'message' => $this->comment
        ]);

        $this->reset('comment');

        if ($newComment->user_id != $this->post->user_id) {
            $this->post->user->notify(new CommentPosted($newComment));
        }

        $this->emit('commentCreated', $newComment->id);
        $this->emit('alertOkVisible', 'El comentario fue publicado correctamente.');
    }

    public function pinPost() {
        $this->authorize('pin', $this->post);

        $this->post->update(['pinned' => !($this->post->pinned)]);

        if ($this->post->pinned) {
            $this->emit('alertOkVisible', 'El post fue fijado correctamente.');
        } else {
            $this->emit('alertOkVisible', 'El post fue desfijado correctamente.');
        }
    }

    public function render() {
        return view('livewire.show-post');
    }
}
