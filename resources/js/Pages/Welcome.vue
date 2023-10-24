<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
import MarkdownIt from "markdown-it";
import { ref } from "vue";
const markdownContent = ref<string | null>(null);
const htmlContent = ref<string | null>(null);

import { onMounted } from "vue";
const md = new MarkdownIt();

onMounted(async () => {
    const { data } = await axios.get("/api/professional/resume");
    markdownContent.value = data.resume;
    htmlContent.value = md.render(data.resume);
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="grid place-content-center bg-[#F9FAFB] dark:bg-[#111827] min-h-screen p-4"
    >
        <div
            class="shadow-xl rounded-lg md:w-[36rem] min-h-[32rem] border bg-[#EDF2F7] dark:border-[#4B5563] dark:bg-[#EDF2F7]/20 p-4"
        >
            <div class="prose dark:prose-invert" v-html="htmlContent"></div>
        </div>
    </div>
</template>

<style lang="scss">
h1 {
    img {
        @apply h-12 w-12 m-0 #{!important};
    }
    @apply flex items-center gap-4 #{!important};
}
h2 {
    @apply border-b border-gray-300 pb-4 #{!important};
}

h3 {
    @apply border-t border-dashed border-gray-300 mt-4 pt-4 #{!important};
}

li::marker {
    @apply text-[#3398DB] dark:text-white #{!important};
}

h3:first-of-type {
    @apply border-t-0 mt-0 pt-0 #{!important};
}

blockquote {
    @apply m-0 #{!important};
}
blockquote p {
    @apply m-0 #{!important};
}

table {
    @apply border bg-black/25 dark:bg-gray-500 shadow-lg rounded-lg overflow-hidden w-full #{!important};

    thead {
        @apply bg-gray-100 dark:bg-gray-700 #{!important};
        tr {
            @apply border-b-[2px] border-gray-400/50 dark:border-gray-500/50 #{!important};
        }
    }

    tbody {
        @apply bg-gray-100 dark:bg-gray-900 #{!important};
    }

    td,
    th {
        @apply border border-gray-300/50 dark:border-gray-700 px-4 py-2 #{!important};
    }
}
</style>
