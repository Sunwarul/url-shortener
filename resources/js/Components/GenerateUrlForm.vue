<script setup>
import { useForm } from '@inertiajs/vue3';
import TextArea from './TextArea.vue';
import PrimaryButton from './PrimaryButton.vue';
import InputError from './InputError.vue';

const form = useForm({
    original_url: ''
});

const submit = () => {
    form.post(route('urls.store'), {
        onFinish: () => form.reset('short_path')
    });
}

</script>

<template>
    <div>
        <form @submit.prevent="submit">
            <div>
                <TextArea rows="5" placeholder="Paster your URL" v-model="form.original_url" />
                <InputError :message="form.errors.original_url" class="py-2" />
            </div>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Submit
            </PrimaryButton>
        </form>
    </div>
</template>
