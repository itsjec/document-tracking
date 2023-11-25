import { createRouter, createWebHistory } from 'vue-router'
import UserRegistration from '../views/UserRegistration.vue'
import LogIn from '../views/LogIn.vue'
import AdminIndex from '../views/Admin/AdminIndex.vue'

const routes = [
  {
    path: '/register',
    component: UserRegistration
  },
  {
    path: '/',
    component: LogIn
  },
  {
    path: '/admin',
    component: AdminIndex
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
