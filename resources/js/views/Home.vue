<template>
  <div class="dashboard-component" v-if="showlist=true">
    <ul id="dashboard-sidenav" class="side-nav fixed">
      <li>
        <div class="user-view">
          <div class="background"></div>

          <span
            class="white-text"
            v-for="role in user.roles"
            v-bind:key="role.role_name"
          >{{role.role_name }}</span>
          <span
            class="white-text"
            v-for="permission in user.permissions"
            v-bind:key="permission.permission_name"
          >{{permission.permission_name }}</span>
          <a href="#" v-if="showlist=false" v-on:click="logout">Logout</a>
        </div>
      </li>
    </ul>

  </div>
</template>
<script>
import store from "../store/index";
import { mapGetters, mapState } from "vuex";
export default {
  //   beforeRouteEnter(to, from, next) {

  // },
  name: "Home",
  data() {
    return {
      permis: {},
      showlist: false,
      showcreate: false,
      showedit: false,
      showdelete: false
    };
  },
  mounted() {
    // this.$store
    //   .dispatch("register/getUser")
    //   .then(response => {
        this.$bar.finish();
        // this.$router.push("/login");
    //     //    let permis = {};

    //     this.checkrole();
    //   })
    //   .catch(error => {
    //     if (error.response) {
    //       this.checkResponse(error.response.status);
    //     }
    //   });
    // $(".button-collapse").sideNav();
  },
  methods: {
    checkrole() {
      this.user.permissions.forEach(function(nObj) {
        // I can access scope here

        //  console.log(nObj)
        if (nObj.permission_name == "role-list") {
          this.showlist = true;
        } else if (nObj.permission_name == "role-create") {
          this.showcreate = true;
        } else if (nObj.permission_name == "role-edit") {
          this.showedit = true;
        } else if (nObj.permission_name == "role-delete") {
          this.showdelete = true;
        } else {
          console.log("ไม่มี");
        }

        //    this.permis.push( nObj.role_name );
      });
    },
    logout() {
      this.$store.dispatch("register/logout");
      this.$router.push("/login");
      // Materialize.toast('Logged out', 5000);
    }
  },
  computed: {
    // เอา getters นี้ไปใส่ ให้เรียกใช้ function currentUser
    ...mapGetters({
      user: "register/isLoggedIn"
    })
  }
};
</script>