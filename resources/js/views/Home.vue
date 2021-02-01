<template>
<div class="content">
      <div class="slideshow" id='slideshow'>
        <transition-group name="fade" tag="div">
        <div v-for="i in [currentIndex]" :key="i">
            <img  :src="currentImg" id="ima" width="832" height="350">
        </div>
        </transition-group>
    </div>
    <img src="/banners/blackFriday.gif" style="width: 100%;">
    <div class="co">
        <div id="company" >
        <div id="smartphone" >
            <div class="con_pro"  v-for="(product,index) in products" :key="index">
             <router-link :to="{ path: '/products/'+product.id}">
                <div class="card_pro">
                    <div class="img_pro">
                    <img :src='product.image' id="img" alt="image">
                    <label class="giareonline">Trả góp 0%</label>
                    </div>
                    <h4 id="title">{{product.name}}</h4>
                    <span id="des">{{product.price}}đ</span>
                     <button >Xem chi tiết</button>
                </div>
            </router-link>
            </div>
        </div>
     </div> 
    </div>
  </div>
</template>
<script>
    export default {
        name: 'Home',
        data(){
            return {
                products : [],
                 images:["/banners/banner0.gif", 
                  "/banners/banner1.png",
                  "/banners/banner2.png",
                  "/banners/banner3.png",
                  "/banners/banner4.png",
                  "/banners/banner5.png",
                  "/banners/banner6.png",
                  "/banners/banner7.png",
                  "/banners/banner8.png",
                  "/banners/banner9.png",],
                timer: null,
                currentIndex: 0
            }
        },
    methods: {
      slideshow: function(){           
        this.timer = setInterval(this.next, 5000);
        }
     },
       mounted(){
        this.slideshow();
      },
    computed:{
      currentImg: function() {
      return this.images[Math.abs(this.currentIndex) % this.images.length];
      },
    },
        mounted(){
            axios.get("api/products/").then(response => this.products = response.data)      
        }
    }
</script>

<style scoped>
    .small-text {
        font-size: 14px;
    }
    .product-box {
        border: 1px solid #cccccc;
        padding: 10px 15px;
    }
    .hero-section {
        height: 30vh;
        background: #ababab;
        align-items: center;
        margin-bottom: 20px;
        margin-top: -20px;
    }
    .title {
        font-size: 60px;
        color: #ffffff;
    }
    </style>