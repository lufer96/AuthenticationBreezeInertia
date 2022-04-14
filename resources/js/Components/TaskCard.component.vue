<script setup>
import { computed } from "vue";
import ButtonCustom from "@/Components/ButtonCustom.vue";
import DeleteIcon from "@/Components/Icons/DeleteIcon.vue";
import PencilIcon from "@/Components/Icons/PencilIcon.vue";
const props = defineProps({
    task: {
        type: Object,
        default: () => ({}),
    },
});
const taskTextStatus = computed(() =>
    props.task.status ? "Completed" : "Pending"
);
</script>
<template>
    <div
        class="max-w-sm rounded shadow-lg transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 duration-300"
    >
        <div class="px-6 py-6">
            <span class="font-bold text-xl mb-2">
                {{ task.name }}
            </span>
            <p class="text-gray-700 text-base pt-4">
                {{ task.description }}
            </p>
        </div>
        <div class="px-6 py-4 flex justify-between">
            <span>{{ task.user.name }}</span>
            <div class="form-check">
                <input
                    class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                    type="checkbox"
                    v-model="task.status"
                    id="flexCheckChecked"
                />
                <label
                    class="form-check-label inline-block text-gray-800 w-20"
                    for="flexCheckChecked"
                >
                    {{ taskTextStatus }}
                </label>
            </div>
        </div>
        <div class="px-6 py-4 flex justify-between">
            <ButtonCustom
                colorText="white"
                colorBackground="red"
                font="normal"
                textSize="sm"
                rounded="lg"
            >
                <DeleteIcon class="mr-2" />
                Delete
            </ButtonCustom>
            <ButtonCustom
                colorText="white"
                colorBackground="blue"
                font="normal"
                textSize="sm"
                rounded="lg"
            >
                <PencilIcon class="mr-2" />
                Edit
            </ButtonCustom>

        </div>
    </div>
</template>
