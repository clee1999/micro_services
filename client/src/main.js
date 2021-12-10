import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'

import Login from "./components/Login";
import Register from "./components/Register";
import "../index.css";
import Home from "./components/Home";
import Profile from "./components/Profile";
import ReservationList from "./components/ReservationList";

Vue.config.productionTip = false
Vue.use(VueRouter)

const routes = [
  { path: '/', component: Home},
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/profile', component: Profile},
  { path: '/rdv', component: ReservationList}
]

const router = new VueRouter({
  routes,
  mode: 'history'
})
new Vue({
  render: h => h(App),
  router
}).$mount('#app')
