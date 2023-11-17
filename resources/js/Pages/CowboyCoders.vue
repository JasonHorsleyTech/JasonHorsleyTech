<script lang="ts" setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import PrettyMarkdown from "@/Components/PrettyMarkdown.vue";
console.log(route("lyrics.show", { song: "one_line_at_a_time" }));
</script>

<template>
    <GuestLayout>
        <template #header>
            <Head title="Welcome" />
        </template>
        <div
            class="flex flex-col lg:grid place-content-center grid-cols-2 flex-nowrap h-[90vh] md:w-[36rem] lg:w-full max-w-7xl gap-4 p-4"
        >
            <div style="padding: 66.67% 0 0 0; position: relative">
                <iframe
                    src="https://player.vimeo.com/video/885810629?badge=0&amp;autopause=0&amp;quality_selector=1&amp;player_id=0&amp;app_id=58479"
                    frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    style="
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                    "
                    title="One line at a time"
                ></iframe>
            </div>

            <div
                class="relative grow overflow-y-scroll rounded-lg lg:h-[32rem]"
            >
                <PrettyMarkdown
                    appearance="tight"
                    :api-endpoint="
                        route('lyrics.show', { song: 'one_line_at_a_time' })
                    "
                />
            </div>
        </div>
    </GuestLayout>
</template>
