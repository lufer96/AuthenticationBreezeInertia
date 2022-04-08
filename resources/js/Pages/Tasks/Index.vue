<script setup>
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";

defineProps({
    tasks: Object
})
</script>

<template>
        <Head title="List Tasks" />
        <div class="text-lg">Tasks</div>
        {{ tasks}}
        {{ $page.props.tasks}}
</template>
