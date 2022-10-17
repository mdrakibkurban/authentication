import axios from 'axios';
import { createStore } from 'vuex'

axios.defaults.baseURL = "http://127.0.0.1:8000/api/auth"

const store = createStore({
    state () {
      return {
        token : localStorage.getItem('accessToken') || null
      }
    },
    getters: {
      loggedIn(state){
          return state.token !== null;
      }
    },

    mutations: {
      SET_TOKEN(state, token){
           state.token = token;
      },

      REMOVE_TOKEN(state){
         state.token = null;
      }

    },
   

    actions: {
      login({commit}, loginForm){
          return new Promise((resolve ,reject)=>{
            axios.post('/login',{
              email    : loginForm.email,
              password : loginForm.password,
            }).then((response)=>{
              localStorage.setItem('accessToken',response.data.data.access_token)
              commit('SET_TOKEN', response.data.data.access_token)
              resolve(response.data)
            }).catch((error)=>{
               reject(error)
            })
          })
      },



      register({commit}, resiterForm){
          return new Promise((resolve ,reject)=>{
            axios.post('/register',{
              name    : resiterForm.name,
              email    : resiterForm.email,
              password : resiterForm.password,
            }).then((response)=>{
              resolve(response.data)
            }).catch((error)=>{
              reject(error)
            })
          })
      },


      logout(context){
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token;
        return new Promise((resolve ,reject)=>{
          axios.post('/logout').then((response)=>{
            localStorage.removeItem('accessToken')
            context.commit('REMOVE_TOKEN')
            resolve(response.data)
          }).catch((error)=>{
             reject(error)
          })
        })
      }


    },

  })

export default store;