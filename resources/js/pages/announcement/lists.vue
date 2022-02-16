<template>
    <div class="flex flex-row items-center bg-white p-3 rounded-tr rounded-tl border-b">
        <div class="flex flex-row items-center space-x-4">
            <select-input v-model="params.reqruitments">
                <option value="all" selected>Semua</option>
                <option v-for="(item, index) in filter.reqruitments" :key="index" :value="item.id">{{ item.name }}</option>
            </select-input>
        </div>
        <div class="flex flex-row items-center space-x-6 ml-auto">
            <p>{{ items.from }} - {{ items.to }} dari {{ items.total }}</p>
            <app-link :href="items.prev_page_url" class="hover:bg-red-500 hover:text-white rounded transition duration-75">
                <icon name="ChevronLeftIcon" class="w-8 h-8" />
            </app-link>
            <app-link :href="items.next_page_url" class="hover:bg-red-500 hover:text-white rounded transition duration-75">
                <icon name="ChevronRightIcon" class="w-8 h-8" />
            </app-link>
        </div>
    </div>
    <div class="flex flex-col divide-y bg-white rounded-bl rounded-br shadow">
        <template v-if="items && items.data && items.data.length">
            <div v-for="(item, index) in items.data" :key="index" class="p-4 hover:bg-gray-100 transition duration-75 flex flex-row items-center">
                <button @click.prevent="handleMark(item.id, Enum.STARED)" type="button" v-if="!item.deleted_at">
                    <icon name="StarIcon" :type="item.status == Enum.STARED ? 'solid' : 'outline'" class="w-6 h-6 mr-4" />
                </button>

                <div class="space-y-1">
                    <h1 class="font-semibold text-lg">{{ item.title }}</h1>
                    <p>{{ item.content }}</p>
                </div>

                <div class="ml-auto flex flex-row space-x-4" v-if="!item.deleted_at">
                    <button @click.prevent="handleMark(item.id, Enum.DRAFT)" type="button">
                        <icon name="InboxIcon" :type="item.status == Enum.DRAFT ? 'solid' : 'outline'" class="w-6 h-6" />
                    </button>
                    <button @click.prevent="handleDelete(item.id)" type="button">
                        <icon name="TrashIcon" type="outline" class="w-6 h-6" />
                    </button>
                </div>
                <div class="ml-auto flex flex-row space-x-4" v-if="item.deleted_at">
                    <button @click.prevent="handleRestore(item.id)" type="button">
                        <icon name="ReplyIcon" type="outline" class="w-6 h-6" />
                    </button>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="bg-white p-4 flex justify-center text-gray-400">
                Kosong
            </div>
        </template>
    </div>
</template>
<script>
import Enum from './enum';
import { pickBy } from 'lodash'

export default {
    name: "Lists",
    props: {
        items: Object,
        filter: Object,
    },
    data: () => ({
        Enum: Enum,
        params: {
            reqruitments: 'all',
        }
    }),
    methods: {
        handleMark(id, type) {
            this.$inertia.post(`/announcement/${id}/${type}`, {
                onSuccess: () => {
                    this.$toast.success('Berhasil');
                }
            })
        },
        handleDelete(id) {
            this.$inertia.delete(`/announcement/delete/${id}`);
        },
        handleRestore(id) {
            this.$inertia.post(`/announcement/restore`, { id })
        }
    },
    watch: {
        params: {
            handler(value) {
                let params = pickBy(this.params);

                this.$inertia.get(`${window.location.pathname}`, params, {
                    replace: true,
                    preserveState: true,
                });
            },
            deep: true,
        }
    }
}
</script>