<template>
  <div class="dashboard-component">
    <b-card class="mt-3">
      <b-form>
        <b-img
          center
          thumbnail
          fluid
          v-bind:src="'/media/avatars/' + user.image"
          rounded="circle"
          alt="Image 2"
          class="py-3"
        ></b-img>
        <b-form-file
          v-model="user.image"
          placeholder="Choose a file..."
          drop-placeholder="Drop file here..."
        ></b-form-file>
        <b-form-group
          id="input-group-1"
          label="Name:"
          label-for="input-1"
          description="We'll never share your email with anyone else."
        >
          <b-form-input
            id="input-1"
            v-model="user.name"
            type="email"
            required
            placeholder="Enter email"
          ></b-form-input>
        </b-form-group>

        <b-form-group
          id="input-group-1"
          label="Email address:"
          label-for="input-1"
          description="We'll never share your email with anyone else."
        >
          <b-form-input
            id="input-1"
            v-model="user.email"
            type="email"
            required
            placeholder="Enter email"
          ></b-form-input>
        </b-form-group>
        <b-button type="submit" variant="primary">Submit</b-button>
        <b-button type="reset" variant="danger">Reset</b-button>
      </b-form>
      <ul id="dashboard-sidenav" class="side-nav fixed">
        <li>
          <div class="user-view">
            <div class="background"></div>
            <a href="#">
              <img width="50" class="avatar-image" v-bind:src="'/media/avatars/' + user.image" />
            </a>

            <span class="white-text name">{{user.name}}</span>
            <span class="white-text email">{{user.email}}</span>
            <a href="#" v-on:click="logout">Logout</a>
          </div>
        </li>
      </ul>
    </b-card>
  </div>
</template>
<script>
import store from "../../store/index";
import { mapGetters, mapState } from "vuex";
export default {
  //   beforeRouteEnter(to, from, next) {
  //     if (store.getters['register/isLoggedIn']) {
  //     store.dispatch("register/getUser").catch(error => {
  //             if (error.response) {
  //                 this.checkResponse(error.response.status);
  //             }
  //         });
  //         next();
  //     } else {
  //         next("/login");
  //     }
  // },
  name: "Home",
  data() {
    return {};
  },
  mounted() {
    this.$store
      // .dispatch("register/getUser")
      // .then(response => {
        this.$bar.finish();
      // })
      // .catch(error => {
        // if (error.response) {
          // this.checkResponse(error.response.status);
        // }
      // });
    // $(".button-collapse").sideNav();
  },
  methods: {
    logout() {
      this.$store.dispatch("register/logout");
      this.$router.push("/login");
      // Materialize.toast('Logged out', 5000);
    }
  },
  computed: {
    ...mapGetters({
      user: "register/currentUser"
    })
  }
};
</script>