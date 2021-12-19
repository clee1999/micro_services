import HomePage from "./components/HomePage.vue";
import SearchDoctor from "./components/SearchDoctor.vue";
import DoctorFiche from "./components/DoctorFiche.vue";
import Dashboard from "./components/Admin/Dashboard.vue";
import StepperReservation from "./components/StepperReservation.vue";

export default [
  { path: "/", component: HomePage },
  { path: "/recherche", component: SearchDoctor },
  { path: "/docteur", component: DoctorFiche }, // TO DO: mettre :id
  { path: "/admin", component: Dashboard },
  { path: "/reservation", component: StepperReservation }, // TO DO: mettre :id
];
