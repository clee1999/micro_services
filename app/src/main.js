import Vue from "vue";
import App from "./App.vue";
import vuetify from "./plugins/vuetify";
import "./assets/_global.scss";
import VueRouter from "vue-router";
import Vuex from "vuex";
import "./axios";

// Les différents components
import HomePage from "./components/HomePage.vue";
import SearchDoctor from "./components/SearchDoctor.vue";
import DoctorFiche from "./components/DoctorFiche.vue";
import Dashboard from "./components/Admin/Dashboard.vue";
import StepperReservation from "./components/StepperReservation.vue";
import MesRendezVous from "./components/MesRendezVous.vue";
import LoginPage from "./components/LoginPage";
import RegisterPage from "./components/RegisterPage";

Vue.use(VueRouter);
Vue.config.productionTip = false;
Vue.use(Vuex);

// Auth Guard pour un utilisateur
const store = new Vuex.Store({
  state: {
    authenticated: false,
  },
  mutations: {
    setAuthentication(state, status) {
      state.authenticated = status;
    },
  },
});

const router = new VueRouter({
  routes: [
    { path: "/", component: HomePage },
    { path: "/recherche", component: SearchDoctor },
    { path: "/docteur", component: DoctorFiche }, // TODO: mettre :id
    { path: "/admin", component: Dashboard },
    { path: "/reservation", component: StepperReservation }, // TODO: mettre :id
    {
      path: "/mes-rendez-vous",
      component: MesRendezVous,
      beforeEnter: (to, from, next) => {
        if (store.state.authenticated == false) {
          next(false);
        } else {
          next();
        }
      },
    },
    { path: "/login", component: LoginPage },
    { path: "/register", component: RegisterPage },
  ],
});
new Vue({
  vuetify,
  render: (h) => h(App),
  router: router,
  store: store,
}).$mount("#app");
