<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import {onUnmounted, ref} from "vue";

const props = defineProps({
    task: Object,
    app_url: String,
});

const form = useForm({
    name: props.task.name,
    description: props.task.description,
    image: props.task.image,
});

const imageUrl = ref('');

const handleFileChange = event => {
    if (event.target.files.length > 0) {
        const file = event.target.files[0];
        // form.image = file;
        imageUrl.value = URL.createObjectURL(file);
    }
};

onUnmounted(() => {
    if (imageUrl.value) {
        URL.revokeObjectURL(imageUrl.value);
    }
});


const submit = () => {
    form.put(route('tasks.update', props.task.id), {
        preserveScroll: true,
        onSuccess: () => {
            console.log('actualizado')
        }
    });
};
</script>


<template>
    <Head :title="`Task Edit: ${form.name}`" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Task Edit: {{ form.name }}</h2>
                <Link :href="route('tasks.list')" class="text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    <i class="fas fa-arrow-left"></i> Back to tasks list
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required />
                                <InputError :message="form.errors.name" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="description" value="Description" />
                                <TextInput id="description" type="text" class="mt-1 block w-full" v-model="form.description" required />
                                <InputError :message="form.errors.description" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="image" value="Image" />
                                <div>
                                    <img :src="imageUrl || `${app_url}/${form.image}`" alt="Current Image" class="w-32 h-32 object-cover rounded-md" onerror="this.src='fallback-image-url';"/>
                                </div>
                                <input type="file" id="image" @change="handleFileChange" class="mt-1 block w-full" />
                                <InputError :message="form.errors.image" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update Task
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
