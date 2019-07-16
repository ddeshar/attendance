import auth from '../../api/register';

const state = {
    loggedIn: auth.loggedIn(),
   
    // loggedIn: false,
    user: {},
    // token:{},
  }
  
  const getters = {
    currentUser(state) {
        return state.user;
    },
    isLoggedIn(state) {
        return state.loggedIn && state.user;
    },
};
  
  const actions = {
    register({commit}, userData) {
        return new Promise((resolve, reject) => {
            auth.registerUser(userData).then(response => {
                commit('setAuth', response.data.data);
               
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },
      login({commit}, userData) {
        return new Promise((resolve, reject) => {
            auth.loginUser(userData).then(response => {
                // commit('setAuth', response.data.data);
                commit('setToken', response.data.data);
                resolve(response);
             
                window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + auth.getToken();
            }).catch(error => {
                reject(error);
            })
        });
    },

    getUser({commit}) {
        return new Promise((resolve, reject) => {
            auth.getUser().then(response => {
                commit('setAuth', response.data.data);
                window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + auth.getToken();
                resolve(response);
            }).catch(error => {
                reject(error);
                // commit('errorGetuser');
                // localStorage.removeItem('token')
              
        
            })
        });
    },

    logout({commit}) {
       
            commit('setLogout')
       
        // commit('setLogout');
    }
  }
  
  const mutations = {
      errorGetuser(state){
        state.loggedIn = false;
      },
    setAuth(state, user) {
        state.user = user;
        state.loggedIn = true;
     
        // auth.setToken(state.user.token);
    },
    setToken(state,user){
        state.loggedIn = true;
        auth.setToken(user.token);
      
    },
    setLogout(state) {
        state.user = {};
        state.loggedIn = false;
        auth.destroyToken();
    }
  }
  
  export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
  }