import { createRouter, createWebHistory } from 'vue-router'
import UserRegistration from '../views/UserRegistration.vue'
import LogIn from '../views/LogIn.vue'
import AdminIndex from '../views/Admin/AdminIndex.vue'
import AdminIncoming from '../views/Admin/AdminIncoming.vue'
import AdminOutgoing from '../views/Admin/AdminOutgoing.vue'
import AdminPending from '../views/Admin/AdminPending.vue'
import AdminReports from '../views/Admin/AdminReports.vue'
import AdminUserManagement from '../views/Admin/AdminUserManagement.vue'

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
    path: '/adminincoming',
    component: AdminIncoming
  },
  {
    path: '/adminoutgoing',
    component: AdminOutgoing
  },
  {
    path: '/adminpending',
    component: AdminPending
  },
  {
    path: '/adminreports',
    component: AdminReports
  },
  {
    path: '/adminusermanagement',
    component: AdminUserManagement
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
