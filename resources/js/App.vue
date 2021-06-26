<template>
    <div>
        <!-- Header -->
        <Header />

        <!-- Main -->
        <main>
            <!-- Component matched by the route will render here -->
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import Header from "./components/Header.vue";

export default {
    name: "App",
    components: {
        Header
    }
};
</script>

<style lang="scss"></style>
