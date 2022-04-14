<script setup>
import { ref, watch } from "vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import TasKCardComponent from "@/Components/TaskCard.component.vue";
import LoadingComponent from "@/Components/Loading.component.vue";

const props = defineProps({
    tasks: Object,
});
</script>

<template>
    <Head title="List Tasks" />
    <div class="container pt-10 mx-auto w-5/6">
        <div class="flex justify-between">
            <span class="text-lg font-bold"> List task </span>
            <button
                class="px-4 py-2 bg-blue-400 hover:bg-blue-300 rounded-lg font-semibold tex-sm text-white"
            >
                Create new task
            </button>
        </div>

        <div class="flex flex-wrap gap-8 mt-10 justify-between">
            <TasKCardComponent
                v-for="task in tasks.data"
                :key="task.uuid_key"
                :task="task"
            />
        </div>
        <div
            v-if="tasks.data.length === 0"
            class="flex justify-center text-lg text-gray-900 font-bold mt-8"
        >
            No tasks found...
        </div>
    </div>
</template>
