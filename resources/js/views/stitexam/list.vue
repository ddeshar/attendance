<template>
  <div>
    <div class="btn-wrapper">
      <router-link to="/stitexam/create" class="btn btn-primary btn-sm">New</router-link>
      <router-link to="api/stitexam/pdf" class="btn btn-primary btn-sm">pdf</router-link>
 
      <a href="test.pdf" target="_blank">Download</a>
   
    </div>
    <table class="table">
      <thead>
        <th>s1</th>
        <th>s2</th>
        <th>s3</th>
        <th>s4</th>
        <th>s5</th>
        <th>ระดับชั้น</th>
        <th>ปีการศึกษา</th>
        <th>สนามสอบ</th>

        <th>Actions</th>
      </thead>
      <tbody>
        <!-- <template >
                    <tr>
                        <td colspan="4" class="text-center">No Customers Available</td>
                    </tr>
        </template>-->
        <template>
          <tr v-for="stitexam in stitexams" v-bind:key="stitexam.id">
            <td>{{ stitexam.stit1 }}</td>
            <td>{{ stitexam.stit2 }}</td>
            <td>{{ stitexam.stit3 }}</td>
            <td>{{ stitexam.stit4 }}</td>
            <td>{{ stitexam.stit5 }}</td>
            <td>{{ stitexam.level }}</td>
            <td>{{ stitexam.edu_year }}</td>
            <td>
              <b-img
                thumbnail
                fluid
                width="50"
                v-bind:src="'/png250px/' + stitexam.th_country"
                alt="Image 1"
              ></b-img>
              {{ stitexam.th_explace }}
            </td>

            <td>
              <router-link :to="`/stitexam/show/${stitexam.edu_year}/${stitexam.id_explace}/${stitexam.id_level}`" :key="$route.fullPath">View</router-link>
              <router-link :to="`/stitexam/edit/${stitexam.id}`">edit</router-link>
            </td>
          </tr>
          <tr>
            <td>
              <div></div>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script>

import store from "../../store/index";
import { mapGetters, mapActions } from "vuex";
export default {
  name: "list",

  mounted() {
    // if (this.stitexams.length) {
    //     return;
    // }
    
    //   .then((response) => {
    //       console.log(response.data)
    //          });
    //    },
    // this.$store.dispatch("register/getUser");
    this.$store.dispatch("stitexam/getstitexams").then(response => {
      this.$bar.finish();
    })   .catch(error => {
   console.log(error);
    // localStorage.removeItem('token')
        // commit('register/errorGetuser')
          // this.$router.push("/login");
   
       });
    ;
  },
  methods:{
    getpdf(){
        axios.get('/api/stitexam/pdf')
    }
       
  },
  computed: {
    ...mapGetters({
      stitexams: "stitexam/stitexams",
      currentUser: "register/currentUser"
    })
    //              test() {
    //   axios.get('/api/stitexam')
    //   .then((response) => {
    //       console.log(response.data)
    //          });
    //    },
    // stitexams() {
    //     // return this.$store.state.stitexams;
    //      return this.$store.getters.stitexams
    // }
  }
};
</script>