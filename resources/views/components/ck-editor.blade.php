@props([
    'name' => '',
])

<div wire:ignore>
    <textarea x-init="ClassicEditor.create($refs.{{ $name }}, {
                        language: 'es',
                        mediaEmbed: {
                            previewsInData:true
                        },
                    })
                    .then(function(editor) {
                        editor.model.document.on('change:data', () => {
                            $dispatch('input', editor.getData())
                        })
                    })
                    .catch(error => {
                        console.error(error);
                    });"
        x-ref="{{ $name }}" wire:model.defer="{{ $name }}" class="dark:bg-slate-600" placeholder="Escribe aquí"></textarea>
    @push('scripts')
        <script src="{{ asset('js/ckeditor5-classic-34.2.0.js') }}"></script>
        <script src="{{ asset('js/ckeditor-es.js') }}"></script>
    @endpush
</div>