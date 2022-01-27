import Vue from "vue";
import App from "./App.vue";
import vuetify from "./plugins/vuetify";
import "./assets/_global.scss";
import VueRouter from "vue-router";
import "./axios";
import DatetimePicker from "vuetify-datetime-picker";

// Les différents components
import HomePage from "./components/HomePage.vue";
import SearchDoctor from "./components/SearchDoctor.vue";
import DoctorFiche from "./components/DoctorFiche.vue";
import Dashboard from "./components/Admin/Dashboard.vue";
import DashboardDoctor from "./components/Doctor/Dashboard.vue";
import GestionCreneau from "./components/Doctor/GestionCreneau.vue";
import VoirRendezVous from "./components/Doctor/VoirRendezVous.vue";
import StepperReservation from "./components/StepperReservation.vue";
import MesRendezVous from "./components/MesRendezVous.vue";
import LoginPage from "./components/LoginPage";
import RegisterPage from "./components/RegisterPage";

Vue.use(VueRouter);
Vue.use(DatetimePicker);
Vue.config.productionTip = false;

const router = new VueRouter({
  mode: "history",
  routes: [
    { path: "/", component: HomePage },
    { path: "/recherche", component: SearchDoctor },
    { path: "/docteur/:id", component: DoctorFiche, name: "doctor" },
    { path: "/admin", component: Dashboard },
    {
      path: "/doctor",
      component: DashboardDoctor,
      children: [
        { path: "/gerer-creneaux", component: GestionCreneau },
        { path: "/voir-rendez-vous", component: VoirRendezVous },
      ],
    },
    { path: "/reservation/:id", component: StepperReservation }, // TODO: mettre :id
    {
      path: "/mes-rendez-vous",
      component: MesRendezVous,
    },
    { path: "/login", component: LoginPage },
    { path: "/register", component: RegisterPage },
  ],
});
new Vue({
  vuetify,
  render: (h) => h(App),
  router: router,
}).$mount("#app");
