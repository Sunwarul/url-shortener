<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    url: Object
});

</script>

<template>
    <GuestLayout>
        <div class="w-full">

            <Head title="Detail page"></Head>
            <p class="border p-3 text-green-500">Short URL:
                <a :href="url.short_code" target="_blank">{{ url.short_code }}</a>
            </p>
            <p class="border p-3 mt-2">
                Original URL: <a :href="url.original_url" target="_blank" class="text-decoration-underline">{{
                    url.original_url }}</a>
            </p>
        </div>
    </GuestLayout>
</template>
