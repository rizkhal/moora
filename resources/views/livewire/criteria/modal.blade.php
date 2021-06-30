<div x-data="{ open: @entangle('deleteModal') }">
    <x-modal>
        <x-slot name="body">
            <h2 class="text-2xl font-bold mb-2">Yakin ingin menghapus?</h2>
            <p>Data kriteria akan dihapus secara permanen.</p>
        </x-slot>
        <x-slot name="button">
            <button @click="open = false"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                Tutup
            </button>
            <button wire:click.prevent="deleteCriteria"
                class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-800 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                Hapus
            </button>
        </x-slot>
    </x-modal>
</div>
