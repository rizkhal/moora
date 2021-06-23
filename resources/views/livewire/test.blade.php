<div>
    <button wire:click.prevent="openModal">open modal</button>
    <div x-data="{open: @entangle('open')}">
        <x-modal>
            <x-slot name="body">
                hello world
            </x-slot>
            <x-slot name="button">
                button
            </x-slot>
        </x-modal>
    </div>
</div>
