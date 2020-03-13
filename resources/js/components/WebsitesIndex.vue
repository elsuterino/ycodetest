<template>
    <section class="container mx-auto">
        <div class="flex mb-4 -mx-4">
            <div class="flex-1 px-4">
                <label for="q" class="block mb-1 text-xs">Search</label>
                <input id="q" class="form-input w-full" v-model="q">
            </div>
            <div class="flex-1 px-4">
                <label for="order_field" class="block mb-1 text-xs">Order by</label>

                <select id="order_field" class="form-select w-full" v-model="order.field">
                    <option :value="null"></option>
                    <option value="name">Name</option>
                    <option value="created_at">Created at</option>
                </select>
            </div>

            <div class="flex-1 px-4">
                <label for="order_direction" class="block mb-1 text-xs">Order Direction</label>

                <select id="order_direction" class="form-select w-full" v-model="order.direction">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
        </div>
        <div class="bg-white rounded-md border p-4 mb-4">
            <table class="w-full">
                <thead>
                <tr class="uppercase text-gray-600">
                    <th>
                        name
                    </th>
                    <th>
                        url
                    </th>
                    <th>
                        created at
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="website in websites">
                    <td>{{ website.name }}</td>
                    <td>{{ website.url }}</td>
                    <td>{{ website.created_at }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="flex justify-between">
            <button
                class="form-input"
                :class="[pagination.current_page === 1 ? 'cursor-not-allowed bg-gray-300': 'hover:bg-gray-100 bg-white']"
                :disabled="pagination.current_page === 1"
                @click="page--"
            >
                Prev
            </button>
            <button
                class="form-input"
                :class="[pagination.current_page >= pagination.last_page ? 'cursor-not-allowed bg-gray-300' : 'hover:bg-gray-100 bg-white']"
                :disabled="pagination.current_page >= pagination.last_page"
                @click="page++"
            >
                Next
            </button>
        </div>
    </section>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                websites: [],
                pagination: {},
                page: 1,
                q: '',
                order: {
                    field: null,
                    direction: 'asc'
                }
            }
        },
        created() {
            this.updateWebsites();
        },
        watch: {
            page() {
                this.updateWebsites();
            },
            q() {
                this.page = 1;
                this.updateWebsites();
            },
            order: {
                deep: true,
                handler(){
                    this.page = 1;
                    this.updateWebsites();
                }
            }
        },
        methods: {
            updateWebsites() {
                axios
                    .get('/api/websites', {
                        params: {
                            page: this.page,
                            q: this.q,
                            order_field: this.order.field,
                            order_direction: this.order.direction
                        }
                    })
                    .then(response => {
                        this.websites = response.data.data;
                        this.pagination = response.data.meta
                    })
            },
        }
    }
</script>
