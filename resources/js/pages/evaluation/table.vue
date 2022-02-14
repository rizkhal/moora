<template>
  <div class="shadow overflow-auto border border-gray-200 sm:rounded-lg">
    <h1 class="text-lg font-bold py-2 px-4">
      {{ title }}
    </h1>
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50 border-t">
        <tr>
          <th scope="col" class="table-heading-cell">Nama</th>
          <th v-for="(criteria, index) in criteria" :key="index" scope="col" class="table-heading-cell">
            <div class="flex items-center">
              {{ criteria.name }}
            </div>
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="(user, index) in users" :key="index">
          <td class="table-body-cell text-xs">
            {{ user.name }}
          </td>
          <td v-for="(criteria, i) in criteria" :key="i" class="table-body-cell text-xs">
            {{ result[user.id][i] }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  props: {
    title: String,
    users: Object,
    criteria: Object,
    result: Object,
  },
};
</script>