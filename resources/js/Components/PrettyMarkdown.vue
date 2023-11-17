<script lang="ts" setup>
import MarkdownIt from "markdown-it";
import "@/../scss/MarkdownItStyleOverrides.scss";
import Loader from "./Loader.vue";
import { onMounted } from "vue";
import axios from "axios";
import { ref } from "vue";

const props = defineProps<{
    rawMarkdown?: string;
    apiEndpoint?: string;
}>();

const md = new MarkdownIt();

const content = ref<string | null>(null);

onMounted(async () => {
    if (props.rawMarkdown) {
        content.value = md.render(props.rawMarkdown);
    } else if (props.apiEndpoint) {
        const response = (await axios.get(props.apiEndpoint)) as {
            data: {
                markdown: string;
            };
        };

        content.value = md.render(response.data.markdown);
    } else {
        console.error(
            "PrettyMarkdown component requires either a rawMarkdown or apiEndpoint prop"
        );
    }
});
</script>

<template>
    <div
        class="shadow-xl rounded-lg border bg-[#EDF2F7] dark:border-[#4B5563] dark:bg-[#EDF2F7]/20"
    >
        <Loader v-if="!content" />
        <div
            v-else
            class="prose dark:prose-invert min-h-[32rem] p-4"
            v-html="content"
        ></div>
    </div>
</template>
