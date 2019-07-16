<template>
<div>
       <b-card class="mt-3" >
          <b-breadcrumb :items="items"></b-breadcrumb>
           <form @submit.prevent="register()" class="register-component__form">
   <div class="form-group">
     <label for="">name</label>
     <input type="text"
       class="form-control" v-model="name"  aria-describedby="helpId" placeholder="">
     <small id="helpId" class="form-text text-muted">Help text</small>
   </div>
   <div class="form-group">
     <label for="">email</label>
     <input type="email"
       class="form-control" v-model="email"  aria-describedby="helpId" placeholder="">
     <small id="helpId" class="form-text text-muted">Help text</small>
   </div>
     <div class="form-group">
     <label for="">password</label>
     <input type="password"
       class="form-control" v-model="password" aria-describedby="helpId" placeholder="">
     <small id="helpId" class="form-text text-muted">Help text</small>
   </div>
     <div class="form-group">
     <label for="">password_confirmation</label>
     <input type="password"
       class="form-control" v-model="password_confirmation" id="" aria-describedby="helpId" placeholder="">
     <small id="helpId" class="form-text text-muted">Help text</small>
   </div>
   <button type="submit" class="btn btn-primary" >Submit</button>
   </form>
    </b-card>
   </div>
</template>

<script>
   import store from '../../store/index';
    import {mapGetters, mapActions} from 'vuex';
    export default {
        beforeRouteEnter(to, from, next) {
            if (store.getters['register/isLoggedIn']) {
            store.dispatch("register/getUser").catch(error => {
                    if (error.response) {
                        this.checkResponse(error.response.status);
                    }
                });
                 next("/");
            } else {
               
                 next();
            }
        },
        name : 'register',
        data() {
            return {
                 items: [
          {
            text: 'หน้าแรก',
            href: '#'
          },
          {
            text: 'สมัครสมาชิก',
            active: true
          },
         
        ],
                   name: '',
                email: '',
                password: '',
                password_confirmation: '',
                errors:{
                    name: [],
                    email: [],
                    password: [],
                    password_confirmation:[],
                },
            }
        },
        methods: {
            resetData(){
                this.user = {
                     name: null,
                    email: null,
                    password: null,
                    password_confirmation:null,
                }
            },
            register(){
             this.$store.dispatch('register/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation:this.password_confirmation,
              }).then((response) => {
                    this.$router.push({name: 'home'});
                 })
                }
            },
        }
    
</script>