<script setup>
import { useForm } from "@inertiajs/vue3";
import { watch } from "vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
    url: {
        type: String,
        required: true,
    },
    placeholder: {
        type: String,
        default: "Search...",
    },
});

const form = useForm({
    search: null,
});

function search() {
    form.get(props.url, {
        data: form.search,
        preserveState: true,
    });
}

watch(
    () => form.search,
    () => search(),
    { debounce: 500 }
);
</script>

<template>
    <!-- Search -->
    <form @submit.prevent="search" class="mb-4 justify-start flex gap-2">
        <TextInput
            v-model="form.search"
            type="search"
            :placeholder="props.placeholder"
            class="w-full md:max-w-xs"
        ></TextInput>
        <PrimaryButton type="submit">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="w-5 h-5"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"
                />
            </svg>
        </PrimaryButton>
    </form>
</template>
