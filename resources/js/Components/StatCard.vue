<script setup>
import UserIcon from "@/Components/Icons/UserIcon.vue";

const { stat, title, type } = defineProps({
    title: {
        type: String,
    },
    stat: {
        type: Number,
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
    "text-gray-500 bg-gray-100": type === "dark",
    "text-purple-500 bg-purple-100": type === "brand",
};
</script>

<template>
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xs border">
        <div class="p-3 mr-4 rounded-full" :class="cardTypeClass">
            <slot name="icon">
                <UserIcon />
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
