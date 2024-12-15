<script setup>
import GenerateUrlForm from '@/Components/GenerateUrlForm.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

</script>

<template>

    <Head title="Welcome" />
    <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
        <div class="relative flex min-h-screen flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">

            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl py-5">
                <header class="grid grid-cols-2 items-center gap-2 py-5 lg:grid-cols-3">
                    <nav v-if="canLogin" class="">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Dashboard
                        </Link>

                        <template v-else>
                            <Link :href="route('login')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Log in
                            </Link>

                            <Link v-if="canRegister" :href="route('register')"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Register
                            </Link>
                        </template>
                    </nav>
                </header>

                <main class="mt-6">
                    <GenerateUrlForm/>
                </main>

                <div class="mt-8 flex items-center justify-start text-black">
                    <ol class="list-group-numbered">
                        <li class="text-red-500">- Guest user generated url live only 7 Days</li>
                        <li>- You can create short url as guest and as logged user both.</li>
                        <li>- Logged in user enjoy the permanently save feature.</li>
                    </ol>
                </div>
            </div>
            <footer class="absolute bottom-0 py-3 text-center text-uppercase text-sm text-black dark:text-white/70">
                URL Shortener App
            </footer>
        </div>
    </div>
</template>
