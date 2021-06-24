<template>
    <div>
        <header>Header here</header>

        <main>
            <h1>Posts</h1>
            <article v-for="post in posts" :key="post.id">
                <h2>{{ post.title }}</h2>
                <div>{{ formatDate(post.created_at) }}</div>
                <a href="">Read more</a>
            </article>
        </main>
    </div>
</template>

<script>
export default {
    name: "App",
    created() {
        this.getPosts();
    },
    data() {
        return {
            posts: []
        };
    },
    methods: {
        getPosts() {
            axios
                .get("http://127.0.0.1:8000/api/posts")
                .then(res => {
                    this.posts = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },

        formatDate(date) {
            const postDate = new Date(date);
            let day = postDate.getDate();
            let month = postDate.getMonth() + 1;
            let year = postDate.getFullYear();

            if (day < 10) {
                day = "0" + day;
            }

            if (month < 10) {
                month = "0" + month;
            }

            return `${day}/${month}/${year}`;
        }
    }
};
</script>

<style lang="scss"></style>
