@props([
    'fromRedirect' => false,
    'alertMessage' => '',
])

<div
    x-cloak
    x-data="{   isVisible: false,
                alertMessage: '{{ $alertMessage }}',
                displayAlert(message) {
                    this.alertMessage = message
                    this.isVisible = true
                    setTimeout(() => {
                        this.isVisible = false
                    }, 3500)
                }
            }"
    x-init="@if ($fromRedirect)
                $nextTick(() => displayAlert(alertMessage))
            @else
                Livewire.on('alertOkVisible', (message) => {
                    displayAlert(message)
                })
            @endif"
    x-show="isVisible"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-x-10"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-10"
    class="flex justify-between max-w-sm w-full fixed top-0 right-0 bg-white rounded-xl shadow-lg border z-10 px-5 py-4 mx-3 md:mx-6 my-4 md:my-16">

    <div class="flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div class="font-semibold text-gray-500 ml-2" x-text="alertMessage"></div>
    </div>
    <button @click="isVisible = false" class="text-gray-400 hover:text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>