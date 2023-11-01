<script setup lang="ts">
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#F9FAFB] dark:bg-[#111827]"
    >
        <slot name="header">
            <div>
                <Link href="/">
                    <ApplicationLogo
                        class="w-20 h-20 fill-current text-gray-500"
                    />
                </Link>
            </div>
        </slot>

        <slot />

        <slot name="footer" />
    </div>
</template>
