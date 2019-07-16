<template>
  <div>
    <div>
      <b-navbar toggleable="lg" type="dark" variant="info">
        <b-container>
          <b-navbar-brand href="#">สถิติ-กองธรรม</b-navbar-brand>

          <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

          <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
              <b-nav-item :to="{ name: 'home' }">หน้าแรก</b-nav-item>
              <b-nav-item :to="{ name: 'about' }">About Us</b-nav-item>
              <b-nav-item to="/stitexam">stitexam</b-nav-item>
            </b-navbar-nav>

            <!-- Right aligned nav items -->
            <b-navbar-nav class="ml-auto">
              <b-nav-form>
                <b-form-input size="sm" class="mr-sm-2" placeholder="Search"></b-form-input>
                <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
              </b-nav-form>

              <b-nav-item
                :to="{ name: 'login' }"
                v-if="!this.$store.getters['register/isLoggedIn']"
              >login</b-nav-item>
              <b-nav-item
                :to="{ name: 'register' }"
                v-if="!this.$store.getters['register/isLoggedIn']"
              >register</b-nav-item>
              <b-nav-item-dropdown right v-if="this.$store.getters['register/isLoggedIn']">
                <!-- Using 'button-content' slot -->
                <template slot="button-content">{{ user.name }}</template>
                <b-dropdown-item :to="{ name: 'profile' }">Profile</b-dropdown-item>
                <b-dropdown-item v-on:click="logout">Sign Out</b-dropdown-item>
                 
              </b-nav-item-dropdown>
            </b-navbar-nav>
          </b-collapse>
        </b-container>
      </b-navbar>
    </div>
    <p></p>

    <b-container>
      <router-view></router-view>
    </b-container>
  </div>
</template>
<script>
import VueProgressBar from "vue-progressbar";

import { mapGetters, mapActions } from "vuex";
import store from "../store/index";
export default {
mounted(){
  if(this.$store.getters['register/isLoggedIn']){

   this.$store.dispatch("register/getUser").then(response => {
                
            }).catch(error => {
               
                // commit('errorGetuser');
              
                
              this.logout()
        
            })
    
  }

   
},
methods:{
logout() {
      this.$store.dispatch("register/logout");
      this.$router.push("/login");
      // Materialize.toast('Logged out', 5000);
    }
},
  computed: {
    ...mapGetters({
      user: "register/isLoggedIn"
    }),
   
  }
};
</script>