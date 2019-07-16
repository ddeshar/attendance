import register from "../store/modules/register";

export function initialize(store, routes) {
    routes.beforeEach((to, from, next) => {
        if (to.matched.some(record => record.meta.requiresAuth)) {
          // this route requires auth, check if logged in
          // if not, redirect to login page.
          
          if (!store.getters['register/isLoggedIn']) {
            next({
              path: '/login',
              query: { redirect: to.fullPath }
              
            })
          
          } else {
            next()
          }
        } else {
           
                next()
              

      
        }
      })
   
}

