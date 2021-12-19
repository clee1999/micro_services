import HomePage from "./components/HomePage.vue";
import SearchDoctor from "./components/SearchDoctor.vue";
import DoctorReservation from "./components/DoctorReservation.vue";
import LoginPage from "./components/LoginPage";
import RegisterPage from "./components/RegisterPage";

export default [
  {path: "/", component: HomePage},
  {path: "/recherche", component: SearchDoctor},
  {path: "/docteur", component: DoctorReservation},
  {path: "/login", component: LoginPage},
  {path: "/register", component: RegisterPage}
];
