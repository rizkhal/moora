<template>
  <div class="shadow border border-gray-200 dark:border-cool-gray-700 sm:rounded-lg">
    <div class="p-4" v-if="title">
      <h2 class="text-xl font-bold text-gray-700 dark:text-cool-gray-300">{{ title }}</h2>
    </div>

    <div class="flex items-center p-5 bg-white dark:bg-cool-gray-600 border-t dark:border-cool-gray-700 border-dashed" :class="[$slots['attributes'] ? 'justify-between' : 'justify-end']">
      <div class="flex items-center space-x-2">
        <slot name="attributes" />
      </div>

      <div class="flex items-center space-x-2">
        <!-- search -->
        <search v-model="params.search" v-if="allowSearch" />

        <select-input v-model="params.perpage" v-if="allowPerPage">
          <option value="15">15</option>
          <option value="30">30</option>
          <option value="60">60</option>
        </select-input>

        <!-- filters -->
        <!-- <dropdown2 text="Filter" :pill="pill" icon="FilterIcon" v-if="allowFilter && Object.keys(fields).length">
          <div class="flex flex-col space-y-4 p-4">
            <template v-for="(field, key) in fields" :key="key">
              <div class="w-64">
                <v-multi-select @clear="handleClearSelect(key)" :label="fields[key].name" @select="handleSelectFilter($event, key)" v-model="filtersModels[key]" :url="fields[key].url" />
              </div>
            </template>
            <button class="btn-red w-full" type="button" @click.prevent="handleClearFilters">Bersihkan</button>
          </div>
        </dropdown2> -->
      </div>
    </div>

    <div class="overflow-auto border-b border-dashed dark:border-cool-gray-700">
      <div class="py-2 px-4 flex space-x-6 border-t border-dashed dark:border-cool-gray-700" v-if="params.column && params.direction">
        <div class="flex items-center space-x-2">
          <p class="text-sm dark:text-cool-gray-200">Penyortiran Diterapkan:</p>
          <span class="rounded-md text-sm text-white bg-red-500 flex items-center">
            <p class="py-1 px-2">{{ columnName }}: {{ params.direction === "asc" ? "A-Z" : "Z-A" }}</p>
            <button @click.prevent="handleClearSort" type="button" class="bg-red-600 mr-1 py-1 px-1 rounded-md">
              <icon name="XIcon" type="solid" class="w-3 h-3" />
            </button>
          </span>
        </div>
      </div>

      <table class="min-w-full divide-y divide-gray-200 dark:divide-cool-gray-500">
        <thead class="bg-gray-50 border-t dark:border-cool-gray-500">
          <tr>
            <th v-if="allowCheckbox" class="table-heading-cell">
              <input @click="handleSelectCheckboxCheckboxAll" v-model="selectAll" type="checkbox" class="form-checkbox form-input-checkbox" />
            </th>
            <template v-for="(column, index) in columns" :key="index">
              <th v-if="!column.blank" scope="col" class="table-heading-cell">
                <div class="flex items-center" @click="handleSort(column.column)" :class="[column.sortable ? 'cursor-pointer' : 'cursor-default']">
                  {{ column.text }}

                  <icon name="ChevronUpIcon" type="solid" v-if="filters && column.sortable && params.direction == 'asc' && params.column == column.column" class="w-4 h-4 ml-2" />
                  <icon name="ChevronDownIcon" type="solid" v-if="filters && column.sortable && params.direction == 'desc' && params.column == column.column" class="w-4 h-4 ml-2" />
                </div>
              </th>
            </template>
          </tr>
        </thead>
        <tbody v-if="data.data.length" class="bg-white divide-y divide-gray-200 dark:divide-cool-gray-700">
          <template v-if="!$slots['body']">
            <tr v-for="(item, index) in data.data" :key="index" class="hover:bg-gray-100 dark:text-cool-gray-100">
              <td v-if="allowCheckbox" class="table-body-cell">
                <input @change="handleSelectCheckbox" v-model="selected" :value="item[checkboxKey]" type="checkbox" class="form-checkbox form-input-checkbox" />
              </td>
              <template v-for="(column, columnIndex) in columns" :key="columnIndex">
                <td v-if="!column.blank" class="table-body-cell text-sm">
                  <slot :name="column.column" :item="item" />

                  <div v-if="!$slots[column.column]">
                    {{ item[column.column] }}
                  </div>
                </td>
              </template>
            </tr>
          </template>
          <template v-else>
            <slot name="body" :data="data" :columns="columns" />
          </template>
        </tbody>
        <tbody v-else>
          <tr>
            <td :colspan="columns.filter((c) => c.blank === false).length" class="text-center py-8 bg-white dark:bg-cool-gray-600 text-gray-400 dark:text-cool-gray-200">
              <div class="flex flex-col justify-center items-center space-y-1">
                <icon name="InboxIcon" type="outline" class="w-8 h-8" />
                <span>Kosong</span>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="flex items-center justify-between p-4">
      <div class="text-sm text-cool-gray-800 dark:text-cool-gray-200">
        Menampilkan <span class="font-bold">{{ data.from }}</span> ke <span class="font-bold">{{ data.to }}</span> dari <span class="font-bold">{{ data.total }}</span>
      </div>
      <pagination :links="data.links" />
    </div>
  </div>
</template>
<script>
import { throttle, pickBy } from "lodash";
import search from "./search.vue";
import tableFilter from "./filter.vue";
import pagination from "./pagination.vue";
import dropdown2 from '@/components/dropdown2.vue';

export default {
  components: {
    search,
    dropdown2,
    tableFilter,
    pagination,
  },
  props: {
    data: Object,
    title: String,
    columns: Object,
    allowPerPage: {
      type: Boolean,
      default: () => true,
    },
    allowSearch: {
      type: Boolean,
      default: () => true,
    },
    allowFilter: {
      type: Boolean,
      default: () => true,
    },
    allowCheckbox: {
      type: Boolean,
      default: false,
    },
    checkboxKey: {
      type: String,
      default: "id",
    },
    filters: {
      type: Object,
      required: false,
      default: () => null,
    },
    fields: {
      type: Object,
      required: false,
    },
  },
  async mounted() {
    if (this.filters.filters !== null) {
      let headers = {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },
      };

      let keys = Object.keys(this.filters.filters);

      let response = await Promise.all(keys.map((value) => fetch(`${this.$helper.domain}/${this.fields[value].url}/${this.filters.filters[value]}`, headers)))
        .then(function (responses) {
          return Promise.all(
            responses.map(function (response) {
              return response.json();
            }),
          );
        })
        .catch(function (error) {
          console.log(error);
        });

      keys.map((value, index) => {
        this.filtersModels[value] = {
          value: response[index][this.fields[value].attributes[0]],
          label: response[index][this.fields[value].attributes[1]],
        };
      });
    }
  },
  data() {
    return {
      selected: [],
      selectAll: false,
      params: {
        column: this.filters?.column,
        search: this.filters?.search,
        direction: this.filters?.direction,
        perpage: this.filters.perpage ?? 15,
        filters: this.filters.filters ? Object.keys(this.filters.filters).reduce((ac, a) => ({ ...ac, [a]: this.filters.filters[a] }), {}) : null,
      },
      filtersModels: this.fields ? Object.keys(this.fields).reduce((ac, a) => ({ ...ac, [a]: null }), {}) : null,
    };
  },
  computed: {
    columnName() {
      if (this.params.column) {
        return this.columns.filter((v) => v.column === this.params.column)[0].text;
      }
    },
    pill() {
      return this.filters.filters ? Object.keys(this.filters.filters).length : null;
    },
  },
  methods: {
    handleSort(column) {
      if (!this.filters) return;

      this.params.column = column;
      this.params.direction = this.params.direction === "asc" ? "desc" : "asc";
    },
    handleClearSort() {
      this.params.column = null;
      this.params.direction = null;
    },
    handleSelectFilter(event, key) {
      if (this.params.filters) {
        this.params.filters = Object.assign(this.params.filters, {
          [key]: event.value,
        });
      } else {
        this.params.filters = {
          [key]: event.value,
        };
      }
    },
    handleClearFilters() {
      if (this.params.filters) {
        Object.keys(this.params.filters).some((value) => {
          this.filtersModels[value] = null;
        });

        this.params.filters = null;
      }
    },
    handleClearSelect(key) {
      delete this.params.filters[key];
    },
    handleSelectCheckbox() {
      let selected = this.data.data.filter((value) => Object.values(this.selected).includes(value[this.checkboxKey]));
      this.$emit("on-select", selected);
    },
    handleSelectCheckboxCheckboxAll() {
      let all = [];
      this.selected = [];

      if (!this.selectAll) {
        for (let item in this.data.data) {
          all.push(this.data.data[item]);
          this.selected.push(this.data.data[item][this.checkboxKey]);
        }
      }

      this.$emit("on-select-all", all);
    },
  },
  watch: {
    params: {
      handler: throttle(function () {
        let params = pickBy(this.params);

        this.$inertia.get(`${window.location.pathname}`, params, {
          replace: true,
          preserveState: true,
        });
      }, 500),
      deep: true,
    },
    selected: {
      handler: function () {
        if (this.data.data.length != this.selected.length) {
          this.selectAll = false;
        } else {
          this.selectAll = true;
        }
      },
      deep: true,
    },
  },
};
</script>