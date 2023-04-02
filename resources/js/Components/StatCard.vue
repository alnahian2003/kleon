<script setup>
const { stat, title, type } = defineProps({
    title: {
        type: String,
    },
    stat: {
        type: String,
    },
    type: {
        type: String,
        default: "primary",
    },
});

const cardTypeClass = {
    "text-pink-500 bg-pink-100": type === "primary",
    "text-green-500 bg-green-100": type === "success",
    "text-red-500 bg-red-100": type === "danger",
    "text-orange-500 bg-orange-100": type === "warning",
    "text-blue-500 bg-blue-100": type === "info",
};
</script>

<template>
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border">
        <div class="p-3 mr-4 rounded-full" :class="cardTypeClass">
            <slot name="icon">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                    ></path>
                </svg>
            </slot>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">
                {{ title }}
            </p>
            <p class="text-2xl font-medium text-gray-700">
                {{ stat }}
            </p>
        </div>
    </div>
</template>
