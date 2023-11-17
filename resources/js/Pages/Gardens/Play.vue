<script setup lang="ts">
import { ref } from "vue";
import axios from "axios";
import GameInterface from "@/Garden/GameInterface.vue";
import { Inertia } from "@inertiajs/inertia";

const gameVersion = "0.0.1";

const props = defineProps<{ garden: { id: number; name: string } }>();

const clicked = ref(0);

function incrementCounter() {
    clicked.value++;
}

const saving = ref<boolean>(false);
async function saveGame() {
    saving.value = true;

    try {
        const response = await axios.post(`/gardens/${props.garden.id}/saves`, {
            data: { clicked: clicked.value },
            saved_with: gameVersion,
        });
        console.log("Save successful:", response.data);
    } catch (error) {
        console.error("Error saving game:", error);
    }

    saving.value = false;
}
</script>

<template>
    <div class="grid place-content-center h-screen bg-gray-800">
        <GameInterface />
    </div>
</template>
