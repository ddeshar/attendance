import Vue from 'vue'
import Vuex from 'vuex'
import stitexam from './modules/stitexam'
import register from './modules/register'
Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

export default new Vuex.Store({
  modules: {
    register,stitexam

  },
  strict: debug
})