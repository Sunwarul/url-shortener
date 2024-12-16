<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    urls: Object
});
</script>

<template>

    <Head title="Url Collection" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Url's List
                </h2>
                <div>
                    <PrimaryButton>
                        <Link :href="route('dashboard')">Create New</Link>
                    </PrimaryButton>
                </div>

            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                    <div class="p-6 text-gray-900 dark:text-gray-100 border border-bottom">
                        <table>
                            <thead>
                                <tr class="border1">
                                    <th class="border">ID</th>
                                    <th class="border">Original URL</th>
                                    <th class="border">Short Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(url, index) in urls" :key="url.id">
                                    <td class="border p-3">{{ index + 1 }}</td>
                                    <td class="border p-3">{{ url.original_url }}</td>
                                    <td class="border p-3">{{ url.short_code }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
