<template>
  <div>
    <b-card class="mt-3">
      <b-breadcrumb :items="items"></b-breadcrumb>
      <form @submit.prevent="login()" class="register-component__form">
        <div class="form-group">
          <label for>email</label>
          <input
            type="email"
            class="form-control"
            v-model="email"
            aria-describedby="helpId"
            placeholder
          />
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>
        <div class="form-group">
          <label for>password</label>
          <input
            type="password"
            class="form-control"
            v-model="password"
            aria-describedby="helpId"
            placeholder
          />
          <small id="helpId" class="form-text text-muted">Help text</small>
        </div>

        <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
      </form>
      <b-button type="reset" v-on:click="logout">Reset</b-button>
    </b-card>
  </div>
</template>

<script>
import store from "../../store/index";
export default {
  beforeRouteEnter(to, from, next) {
    if (store.getters["register/isLoggedIn"]) {
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
  name: "login",
  data() {
    return {
      items: [
        {
          text: "หน้าแรก",
          href: "#"
        },
        {
          text: "ล็อคอิน",
          active: true
        }
      ],

      email: "",
      password: "",
      checked: [],
      show: true
    };
  },
  mounted(){
      this.$bar.finish();
  },
  methods: {
    logout() {
      this.$store.dispatch("register/logout");
    },
    login() {
      // this.$validator.validateAll().then(result => {
      // if (result) {
      this.$store
        .dispatch("register/login", {
          email: this.email,
          password: this.password
        })
        .then(response => {
              this.$store.dispatch('register/getUser');
          this.$router.push({ name: "home" });
          this.onReset();
        })
        .catch(error => {
          // const errors = Object.values(error.response.data.errors).map(error => {
          //     return '<li>' + error + '</li>'
          // }).join();
          // Materialize.toast('<ul>' + errors + '</ul>', 5000);
        });
      // }
      // });
    }
  }
};
</script>