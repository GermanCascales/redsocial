<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationBar extends Component {
    protected $listeners = ['notificationBarBtn'];

    public function notificationBarBtn() {
        $this->emit('notificationBarOpen');
    }

    public function render() {
        return view('livewire.notification-bar', ['notifications' => auth()->user()->notifications]);
    }
}
