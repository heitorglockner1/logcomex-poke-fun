<template>
    <v-app class="main">
        <div class="bg">
            <router-view />
        </div>
    </v-app>
</template>

<script>
export default {
    name: "app",
};
</script>

<style scoped>
.main {
    background-color: #f8f9fa;
}
</style>
