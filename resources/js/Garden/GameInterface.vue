<template>
    <div
        class="bg-green-200/50 rounded-lg border border-green-300 shadow-md p-[2px]"
    >
        <div class="relative">
            <canvas
                height="500"
                width="1000"
                class="bg-gray-100/25 rounded-md"
            />
            <div class="absolute inset-0">
                <button
                    @click="saveGame"
                    class="absolute top-0 right-0 m-1 px-3 py-2 text-white bg-green-500/50 rounded-md hover:bg-green-600"
                    :class="{ 'opacity-50': saving }"
                >
                    {{ saving ? "..." : "S" }}
                </button>
            </div>
        </div>
    </div>
</template>
