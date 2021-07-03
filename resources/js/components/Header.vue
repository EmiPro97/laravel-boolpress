<template>
    <header>
        <div>
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
                    <li>
                        <router-link :to="{ name: 'contact' }"
                            >Contact</router-link
                        >
                    </li>
                </ul>
            </nav>
        </div>

        <ul class="right-link">
            <li><a href="/admin">Admin</a></li>
        </ul>
    </header>
</template>

<script>
export default {
    name: "Header"
};
</script>

<style lang="scss" scoped>
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: darkcyan;
    padding: 0 30px;
    .active:not(.brand) {
        color: rgb(30, 255, 98);
    }
    .right-link {
        list-style: none;
    }
}
</style>
