<script setup>
import { computed } from "vue";
const props = defineProps({
    colorText: {
        type: String,
        default: "white",
    },
    colorBackground: {
        type: String,
        default: "blue",
    },
    font: {
        type: String,
        default: "semibold",
    },
    textSize: {
        type: String,
        default: "sm",
    },
    rounded: {
        type: String,
        default: "lg",
    },
});
const colorTextComputed = computed(() => `text-${props.colorText}`);
const colorBackgroundComputed = computed(
    () => `bg-${props.colorBackground}-500`
);
const hoverBackgroundComputed = computed(
    () => `hover:bg-${props.colorBackground}-300`
);
const fontComputed = computed(() => `font-${props.font}`);
const textSizeComputed = computed(() => `text-${props.textSize}`);
const rounded = computed(() => `rounded-${props.rounded}`);

const classObject = computed(() => {
    return {
        [colorTextComputed.value]: true,
        [colorBackgroundComputed.value]: true,
        [fontComputed.value]: true,
        [textSizeComputed.value]: true,
        [rounded.value]: true,
        [hoverBackgroundComputed.value]: true,
    }
})
</script>
<template>
    <button
        class="px-4 py-2 shadow-lg border-none flex items-center"
        :class="classObject"
    >
        <slot />
    </button>
</template>

<style></style>
