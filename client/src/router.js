import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      redirect: {'name': 'login'}
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('./pages/login.vue')
    },
    {
      path: '/settings',
      name: 'settings',
      component: () => import('./pages/settings.vue')
    },
    {
      path: '/rent/',
      component: () => import('./pages/homepage.vue'),
      children: [
        {
          path: '',
          redirect: {'name': 'personal'}
        },
        {
          path: 'personal',
          name: 'personal',
          component: () => import('./pages/rent/personal.vue')
        },
        {
          path: 'group',
          name: 'group',
          component: () => import('./pages/rent/group.vue')
        },
        {
          path: ':state/add',
          name: 'addNew',
          component: () => import('./pages/rent/addNew.vue')
        }
      ]
    },
    {
      path: '/management',
      name: 'management',
      component: () => import('./pages/item_management/management.vue')
    },
    {
      path: '/management/details',
      name: 'management_details',
      component: () => import('./pages/item_management/details.vue')
    },
    {
      path: '/users',
      name: 'users',
      component: () => import('./pages/users.vue')
    }
  ]
});
