import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') },
    ],
  },
  {
    path: '/pets',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '/index', component: () => import('pages/Adoption/Index.vue'), name: 'pets.index' },
    ],
  },
  // Always leave this as last one, but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];
export default routes;
