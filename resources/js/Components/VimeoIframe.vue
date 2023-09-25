<script setup lang="ts">
import axios from "axios";
import { computed } from "vue";
import { ref } from "vue";

const vimeoNameToId = {
    test: {
        id: "868053959",
        title: "Mic check",
    },
} as Record<string, { id: string; title: string }>;
type VimeoKeys = keyof typeof vimeoNameToId;

const props = defineProps<{ videoName: VimeoKeys }>();

const videoInfo = computed(() => {
    const { id, title } = vimeoNameToId[props.videoName];
    // TODO: Check and make sure app_id shared between videos.
    return {
        title,
        source: `https://player.vimeo.com/video/${id}?badge=0&autopause=0&player_id=0&app_id=58479`,
    };
});

const track = async () => {
    await axios.post(route("video.track", { video: props.videoName }));
}
</script>

<template>
    <div class="relative aspect-w-16 aspect-h-9">
        <iframe
            @click="track"
            class="absolute top-0 left-0 w-full h-full border-none"
            :src="videoInfo.source"
            :title="videoInfo.title"
            frameborder="0"
            allow="autoplay; fullscreen; picture-in-picture"
        />
    </div>
</template>
