<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import MarkdownIt from "markdown-it";
import { ref } from "vue";
const markdownContent = ref<string | null>(null);
const htmlContent = ref<string | null>(null);

import { onMounted } from "vue";
const md = new MarkdownIt();

onMounted(async () => {
    // TODO: axios request to API route that checks IP and returns resume that's closest to whatever companies I have my resume out for.
    // const response = await fetch("/path/to/resumes/resume1.md");
    // const text = await response.text();
    // markdownContent.value = text;
    // htmlContent.value = md.render(text);
});
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
            <div v-html="htmlContent"></div>
        </div>
    </div>
</template>
