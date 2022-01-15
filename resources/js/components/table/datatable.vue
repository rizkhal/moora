<template>
  <div class="shadow overflow-auto border border-gray-200 sm:rounded-lg">
    <div class="flex items-center p-5 justify-between bg-white">
      <div></div>
      <div class="flex items-center space-x-2">
        <search />
        <Filter />
      </div>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50 border-t">
        <tr>
          <th class="table-heading-cell" v-if="number">NO</th>
          <th v-for="(column, heading) in columns" :key="heading" scope="col" class="table-heading-cell">
            <div class="flex items-center" v-if="heading !== 'checkbox'" @click="sort(formatField(column.field ? column.field : heading))" :class="[column.sorting ? 'cursor-pointer' : 'cursor-default']">
              {{ heading }}
              <ChevronUpIcon v-if="filters && column.sorting && params.direction === 'asc' && params.field === formatField(column.field ? column.field : heading)" class="w-4 h-4 ml-2" />
              <ChevronDownIcon v-if="filters && column.sorting && params.direction === 'desc' && params.field === formatField(column.field ? column.field : heading)" class="w-4 h-4 ml-2" />
            </div>
            <span v-if="heading === 'checkbox'">
              <input type="checkbox" name="all" id="all" />
            </span>
          </th>
        </tr>
      </thead>
      <tbody v-if="!data.data.length">
        <tr>
          <td :colspan="columnsLength()" class="text-center py-8 bg-white text-gray-400">
            <div class="flex flex-col justify-center items-center space-y-1">
              <icon name="InboxIcon" type="outline" class="w-8 h-8" />
              <span>Kosong</span>
            </div>
          </td>
        </tr>
      </tbody>
      <tbody v-else class="bg-white divide-y divide-gray-200">
        <tr v-for="(item, index) in data.data" :key="index" class="hover:bg-gray-50">
          <td class="table-body-cell text-xs" v-if="number">{{ ++index }}</td>
          <td v-for="(list, column) in columns" :key="column" class="table-body-cell text-xs" :class="{ 'w-10': column === 'checkbox' }">
            <div v-if="column !== 'checkbox'">
              <slot :name="column" :item="item" />

              <div v-if="!$slots[column]">
                {{ item[column] }}
              </div>
            </div>
            <div v-if="column === 'checkbox'">
              <input type="checkbox" />
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="pb-4 pl-4">
      <pagination class="mt-6" :links="data.links" />
    </div>
  </div>
</template>
<script>
import { throttle, pickBy } from 'lodash'
import icon from '@/components/icon.vue'
import search from '@/components/table/search.vue'
import Filter from '@/components/table/filter.vue'
import pagination from '@/components/table/pagination'
import { ChevronUpIcon, ChevronDownIcon } from '@heroicons/vue/solid'

export default {
  components: {
    icon,
    Filter,
    search,
    pagination,
    ChevronUpIcon,
    ChevronDownIcon,
  },
  props: {
    number: {
      type: Boolean,
      default: false,
    },
    data: Object,
    columns: Object,
    filters: {
      type: Object,
      required: false,
      default: () => null,
    },
  },
  data() {
    return {
      params: {
        search: this.filters?.search,
        field: this.filters?.field,
        direction: this.filters?.direction,
      },
    }
  },
  methods: {
    sort(field) {
      if (!this.filters) return

      this.params.field = field
      this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc'
    },
    formatField(heading) {
      return heading.toLowerCase().replace(' ', '_')
    },
    columnsLength() {
      return Object.keys(this.columns).length
    },
  },
  watch: {
    params: {
      handler: throttle(function () {
        let params = pickBy(this.params)

        this.$inertia.get(`${window.location.pathname}`, params, {
          replace: true,
          preserveState: true,
        })
      }, 150),
      deep: true,
    },
  },
}
</script>