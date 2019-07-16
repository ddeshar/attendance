




import About from './views/About'
import Home from './views/Home'
import register from './views/auth/register'
import login from './views/auth/login'
import profile from './views/auth/profile'
window.Vue = require('vue');
import VueRouter from 'vue-router'

import stitexamMain from './views/stitexam/main'
import stitexamList from './views/stitexam/list'
import stitexamCreate from './views/stitexam/create'
import stitexamEdit from './views/stitexam/edit'
import stitexamShow from './views/stitexam/show'



Vue.use(VueRouter);

const router = new VueRouter ({
   mode: 'history',
    routes: [


        {
            path: '/',
            name: 'home',
            component: Home,
            // a meta field
            meta: { requiresAuth: true }
            
        },
        {
            path: '/about',
            name: 'about',
            component: About,
            meta: { requiresAuth: false }
        },
        {
            path: '/register',
            name: 'register',
            component: register,
            meta: { requiresAuth: false }
        },
        {
            path: '/profile',
            name: 'profile',
            component: profile,
            meta: { requiresAuth: true }
        },
        {
            path: '/login',
            name: 'login',
            component: login,
            meta: { requiresAuth: false }
        },
        {
            path: '/stitexam',
            component: stitexamMain,
            meta: { requiresAuth: true},
     
            children: [
                {
                    path: '/',
                    component: stitexamList
                },
                {
                    path: 'create',
                    component: stitexamCreate
                },
                {
                    path: 'edit/:id',
                    component: stitexamEdit
                },
                {
                    path: 'show/:edu_year/:id_explace/:id_level',
                    component: stitexamShow
                }
            ]
        },
   
    ]
});
// router.beforeEach((to, from, next) => {
//     // redirect to login page if not logged in and trying to access a restricted page
//     const { authorize } = to.meta;
//     const currentUser = register.currentUser;

//     if (authorize) {
//         if (!currentUser) {
//             // not logged in so redirect to login page with the return url
//             return next({ path: '/login', query: { returnUrl: to.path } });
//         }

//         // check if route is restricted by role
//         if (authorize.length && !authorize.includes(currentUser.roles)) {
//             // role not authorised so redirect to home page
//             return next({ path: '/' });
//         }
//     }

//     next();
// })
export default router;