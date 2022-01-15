<template>
  <div class="p-5 text-center">
    <div class="rounded-full bg-red-200 flex items-center justify-center w-24 h-24 flex-shrink-0 mx-auto">
      <TrashIcon class="w-16 h-16 text-red-500" />
    </div>
    <div class="text-3xl mt-5">Are you sure?</div>
    <div class="text-gray-600 mt-2 leading-7">Do you really want to delete these records? This process cannot be undone.</div>
  </div>
  <div class="flex justify-center space-x-2 mt-4">
    <button type="button" class="btn-close" @click="$refs.modalDelete.closeModal()">Close</button>
    <button type="button" class="btn-indigo" @click="destroy(unit)">Delete</button>
  </div>
</template>