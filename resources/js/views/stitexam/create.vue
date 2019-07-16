<template>
  <div id="main">
    <h1>เพิ่มสถิติสอบต่างประเทศ</h1>
    <b-form-select v-model="selectedYear" class="mb-3">
      <!-- This slot appears above the options from 'options' prop -->
      <template slot="first">
        <!-- <option :value="null" disabled>-- Please select an option --</option> -->
        <option
          v-for="(year, index) in years"
          :value="year.year"
          :selected="selectedYear ===  year.year"
          :key="index"
        >ปีการศึกษา {{ year.year }}</option>
      </template>

      <!-- These options will appear after the ones from 'options' prop -->
    </b-form-select>

    <b-form-select v-model="selectedExplace" class="mb-3" @click="getExplace()">
      <!-- This slot appears above the options from 'options' prop -->
      <template slot="first">
        <option :value="null" disabled>-- เลือกสนามสอบ --</option>
        <option
          v-for="(explace, index) in explaces"
          :value="explace.id"
          :selected="selectedExplace"
          :key="index"
        >{{ explace.th_explace }} ประเทศ{{explace.countrys.th_country}}</option>
      </template>

      <!-- These options will appear after the ones from 'options' prop -->
    </b-form-select>

    <!-- <div v-for="(find, index) in stit" :key="index">
      {{index+1}}
      <input v-model="find.value" ref="value" v-on:input="checkvalue2(index) | checkvalue4(index)"  />
      <input v-model="find.value2" ref="value2" v-on:input="checkvalue2(index) | checkvalue4(index)" />
      <input v-model="find.value3" readonly />
      <input v-model="find.value4" ref="value4" v-on:input="checkvalue4(index)" />
      <input v-model="find.value5" readonly />

      <button @click="deletestit(index)">delete</button>
    </div>-->
     <b-row class="text-center">
         <b-col >ลำดับ</b-col>
         <b-col>ส่งสอบ</b-col>
         <b-col>ขาดสอบ</b-col>
         <b-col>คงเหลือ</b-col>
         <b-col>สอบได้</b-col>
         <b-col>สอบตก</b-col>
            <b-col>ระดับชั้น</b-col>
         <b-col>ลบ</b-col>
     </b-row>
          
    <div  v-for="(find, index) in stit" :key="index"  >
      <div v-if="index < 6">
          <b-row>
    <b-col> <b-form-input :value="index+1" readonly placeholder="stit3"></b-form-input></b-col>
    <b-col>  <b-form-input
    type="number"
        v-model="find.value"
       
        placeholder="stit1"
        ref="value"
       
        v-on:input="checkvalue2(index) | checkvalue4(index)"
      ></b-form-input></b-col>
    <b-col>  <b-form-input
        v-model="find.value2"
        placeholder="stit2"
        type="number"
        ref="value2"
         @keyup.enter="nextvaltap(index)"
        v-on:input="checkvalue2(index) | checkvalue4(index)"
      ></b-form-input></b-col>
    <b-col> <b-form-input v-model="find.value3" type="number" readonly placeholder="stit3"></b-form-input></b-col>
        <b-col> <b-form-input
        v-model="find.value4"
        placeholder="stit4"
        type="number"
        ref="value4"
        v-on:input="checkvalue4(index)"
      ></b-form-input></b-col>
      
            <b-col><b-form-input v-model="find.value5" type="number" readonly placeholder="stit5"></b-form-input></b-col>

              <b-col> 
 <b-form-select v-model="find.level" :selected="null" class="mb-3" @click="getExplace()">
      <!-- This slot appears above the options from 'options' prop -->
      <template slot="first">
        <option :value="null" disabled>-- เลือกสนามสอบ --</option>
         <option :value="4" >-- ธรรมศึกษาชั้นตรี --</option>
           <option :value="5" >-- ธรรมศึกษาชั้นโท --</option>
             <option :value="6" >-- ธรรมศึกษาชั้นเอก --</option>
               <option :value="1" >-- นักธรรมชั้นตรี --</option>
                 <option :value="2" >-- นักธรรมชั้นโท --</option>
                   <option :value="3" >-- นักธรรมชั้นเอก --</option>
      </template>

      <!-- These options will appear after the ones from 'options' prop -->
    </b-form-select>

        </b-col>
                <b-col>    <button @click="deletestit(index)" class="btn btn-danger btn-block">delete</button></b-col>
  </b-row>
     
    
    
     
     
      
  
    </div>

    <button @click="addFind">new</button>
    <!-- <pre>{{ $data.stit  }}</pre> -->
    </div>
  </div>
</template>

<script>
import auth from '../../api/register';
import store from "../../store/index";
import { mapGetters, mapActions, mapState } from "vuex";
export default {
  data() {
    return {
      //   selected: null,
      selectedExplace: null,
      selectedYear: null,
         
     
      years: [],
      stit: [],
      explaces: []
    };
  },
  methods: {
    addFind: function() {
 
        if(this.stit.length < 6){
            //   console.log(this.stit.length)
      
      this.stit.push({
        value: '',
        value2: 0,
        value3: 0,
        value4:0,
        value5: 0,
        level:null,
      });
        }
      
    },
    deletestit: function(index) {
      this.$delete(this.stit, index);
    },
    checkvalue2(index) {
      // const check1 =  isNaN(parseInt(this.stit[index].value3));
      let checkvalue2 =
        parseInt(this.stit[index].value) - parseInt(this.stit[index].value2);
      // this.form.ticketInvoiceItems[0].total_tax_breakup = calTaxTotal;
      if (isNaN(parseInt(this.stit[index].value))) {
        this.$refs.value[index].focus();
      }
      if (isNaN(parseInt(this.stit[index].value3))) {
      }

      if (checkvalue2 < 0) {
        console.log("กรอกข้อมูลใหม่");
      }

      return (this.stit[index].value3 = checkvalue2);
    },
    checkvalue4(index) {
      let checkvalue4 =
        parseInt(this.stit[index].value3) - parseInt(this.stit[index].value4);
      let checkvalue5 =
        parseInt(this.stit[index].value) - parseInt(this.stit[index].value2);
      // this.form.ticketInvoiceItems[0].total_tax_breakup = calTaxTotal;
      if (checkvalue5 < 0) {
        this.$refs.value2[index].focus();
      } else if (checkvalue4 < 0) {
        console.log("กรอกข้อมูลใหม่");
        // this.stit[index].value4 = ''
        this.$refs.value4[index].focus();
      }

      return (this.stit[index].value5 = checkvalue4);
    },
//เรียงจาก มากไปหาน้อย
nextvaltap(index){
 this.$refs.value4[index].focus();
 this.stit[index].value4 = ''
},
    rageyear(start, end) {
      while (start >= end) {
        this.years.push({ year: start-- });
      }
           
      // return arr;
    },
   
  },

  mounted() {
    this.$store.dispatch("register/getUser");

    let selectedYear = new Date();
    this.selectedYear = selectedYear.getFullYear() + 543; // Sets selectedYear to the today's number of the month
    
    var d = new Date();
    var n = d.getFullYear();
    let start = n + 543;
    let end = 2540;
    this.rageyear(start, end);
    this.$store.dispatch("stitexam/getexplace").then(response => {
      this.explaces = response;
      this.$bar.finish();
    });
         
  },
  computed: {


  }
};
</script>