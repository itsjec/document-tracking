import { createRouter, createWebHistory } from 'vue-router';
import LogIn from '../views/LogIn.vue'
import UserRegistration from '../views/UserRegistration.vue'
import AdminIndex from '../views/Admin/AdminIndex.vue'
import AdminOngoing from '../views/Admin/AdminOngoing.vue'
import AdminOutgoing from '../views/Admin/AdminOutgoing.vue'
import AdminPending from '../views/Admin/AdminPending.vue'
import AdminSent from '../views/Admin/AdminSent.vue'
import AdminHistory from '../views/Admin/AdminHistory.vue'
import UserIndex from '../views/User/UserIndex.vue'
import UserNotification from '../views/User/UserNotification.vue'
import UserTracking from '../views/User/UserTracking.vue'
import UserAddDocu from '../views/User/UserAddDocu.vue'
import UserResult from '../views/User/UserResult.vue'

const routes = [
  {
    path: '/',
    component: LogIn
  },
  {
    path: '/register',
    component: UserRegistration
  },
  {
    path: '/admin',
    component: AdminIndex
  },
  {
    path: '/adminongoing',
    component: AdminOngoing
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
    path: '/adminsent',
    component: AdminSent
  },
  {
    path: '/adminhistory',
    component: AdminHistory
  },
  {
    path: '/user',
    component: UserIndex
  },
  {
    path: '/usernotif',
    component: UserNotification
  },
  {
    path: '/usertracking',
    component: UserTracking,
 
  },
  {
    path: '/useradd',
    component: UserAddDocu
  },
  {
    path: '/userresult',
    component: UserResult
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
