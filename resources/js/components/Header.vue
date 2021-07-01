<template>
    <header>
        <div class="container">
            <router-link class="brand" :to="{ name: 'home' }"
                ><strong>BoolPress</strong></router-link
            >
            <nav>
                <ul>
                    <li>
                        <router-link :to="{ name: 'home' }">Home</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'blog' }">Blog</router-link>
                    </li>
                    <li>
                        <router-link :to="{ name: 'about' }">About</router-link>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header"
};
</script>

<style lang="scss" scoped>
header {
    background: darkcyan;
    .active:not(.brand) {
        color: rgb(30, 255, 98);
    }
}
</style>
