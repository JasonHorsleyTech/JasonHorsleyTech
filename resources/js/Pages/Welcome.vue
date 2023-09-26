<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();
</script>

<template>
    <Head title="Welcome" />

    <div class="grid place-content-center bg-gray-100 min-h-screen">
        <div
            class="shadow-xl rounded-lg w-[36rem] min-h-[32rem] border bg-gray-200 p-4"
        >
            <h2
                class="text-3xl font-bold border-b pb-2 mb-2 border-gray-800/25"
            >
                Jason Horsley
            </h2>
            <p>Full Stack Developer</p>
            <p>I'm really good at fintech</p>
        </div>
    </div>
</template>
