<template>
    <form class="bg-white rounded shadow-md border">
        <div class="p-4 flex flex-col space-y-6">
            <text-input v-model="form.title" label="Judul" :error="form.errors.title" />
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
export default {
    data() {
        return {
            form: this.$inertia.form({
                title: null,
                content: null,
            }),
        }
    },
    methods: {
        store() {
            this.form.post("/announcement", {
                onSuccess: (event) => {
                    this.form.reset();
                },
            });
        },
    }
}
</script>