import HomePage from "./components/HomePage.vue";
import SearchDoctor from "./components/SearchDoctor.vue";
import DoctorReservation from "./components/DoctorReservation.vue";
import DoctorDashboardReservation from "./components/DoctorDashboardReservation.vue";

export default [
  { path: "/", component: HomePage },
  { path: "/recherche", component: SearchDoctor },
  { path: "/docteur", component: DoctorReservation },
  { path: "/docteurDashboard", component: DoctorDashboardReservation },

];
