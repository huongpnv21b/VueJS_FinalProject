<template>
  <div>
     <div id="company" >
      <div id="smartphone" >
        <div class="con_pro" id="id" v-for="(cate,index) in categories" :key="index">
          <router-link :to="{ path: '/categories/'+cate.id}">
                <div class="card_pro">
                    <div class="img_pro">
                    <img :src='cate.image' id="img" alt="image">
                    <label class="giareonline">Trả góp 0%</label>
                    </div>
                    <h4 id="title">{{cate.name}}</h4>
                    <span id="des">{{cate.price}}đ</span>
                     <button >Xem chi tiết</button>
                </div>
            </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
  export default {
    name:'Category',
    data () {
      return {
        categories:[],
      }
    },
    methods:{
      getCategory(id){
        let url = `/api/category/${id}`;
        axios.get(url).then(response=> {
          this.categories=response.data;
        });
      }
    },
  mounted(){
    var id = this.$route.params.id;
    this.getCategory(id);
  }
  }
</script>

<style>
   
</style>
