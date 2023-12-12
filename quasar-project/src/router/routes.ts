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
    path: '/institutional',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '/institutional', component: () => import('pages/Institutional/Institutional.vue'), name: 'institutional.index' },
    ],
  },
  {
    path: '/contact',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '/contact', component: () => import('pages/Contact/Contact.vue'), name: 'contact.index' },
    ],
  },
  {
    path: '/pets',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '/index', component: () => import('pages/Adoption/Index.vue'), name: 'pets.index' },
    ],
  },
  {
    path: '/petsAdmin',
    component: () => import('layouts/RegisterLayout.vue'),
    children: [
      { path: '/indexAdmin', component: () => import('pages/AdoptionAdmin/IndexAdmin.vue'), name: 'petsIndex.index' },
    ],
  },
  {
    path: '/register',
    component: () => import('layouts/RegisterLayout.vue'),
    children: [
      { path: '/register', component: () => import('pages/Register/Register.vue'), name: 'register.index' },
    ],
  },
  {
    path: '/edit/:id',
    name: 'edit',
    component: () => import('layouts/RegisterLayout.vue'),
    children: [
      { path: '/edit/:id', component: () => import('pages/Edit/Edit.vue'), name: 'edit.index' },
    ],
  },
  // Always leave this as last one, but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue'),
  },
];
export default routes;
