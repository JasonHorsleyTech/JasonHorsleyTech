<script setup lang="ts">
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    name: "",
});

const submit = () => {
    form.post("/gardens");
};
</script>

<template>
    <div class="flex items-center justify-center h-screen bg-gray-800">
        <div
            class="p-6 max-w-sm w-full bg-green-200 rounded-lg border border-green-300 shadow-md"
        >
            <h1 class="text-xl font-bold mb-4">Create New Garden</h1>
            <input
                v-model="form.name"
                placeholder="Garden Name"
                class="w-full p-2 mb-4 text-gray-700 bg-white border border-gray-300 rounded-md"
            />
            <button
                @click="submit"
                class="w-full px-3 py-2 text-white bg-green-500 rounded-md focus:bg-green-600 focus:outline-none"
            >
                Create
            </button>
        </div>
    </div>
</template>
