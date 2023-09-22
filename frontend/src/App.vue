<script setup>
import Messages from "./components/Messages.vue";
</script>

<template>
    <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
        <Messages :thread="1"/>
    </div>
</template>
