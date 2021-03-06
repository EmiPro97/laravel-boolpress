/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
window.axios = require("axios");

// Vue main instance
import App from "./App.vue";

// Router
import router from "./routes";

const root = new Vue({
    el: "#root",
    router,
    render: h => h(App)
});
