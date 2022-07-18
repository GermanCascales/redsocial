<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationCount extends Component {
    public $count;

    protected $listeners = ['updateNotificationCount' => 'setCount'];

    public function mount() {
        $this->setCount();
    }

    public function setCount() {
        $this->count = auth()->user()->unreadNotifications()->count();
    }

    public function render() {
        return <<<'blade'
            @if ($count > 0)
                <div class="absolute rounded-full bg-red text-white text-xs w-5 h-5 flex justify-center items-center border-2 border-gray-background -top-2 -right-2">
                    {{ $count > 99 ? '∞' : $count }}
                </div>
            @else
                <div></div>
            @endif
        blade;
    }
}
