<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    task: {
        type: Object,
        required: false,
    },
    app_url: {
        type: String,
        required: false,
    }
});
</script>

<template>
    <Head title="Task Detail"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Task Detail: {{ task.name }}</h2>
                <Link :href="route('tasks.list')" class="text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-arrow-left"></i> Back to tasks list
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ task.name }}</h3>
                            <p class="text-gray-600">{{ task.description }}</p>
                            <img :src="`${app_url+task.image}`" alt="Task Image" class="mt-4 max-w-xs"
                                 onerror="this.style.display='none'">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
