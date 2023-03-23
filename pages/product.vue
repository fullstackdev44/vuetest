<template>
    
    
<div id="app"><div>
   Search By Name: <input type="text" v-model="searchValue" placeholder="Search Name" id="search-input"/>
   Search By  Family Name: <input type="text" v-model="Family" placeholder="Search Family Name" id="search-input"/>

  </div>
   
    <div >
        <b-container class="bv-example-row">
  <b-row cols="3">
    <div v-for="item in filteredproduct">
  <b-card>
    <b-card-text>
     <h3>{{ item.name }}</h3>
     <p>family:{{item.family}}<br>
    </p> 
    </b-card-text>
    <div v-if="item.favorite==0"> <button variant="outline-primary"  v-on:click="greet(item.id)">Greet</button></div>
   <div v-else="item.favorite==1">added </div>
  </b-card>
</div>
</b-row>
</b-container>

    </div>
<vs-pagination :total-pages=totalPagesdata  @change="changePage"></vs-pagination>
</div>

</template>
<script >
import VsPagination from "@vuesimple/vs-pagination";
import axios from "axios";
export default{
    components: {
    VsPagination,
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
        .then(res=>console.log(res.data))
         refreshNuxtData()
       
           
        }
        

      return tempproduct
  }}

  };
     
 




</script>