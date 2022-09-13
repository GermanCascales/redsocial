<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class ShowUser extends Component {
    public User $user;

    public function followUser() {
        auth()->user()->follows()->attach($this->user->id);

        $this->emit('alertOkVisible', 'Has empezado a seguir a este usuario.');
    }

    public function unfollowUser() {
        auth()->user()->follows()->detach($this->user->id);

        $this->emit('alertOkVisible', 'Dejaste de seguir a este usuario.');
    }

    public function render() {
        return view('livewire.show-user', [
            'posts' => Post::where('user_id', '=', $this->user->id)
                            ->addSelect(['liked_by_user' => Like::select('id')
                                                                ->where('user_id', auth()->id())
                                                                ->whereColumn('post_id', 'posts.id')])
                            ->withCount('likes')
                            ->withCount('comments')
                            ->latest()
                            ->paginate(10)
        ]);
    }
}
