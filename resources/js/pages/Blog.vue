<template>
    <div class="container">
        <h1>Blog</h1>
        <div v-if="posts">
            <article class="m-b-md" v-for="post in posts" :key="post.id">
                <h2 class="m-b-0">{{ post.title }}</h2>
                <div>
                    <strong>Creation date:</strong>
                    {{ formatDate(post.created_at) }}
                </div>
                <router-link
                    :to="{ name: 'post-detail', params: { slug: post.slug } }"
                    >Read More...</router-link
                >
            </article>
            <!-- Navigation -->
            <section class="navigation">
                <button
                    @click="getPosts(pagination.currentPage - 1)"
                    v-show="pagination.currentPage > 1"
                >
                    Prev
                </button>
                <button
                    v-for="i in pagination.lastPage"
                    :key="`page-${i}`"
                    @click="getPosts(i)"
                    :class="{ 'active-page': i == pagination.currentPage }"
                >
                    {{ i }}
                </button>
                <button
                    @click="getPosts(pagination.currentPage + 1)"
                    v-show="pagination.currentPage < pagination.lastPage"
                >
                    Next
                </button>
            </section>
        </div>
        <div v-else>
            Loading...
        </div>
    </div>
</template>

<script>
export default {
    name: "Blog",
    created() {
        this.getPosts();
    },
    data() {
        return {
            posts: null,
            pagination: {}
        };
    },
    methods: {
        getPosts(page = 1) {
            axios
                .get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then(res => {
                    // console.log(res.data);
                    this.posts = res.data.data;
                    this.pagination = {
                        currentPage: res.data.current_page,
                        lastPage: res.data.last_page
                    };
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

<style scoped lang="scss">
.navigation {
    button {
        border: none;
        margin: 0 2px;
        cursor: pointer;
    }
    .active-page {
        background: dodgerblue;
    }
}
a {
    color: inherit;
}
</style>
