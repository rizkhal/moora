<template>
    <form class="bg-white rounded shadow-md border">
        <div class="p-4 flex flex-col space-y-6">
            <select-input v-model="form.reqruitment" label="Kepada" :error="form.errors.reqruitment">
                <option v-for="(reqruitment, index) in reqruitments" :value="reqruitment.id" :key="index">{{ reqruitment.name }}</option>
            </select-input>
            <text-input v-model="form.title" label="Subject" :error="form.errors.title" />
            <textarea-input v-model="form.content" label="Isi" :error="form.errors.content" />
        </div>
        <div class="mt-2 p-3 bg-gray-100 border-t">
            <button @click.prevent="store" type="button" class="btn-red">
                Broadcast
            </button>
        </div>
    </form>
</template>
<script>
import NestedLayout from './layout.vue';
import AppLayout from '@/layouts/app-layout.vue';

export default {
    layout: [AppLayout, NestedLayout],
    props: {
        reqruitments: Object,
    },
    data() {
        return {
            form: this.$inertia.form({
                title: null,
                content: null,
                reqruitment: null,
            }),
        }
    },
    methods: {
        store() {
            this.form.post("/announcement", {
                onSuccess: (event) => {
                    this.form.reset();

                    this.$toast.success('Berhasil membuat pengumuman');
                },
            });
        },
    }
}
</script>