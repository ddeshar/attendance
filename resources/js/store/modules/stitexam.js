import auth from '../../api/register';
import register from './register';
const state = {
  stitexams:[],
  explaces:[],
  loading: false,
  }
  
  const getters = { 

    stitexams(state) {
      return state.stitexams;
  },

  explaces(state) {
    return state.explaces;
},
//ค่าเดี่ยว
  stitexam(state) {
    return state.stitexams;
}
  }
  
  const actions = {
    getstitexams(context) {
      return new Promise((resolve, reject) => {
      axios.get('/api/stitexam')
      .then((response) => {
        context.commit('updatestitexams', response.data.stitexam);
        resolve(response.data.stitexam);
      }).catch(error => {
      reject(error);

    })
});
  },
  getexplace(context) {
    return new Promise((resolve, reject) => {
    axios.get('/api/explace')
    .then((response) => {
      context.commit('updateexplace', response.data.explace);
      resolve(response.data.explace);
    }).catch(error => {
    reject(error);
 
  })
});
},
  getstitexamsdetail(context,payload) {
    return new Promise((resolve, reject) => {
    axios.get(`/api/stitexam/show/${payload.edu_year}/${payload.id_explace}/${payload.id_level}`)
    .then((response) => {
      context.commit('updatestitexamsdetail', response.data.stitexam);
      resolve(response.data.stitexam);
    }).catch(error => {
      reject(error);
 
  })
});

   
}}
  

  
  
  const mutations = {

    updatestitexams(state, payload) {
      state.stitexams = payload;
  },
  updateexplace(state, payload) {
    state.explaces = payload;
},
  updatestitexamsdetail(state, payload) {
    state.stitexams = payload;
}
    
  }
  
  export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
  }