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

    <div class="grid place-content-center bg-[#F9FAFB] min-h-screen p-4">
        <div
            class="shadow-xl rounded-lg w-[36rem] min-h-[32rem] border bg-[#EDF2F7] p-4"
        >
            <div class="prose" v-html="htmlContent"></div>
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
    @apply border bg-black/25 shadow-lg rounded-lg overflow-hidden w-full #{!important};

    thead {
        @apply bg-gray-100 #{!important};
    }

    tbody {
        @apply bg-gray-100 #{!important};
    }

    td,
    th {
        @apply border border-gray-300/50 px-4 py-2 #{!important};
    }
}
</style>
