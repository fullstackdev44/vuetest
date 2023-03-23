<template>
    
    <b-container class="bv-example-row">
      <my-header></my-header>
<div id="app"><div>
  <div class="filter">
   Search By Name: <input type="text" v-model="searchValue" placeholder="Search Name" id="search-input"/>
   Search By  Family Name: <input type="text" v-model="Family" placeholder="Search Family Name" id="search-input"/>
  </div>
</div>
    <div >
      <div v-if="msg != null">
      <b-alert show variant="danger">{{ msg }}</b-alert>
    </div>
        
          
  <b-row cols="3">
    <div v-for="item in filteredproduct">
  <b-card>
    <b-card-text>
     <h3>{{ item.name }}</h3>
     <p>family:{{item.family}}<br>
    </p> 
    </b-card-text>
    <div v-if="item.favorite==0 || item.favorite == null"> <button variant="outline-primary"  v-on:click="greet(item.id)">add favorite</button></div>
   <div v-else="item.favorite==1">added </div>
  </b-card>
</div>
</b-row>


    </div>
<vs-pagination :total-pages=totalPagesdata  @change="changePage"></vs-pagination>
</div>
</b-container>
</template>
<script >
import VsPagination from "@vuesimple/vs-pagination";
import axios from "axios";
import header from '../components/Header'
import footer from '../components/Footer'
export default{
    components: {
    VsPagination,
    'myHeader': header
  },
    async fetch(){
        this.product = await this.$axios.$get(process.env.baseUrl+'/fruits')
        this.totalPagesdata=this.product.length/10
    },
    data() {
      return {
        ascending: true,
        sortBy: 'alphabetically',
        searchValue: '',
        Family:'',
        totalPagesdata:'',
        currentPage:'',
        dataset:'',
        maxCookingTime: null,
        msg:null,
        product: [],
      };
    },  
    methods: {
    changePage(page) {
      
      this.currentPage = page;
    }, 
    greet: function(id) {
      // `event` is the native DOM event
 this.dataset = id
    }
  },
    computed: {
    filteredproduct() {
      let tempproduct = this.product
  
      // Process search input
      if (this.searchValue != '') {
          tempproduct = tempproduct.filter((item) => {
            return item.name.toUpperCase()
              .match(this.searchValue.toUpperCase())
          })
          
        }
      if (this.Family != '') {
          tempproduct = tempproduct.filter((item) => {
            return item.family.toUpperCase()
              .match(this.Family.toUpperCase())
          })
          
        }
      if (this.currentPage != '') {
        
          tempproduct = tempproduct.slice(0,this.currentPage?this.currentPage*10:10).filter((item) => {
            return item.name
              
          })
          
        }
      if (this.currentPage == '') {
        
          tempproduct = tempproduct.slice(0,this.currentPage?this.currentPage*10:10).filter((item) => {
            return item.name
              
          })
          
        }
      if (this.dataset != '') {
        let id =this.dataset
        axios.post(process.env.baseUrl+"/fruits/addfavorites",{id:id,favorite:1})
        .then(res=>{
          if(res.data.data == "Done"){
            this.$router.push('/favorite');
          }else{
            this.msg = res.data.data;
          }
        })
          
        }
      return tempproduct
  }},
  

  };
     
 




</script>