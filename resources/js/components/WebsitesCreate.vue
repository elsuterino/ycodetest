<template>
    <section class="container mx-auto">
        <!-- some simple Message feedback go here -->
        <div
            v-if="message"
            :class="[`bg-${message_color}-500 text-white px-8 py-4 text-md`]"
        >
            {{ message }}
        </div>
        <!-- validation errors -->
        <div
            v-if="errors"
            class="bg-red-500 text-white px-8 py-4 text-md"
        >
            <ul class="list-disc list-inside">
                <li v-for="error in errors">{{ error[0] }}</li>
            </ul>
        </div>

        <div class="bg-white rounded-md border p-8 mb-4">
            <div class="mb-3">
                <label
                    for="name"
                    class="block text-xs mb-1"
                >
                    Name
                </label>
                <input
                    id="name"
                    class="form-input"
                    v-model="form.name"
                >
            </div>
            <div class="mb-3">
                <label
                    for="url"
                    class="block text-xs mb-1"
                >
                    Url
                </label>
                <input
                    id="url"
                    type="url"
                    class="form-input"
                    v-model="form.url"
                >
            </div>
            <div>
                <button
                    class="form-input bg-gray-800 text-white hover:bg-gray-900"
                    @click="create"
                >
                    Create
                </button>
            </div>
        </div>
    </section>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                form: {
                    name: '',
                    url: '',
                },
                errors: null,
                message: null,
                message_color: null
            }
        },
        methods: {
            create() {
                axios
                    .post('/api/websites', this.form)
                    .then(response => {
                        this.clearForm();
                        this.message = response.data.message;
                        this.message_color = 'green';
                        this.errors = null;
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                        this.message = error.response.data.message;
                        this.message_color = 'red';
                    })
            },
            clearForm() {
                for (const key in this.form) {
                    if (this.form.hasOwnProperty(key)) {
                        this.form[key] = null;
                    }
                }
            }
        }
    }
</script>
