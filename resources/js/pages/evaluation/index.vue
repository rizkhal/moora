<template>
  <app-head title="Penilaian" />

  <div class="flex items-center mb-4">
    <h2 class="text-2xl font-semibold">Penilaian Peserta</h2>
  </div>

  <div class="flex flex-col space-y-6">
    <datatable title="Data Ternormalisasi" :users="data.users" :criteria="data.criteria" :result="data.normalized" />
    <datatable title="Data Terbobot" :users="data.users" :criteria="data.criteria" :result="data.optimized" />

    <div class="shadow overflow-auto border border-gray-200 sm:rounded-lg">
      <h1 class="text-lg font-bold py-2 px-4">Hasil Akhir</h1>
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 border-t">
          <tr>
            <th scope="col" class="table-heading-cell">Nama</th>
            <th scope="col" class="table-heading-cell">Nilai Max</th>
            <th scope="col" class="table-heading-cell">Nilai Min</th>
            <th scope="col" class="table-heading-cell">Nilai Yi</th>
            <th scope="col" class="table-heading-cell">Ranking</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(user, index) in data.users" :key="index">
            <td class="table-body-cell text-xs">{{ user.name }}</td>
            <td class="table-body-cell text-xs">{{ data.result.max[user.id] }}</td>
            <td class="table-body-cell text-xs">{{ data.result.min[user.id] }}</td>
            <td class="table-body-cell text-xs">{{ data.result.yi[user.id] }}</td>
            <td class="table-body-cell text-xs">{{ data.result.rank[user.id] }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import datatable from "./table.vue";

export default {
  components: {
    datatable,
  },
  props: {
    data: Object,
  },
};
</script>