<template>
  <div id="main">
    <div class="stitexam-view">
      <div class="user-info">
        <table class="table">
         
          <tr>
            <th>ส่งสอบ</th>
            <td>{{ stitexam.stit1 }}</td>
          </tr>
          <tr>
            <th>ขาดสอบ</th>
            <td>{{ stitexam.stit2 }}</td>
          </tr>
          <tr>
            <th>คงเหลือ</th>
            <td>{{ stitexam.stit3 }}</td>
          </tr>
          <tr>
            <th>สอบได้</th>
            <td>{{ stitexam.stit4 }}</td>
          </tr>
          <tr>
            <th>สอบตก</th>
            <td>{{ stitexam.stit5 }}</td>
          </tr>
          <tr>
            <th>ระดับการศึกษา</th>
            <td>{{ stitexam.level }}</td>
          </tr>
          <tr>
            <th>ปีการศึกษา</th>
            <td>{{ stitexam.edu_year }}</td>
          </tr>
          <tr>
            <th>สนามสอบ</th>
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
          </tr>
        </table>
        <router-link to="/stitexam">Back to all stitexams</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import store from "../../store/index";
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      stitexam: {}
    };
  },
  mounted() {
    // this.$store.dispatch("register/getUser");
    this.fatch();
    //  this.$bar.finish()
       if(this.$store.getters['register/aftergetuser'] ){
        this.$store.dispatch("stitexam/getstitexamsdetail", data)
          .then(response => {
            this.stitexam = response;
            this.$bar.finish();
          });
      }
  },
  methods: {
    fatch() {
      
      if (this.stitexams.length) {
        this.stitexam = this.stitexams.find(stitexam => 
               ( stitexam.edu_year == this.$route.params.edu_year &&
                stitexam.id_explace == this.$route.params.id_explace &&
                stitexam.id_level == this.$route.params.id_level)
        
        );
    
         this.$bar.finish();
     
      } else {

        let data = {edu_year : this.$route.params.edu_year,
             id_explace : this.$route.params.id_explace,
             id_level : this.$route.params.id_level};

             
             
        this.$store.dispatch("stitexam/getstitexamsdetail", data)
          .then(response => {
            this.stitexam = response;
            this.$bar.finish();
          });
      
      }
    }
    
  },
  computed: {
    ...mapGetters({
      stitexams: "stitexam/stitexams",
       
    })
  }
};
</script>