<template>
  <app-head title="Penilaian" />

  <div class="flex items-center mb-4">
    <h2 class="text-2xl font-semibold">Penilaian Peserta</h2>
  </div>
  <div class="shadow overflow-auto border border-gray-200 sm:rounded-lg">
    <h1 class="text-lg font-bold py-2 px-4">Normalisasi Data</h1>
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50 border-t">
        <tr>
          <th scope="col" class="table-heading-cell">Nama Peserta</th>
          <th v-for="(criteria, index) in data.criteria" :key="index" scope="col" class="table-heading-cell">
            <div class="flex items-center">
              {{ criteria.name }}
            </div>
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(user, userIndex) in data.user" :key="userIndex">
          <td class="text-left pl-6 py-8 bg-white text-gray-400">
            {{ user.name }}
          </td>
          <td v-for="(normalized, normalizedIndex) in data.normalized" :key="normalizedIndex" class="text-left pl-6 py-8 bg-white text-gray-400">
            {{ normalized }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: {
    data: Object,
  },
  data() {
    return {
      //
    };
  },
  methods: {
    //
  },
};
</script>