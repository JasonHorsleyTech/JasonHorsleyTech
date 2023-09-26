<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import { computed } from "vue";

defineProps<{
    canLogin?: boolean;
    canRegister?: boolean;
    laravelVersion: string;
    phpVersion: string;
}>();

let button = document.getElementById("get-location");
let latText = document.getElementById("latitude");
let longText = document.getElementById("longitude");

const whatsmyip = () => {
    navigator.geolocation.getCurrentPosition((position) => {
        let lat = position.coords.latitude;
        let long = position.coords.longitude;

        console.log(lat, long);
    });
};
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
            <p class="hidden fintech:block"></p>

            <button class="p-4 bg-red-100 text-black" @click="whatsmyip">
                WHats my IP?
            </button>
        </div>
    </div>
</template>
