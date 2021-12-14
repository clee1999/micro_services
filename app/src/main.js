import Vue from "vue";
import App from "./App.vue";
import vuetify from "./plugins/vuetify";
import "./assets/_global.scss";
import VueRouter from "vue-router";
import Router from "./routes";
Vue.use(VueRouter);
Vue.config.productionTip = false;

const router = new VueRouter({ routes: Router });

new Vue({
  vuetify,
  render: (h) => h(App),
  router: router,
}).$mount("#app");
