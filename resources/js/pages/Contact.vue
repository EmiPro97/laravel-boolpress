<template>
    <div class="container">
        <h1 class="mb-5">Contact us</h1>

        <div v-show="succes" class="succes-message">
            Message sent succesfully
        </div>
        <form @submit.prevent="postForm">
            <!-- Name -->
            <div class="form-group">
                <label for="name">Name</label>
                <input v-model="name" type="text" id="name" />
                <div
                    class="error-message"
                    v-for="(error, index) in errors.name"
                    :key="`err-name-${index}`"
                >
                    {{ error }}
                </div>
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input v-model="email" type="text" id="email" />
                <div
                    class="error-message"
                    v-for="(error, index) in errors.email"
                    :key="`err-email-${index}`"
                >
                    {{ error }}
                </div>
            </div>
            <!-- Message -->
            <div class="form-group">
                <label for="message">Message</label>
                <textarea
                    v-model="message"
                    type="text"
                    cols="30"
                    rows="10"
                    id="message"
                ></textarea>
                <div
                    class="error-message"
                    v-for="(error, index) in errors.message"
                    :key="`err-message-${index}`"
                >
                    {{ error }}
                </div>
            </div>

            <button type="submit" :disabled="sending">
                {{ sending ? "Sending..." : "Send" }}
            </button>
        </form>
    </div>
</template>

<script>
export default {
    name: "Contact",
    data() {
        return {
            name: "",
            email: "",
            message: "",
            errors: {},
            succes: false,
            sending: false
        };
    },
    methods: {
        postForm() {
            this.sending = true;

            axios
                .post("http://127.0.0.1:8000/api/contacts", {
                    name: this.name,
                    email: this.email,
                    message: this.message
                })
                .then(res => {
                    console.log(res.data);
                    this.sending = false;

                    if (res.data.errors) {
                        this.errors = res.data.errors;
                        this.succes = false;
                    } else {
                        this.name = "";
                        this.email = "";
                        this.message = "";
                        this.succes = true;
                        this.errors = {};
                    }
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
.succes-message {
    margin-bottom: 2rem;
    color: limegreen;
    font-size: 1.2rem;
}

.form-group {
    margin-bottom: 1rem;
    label {
        display: block;
    }
    .error-message {
        color: red;
    }
}

button:disabled {
    cursor: not-allowed;
}
</style>
