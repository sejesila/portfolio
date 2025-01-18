<template>
    <Head title="New Project" />
    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                New Project
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-md sm:px-6 lg:px-8 bg-white">
                <form  class="p-4" @submit.prevent="submit">
                    <div>
                        <InputLabel for="skill" value="Skill" />
                        <select name="skill_id" id="skill_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md " v-model="form.skill_id">
                            <option v-for="skill in skills" :key="skill.id" :value="skill.id">{{skill.name}}</option>
                        </select>
                    </div>
                    <div>
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus

                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div>
                        <InputLabel for="url" value="URL" />

                        <TextInput
                            id="url"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.url"
                            required

                        />

                        <InputError class="mt-2" :message="form.errors.url" />
                    </div>
                    <div class="mt-2">
                        <InputLabel for="image" value="Image" />

                        <TextInput
                            id="image"
                            type="file"
                            class="mt-1 block w-full"
                            @input="form.image = $event.target.files[0]"
                        />

                        <InputError class="mt-2" :message="form.errors.image" />
                    </div>

                    <div class="mt-4 flex items-center justify-end">

                        <PrimaryButton
                            class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Store
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head,Link,useForm} from '@inertiajs/vue3';
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
defineProps({
    skills:Array
})
const form = useForm({
    name: '',
    image: null,
    skill_id:'',
    url:''

});

const submit = () => {
    form.post(route('projects.store'));

};
</script>
