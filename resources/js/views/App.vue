<template>
<div>
    <header id="menu">
      <ul class="header">
          <li class="logo"><router-link :to="{name: 'home'}"><img src="/images/icon.png" alt="logo"></router-link>
          <li>
            <form onSubmit="" class="input-search">
              <input type="text" name="search" v-model="searchText" @keyup="search()"  placeholder="Nhập từ khóa cần tìm">
              <button type="submit"><i class="fa fa-search"></i></button>
            </form>
          </li>
          <li class="ic"><router-link to="/dashboard"><i class="fa fa-shopping-cart"></i></router-link></li>
          <li class="ic"><router-link to=""><i class="fa fa-bell"></i></router-link></li>
          <li class="ic dropdown"> <i class="fa fa-user dropdown-toggle" data-toggle="dropdown"></i>
            <ul class="dropdown-menu" >
              <router-link :to="{ name: 'login' }" v-if="!isLoggedIn" >Đăng nhập</router-link>
              <router-link :to="{ name: 'register' }" v-if="!isLoggedIn" >Đăng ký</router-link>
              <span v-if="isLoggedIn" >
                  <router-link :to="{ name: 'userboard' }" v-if="user_type == 0"> Xin chào, {{name}}</router-link>
                  <router-link :to="{ name: 'admin' }" v-if="user_type == 1"> Xin chào, {{name}}</router-link>
              </span>
              <li v-if="isLoggedIn" @click="logout"> Đăng xuất</li>
            </ul>
          </li>
       </ul>
    </header>
        <div class="category group flexContain">
            <router-link v-for="(category,index) in categories" :key="index" :to="{name: 'category', params: { id: category.id }}"  ><img :src='category.image'></router-link>
        </div>
        <ul>             
            <li v-for="(product,index) in searchArrs" :key="index">
                <a v-bind:href="product.id"> {{product.name}}</a>
            </li>
      </ul>
        <div class="content">
            <transition name="fade">
                <router-view>
                <div id="category">
                    <category/>
                </div>
                </router-view>
            </transition>
        </div>
        
</div>
</template>

<script>
    export default {
        data() {
            return {
                name: null,
                user_type: 0,
                isLoggedIn: localStorage.getItem('bigStore.jwt') != null,
                searchText: '',
                searchArrs: [],
                categories:[],
            }
        },
        mounted() {
            this.setDefaults();
            this.getCategory();
        },
        methods : {
            setDefaults() {
                if (this.isLoggedIn) {
                    let user = JSON.parse(localStorage.getItem('bigStore.user'))
                    this.name = user.name
                    this.user_type = user.is_admin
                }
            },
            change() {
                this.isLoggedIn = localStorage.getItem('bigStore.jwt') != null
                this.setDefaults()
            },
            logout(){
                localStorage.removeItem('bigStore.jwt')
                localStorage.removeItem('bigStore.user')
                this.change()
                this.$router.push('/')
            },
            getCategory() {
                axios.get('/api/homepage/categories').then(response=> {
                this.categories=response.data;
                })
            },
            search() {
                    axios.post('/api/hompage/search', {
                         name: this.searchText
                    })
                    .then((response) => {
                         this.searchArrs = response.data;
                    });
                }
             }
    }
</script>
<style>
 ::placeholder {
    color: snow;
  }
  /* form */
  .container img{width: 170px;}
  .container{margin-bottom: 30px;}
  .dropdown-menu{display: block !important;}
  /* Header */
  #menu{
      width: 1024px;
      margin: auto;
      background-color: black;
    }
    .shop{
      border: 1px solid snow;
    }
    #menu ul{
      width: 100%;
      display: flex;
      padding: 15px 0 5px 0 ;
      text-align: center;
    }
    #menu ul a{
      color: snow;
      font-weight: bolder;
      font-size: 20px;
      font-family:'Times New Roman', Times, serif ;
    }
    #menu ul li{
      margin: auto;
      list-style-type: none;
    }
    #menu ul .ic .fa-user{
      color: #fbda00;
    }
    #menu ul li a{
     text-decoration: none;
     color: black;
      font-size: 14px;
    }
    form.input-search {
          border: 2px solid #FFD500;
          border-radius: 10px;
          height: 35px;
          width:100%;
          margin-right: 40px;
        }
        form input {
          font-size: 20px;
          font-family:'Times New Roman', Times, serif ;
          color: snow;
          background-color: black;
          float: left;
          padding-left: 15px;
          border-radius: 10px 0 0 10px;
          height: 80%;
          border: none;
          width: 80%;
        }
        .input-search input:focus {
          outline: none;
        }
        .input-search button {
          border-radius: 5px;
          float: right;
          font-size: 21px;
          font-weight: bold;
          padding: 0 10px;
          background: #FFD500;
          width: 50px;
          height:100%;
          border: none;
          cursor: pointer;
        }
        .input-search button:hover {
          color: rgb(238, 10, 10);
        }
        
        header ul li a .fa{
          color: #FFD500;
          font-size: 30px;
          vertical-align: baseline;
        }
  
        .input-search button:hover {
          color: rgb(238, 10, 10);
        }
        .header .logo {
        height: 60px;
        width:10%;
        float: left;
        transition-duration: .1s;
      }
      .header .logo:hover {
        transform: scale(1.05)
      }
      .header .logo img {
        width: 100%;
        height: 100%;
      }
      #menu ul .ic_user {
        float: right;
        transition-duration: .1s;
      }
      /* product */
      /* responsive */
 @media(min-width: 576px) {
  .slideshow,#company, #smartphone .flexContain{
    width: 100%;
    }
   }
   #company{
     margin: 33px auto 20px;
   }
  .content {
     width: 1024px;
     margin: auto;
     background-color: rgb(255, 255, 255)
;
   }
   .content #slideshow {
      width: 100%;
      text-align: center;
      border: 1px solid #757373;
    }
  .content #slideshow img{
      width: 100%;
      padding: 10px;
   }
    /* Category */
    .category {
     top:20%;
      left:20%;
      height: 100%;
	    margin: auto; 
      width: 1024px;
      border-bottom: 1px solid #eee;
      padding: 15px;
      /* position: absolute !important; */

}


.category a {
    border: 2px solid #fff;
    line-height: 40px;
    transition-duration: .2s;
    padding: 10px;
}

.category a:hover {
	border: 2px solid #aaa;
	transform: scale(1.1);
	z-index: 20;
}

.category a img{
    max-height: 30px;
    vertical-align: middle;
    margin-top: -3px;
}
/* product */
    #smartphone {
      width: 100%;
      display: grid;
      grid-template-columns: repeat(5,1fr);
      grid-row-gap: 6px;
      grid-column-gap: 6px;
      text-align: center;
      padding: 15px 15px ;
      font-size: 14px;
      font-family: 'Times New Roman', Times, serif;
    }

    #smartphone .con_pro {
      display: block;
      border: 1px solid #eee;
      width: 196px;
      height: 270px;
    }
    #smartphone .con_pro a{
      color: rgb(5, 5, 5);
    }
    #smartphone .con_pro .card_pro{
      height: 300px;
      width: 100%;
    }
    #smartphone .con_pro .card_pro .img_pro{
        width: 100%;
        height: 183px;
    }
    #smartphone .con_pro .card_pro .img_pro img {
        width: 180px;
        height: 180px;
        transition: all 300ms;
    }
    #smartphone .con_pro .card_pro .img_pro img:hover{
        margin: 15px auto;
    }
    .title_cate{
      background: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%);
      line-height: 1.5em;
      font-size: 1.5em;
      text-align: center;
      color: white;
      transform: translateY(-0.75em);
      margin: 0px auto;
      border-radius: 1em;
    }
    .card_pro .giareonline{
      position: absolute;
      transform: translateX(-13.3em);
      border: 1px solid yellow;
      padding: 4px;
      background-color: #fbda00;
      
    }
    .con_pro a{
      text-decoration: none;
    }
    /* Chuyển trang */
   #company .xemTatCa {
	display: block;
	font-weight: bold;
	text-align: center;
	margin:	0 auto;
	padding: .5em 1em;
  color: #888;
	background-color: #eee;
}
#company .xemTatCa:hover {
	background-color: #ccc;
	color: #000;
}
</style>
