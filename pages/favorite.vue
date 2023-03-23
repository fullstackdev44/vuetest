<template>
<div >
        <b-container class="bv-example-row">
          <my-header></my-header>
  <b-row cols="3">
    <div v-for="item in filteredproduct">
  <b-card>
    <b-card-text>
     <h3>{{ item.name }}</h3>
     <p>family:{{item.family}}<br>
    </p>
    <p>Total Nutritions : {{ (parseFloat(item.carbohydrates)+parseFloat(item.protein)+parseFloat(item.fat)+parseFloat(item.calories)+parseFloat(item.sugar)).toFixed(2) }}<br>
    </p>
    </b-card-text>
    
    <button variant="outline-primary"  v-on:click="greet(item.id)">remove favorites</button>
  </b-card>
</div>
</b-row>
</b-container>
    </div>
</template>
<script>
import axios from "axios";
import header from '../components/Header'
import footer from '../components/Footer'
export default{
data(){
    return{
        product:'',
        dataset:'',
    }
},
components: {
    'myHeader': header
  },
created() {
  this.product = this.product
}
,
methods: {
    greet: function(id) {
      // `event` is the native DOM event
 this.dataset = id
    }
  }
,
async fetch(){
        this.product = await this.$axios.$get(process.env.baseUrl+'/fruits/getfavorites')
       
    },
    computed: {
    filteredproduct() {
      let tempproduct = this.product
  
    
      if (this.dataset != '') {
        let id =this.dataset
        axios.post(process.env.baseUrl+"/fruits/addfavorites",{id:id,favorite:0})
        .then(res=>{
          if(res.data.data == "Done"){
            this.$router.push('/');
          }else{
            this.msg = res.data.data;
          }
        })
       
            return tempproduct
        }
        

      return tempproduct
  }}


}

</script>
