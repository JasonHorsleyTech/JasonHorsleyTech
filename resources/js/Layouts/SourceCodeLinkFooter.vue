<script lang="ts" setup>
defineProps<{
    url: string;
}>();
</script>

<template>
    <footer class="w-full text-right text-sm dark:text-white">
        <a
            :href="url"
            target="_blank"
            class="hover:underline cursor-pointer hover:opacity-75"
        >
            Read my code!
        </a>
    </footer>
</template>
