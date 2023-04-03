<script setup>
import { Head, useForm, usePage } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { computed } from "vue";

defineProps({ clients: Object });

const form = useForm({
    title: null,
    description: null,
    budget: null,
    deadline: null,
    user_id: null,
});

const { auth } = usePage().props;

const isAdmin = computed(() => {
    return auth.user.is_admin;
});

function submit() {
    form.post(route("projects.store", form));
}
</script>
<template>
    <Head title="Create a Project" />
    <AuthenticatedLayout>
        <template #header> Create Project </template>

        <form @submit.prevent="submit">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="space-y-6">
                    <div>
                        <InputLabel for="title" value="Title" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Fix bugs in a WordPress website..."
                            v-model="form.title"
                        />

                        <InputError :message="form.errors.title" class="mt-2" />
                    </div>

                    <div>
                        <InputLabel for="description" value="Description" />

                        <TextAreaInput
                            id="description"
                            type="text"
                            class="mt-1 block w-full"
                            :placeholder="form.description"
                            v-model="form.description"
                        />

                        <InputError
                            :message="form.errors.description"
                            class="mt-2"
                        />
                    </div>

                    <div
                        class="space-y-6 md:space-y-0 md:grid md:grid-cols-2 md:gap-6"
                        :class="{
                            'md:grid-cols-3': isAdmin,
                        }"
                    >
                        <div class="w-full">
                            <InputLabel for="budget" value="Budget ($)" />
                            <TextInput
                                id="budget"
                                type="number"
                                min="5"
                                class="mt-1 block w-full"
                                placeholder="100"
                                v-model="form.budget"
                            />

                            <InputError
                                :message="form.errors.budget"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <InputLabel for="deadline" value="Deadline" />
                            <input
                                type="date"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"
                                v-model="form.deadline"
                                id="deadline"
                            />
                            <InputError
                                :message="form.errors.deadline"
                                class="mt-2"
                            />
                        </div>

                        <div v-if="isAdmin">
                            <InputLabel for="project" value="For Client (Optional):" />
                            <select
                                id="project"
                                v-model="form.user_id"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600 capitalize"
                            >
                            <option value="null" disabled>Select a Client</option>
                                <option
                                    v-for="client in clients"
                                    :value="client.id"
                                >
                                    {{ client.name }}
                                </option>
                            </select>

                            <InputError
                                :message="form.errors.user_id"
                                class="mt-2"
                            />
                        </div>
                    </div>
                </div>
                <PrimaryButton type="submit" class="mt-6">Create</PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
