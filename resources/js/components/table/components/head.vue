<template>
  <thead class="bg-gray-50 border-t">
    <tr>
      <th class="table-heading-cell" v-if="number">NO</th>
      <th v-for="(column, heading) in columns" :key="heading" scope="col" class="table-heading-cell">
        <div class="flex items-center" v-if="heading !== 'checkbox'" @click="sort(formatText(column.field ? column.field : heading))" :class="[column.sorting ? 'cursor-pointer' : 'cursor-default']">
          {{ heading.replace("_", " ") }}
          <ChevronUpIcon v-if="filters && column.sorting && params.direction === 'asc' && params.field === formatText(column.field ? column.field : heading)" class="w-4 h-4 ml-2" />
          <ChevronDownIcon v-if="filters && column.sorting && params.direction === 'desc' && params.field === formatText(column.field ? column.field : heading)" class="w-4 h-4 ml-2" />
        </div>
        <span v-if="heading === 'checkbox'">
          <input type="checkbox" name="all" id="all" />
        </span>
      </th>
    </tr>
  </thead>
</template>
<script>
export default {
  props: {
    //
  },
};
</script>