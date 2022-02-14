<template>
    <div class="shadow overflow-auto border border-gray-200 sm:rounded-lg dark:border-cool-gray-700">
        <div class="p-4 bg-gray-100 border-b border-dashed dark:bg-cool-gray-700 dark:border-cool-gray-800" v-if="title">
            <h2 class="text-xl font-bold text-gray-700 dark:text-cool-gray-300">{{ title }}</h2>
        </div>

        <div class="flex flex-col gap-3 p-5 space-y-3">
            <div class="flex justify-between space-x-4">
                <div class="w-full">
                    <text-input label="Nama Penerimaan" v-model="form.name" :error="form.errors.name" />
                </div>
                <div class="w-full">
                    <text-input type="number" label="Nilai Minimum Kelulusan" v-model="form.min_pass" :error="form.errors.min_pass" />
                </div>
            </div>
            <div class="flex justify-between space-x-4">
                <div class="w-full">
                    <text-input type="date" label="Tanggal Mulai" v-model="form.start_at" :error="form.errors.start_at" />
                </div>
                <div class="w-full">
                    <text-input type="date" label="Tanggal Selesai" v-model="form.end_at" :error="form.errors.end_at" />
                </div>
            </div>
            <textarea-input label="Keterangan" v-model="form.description" :error="form.errors.description" />

            <loading-button @click.prevent="store" :loading="form.processing" class="btn-red ml-auto" type="button">Tambah</loading-button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                min_pass: null,
                start_at: null,
                end_at: null,
                description: null,
            }),
        }
    },
    methods: {
        store() {
            this.form.post('/reqruitment', {
                onSuccess: () => {
                    this.form.reset();
                    this.$toast.success('Berhasil menambah penerimaan');
                }
            });
        }
    }
}
</script>