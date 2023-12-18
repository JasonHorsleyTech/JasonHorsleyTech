<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Resume from "@/Singletons/Resume.vue";
import SourceCodeLinkFooter from "@/Layouts/SourceCodeLinkFooter.vue";

// import.meta has to be in this file, otherwise I'll always link to the composable :|
import generateGithubLink from "@/Composables/generateGithubLink";
const footerUrl = generateGithubLink(import.meta.url);

const props = defineProps<{
    company_location_id: number | null;
}>();
</script>

<template>
    <GuestLayout>
        <template #header>

            <Head title="Welcome" />
        </template>

        <div class="grid place-content-center md:w-[36rem] min-h-screen gap-4 py-4">
            <Resume :company_location_id="props.company_location_id" />
        </div>

        <template #footer>
            <div class="md:w-[36rem] p-4">
                <SourceCodeLinkFooter :url="footerUrl" />
            </div>
        </template>
    </GuestLayout>
</template>
