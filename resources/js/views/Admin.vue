<template>
    <div class="admin">
    <div class="sidebar fix">
      <div class ="account">
        <i class="fa fa-user"> Admin</i>
      </div>
      <hr/>
       <li class="nav-title">MENU</li>
    <ul class="nav">
       
        <li class="nav-item"><button class="btn" @click="setComponent('main')"><i class="fa fa-home"></i>Thống kê</button> </li>
        <li class="nav-item"><button class="btn" @click="setComponent('products')"><i class="fa fa-th-large"></i>Sản phẩm</button> </li>
        <li class="nav-item"><button class="btn" @click="setComponent('orders')"><i class="fa fa-file-text-o"></i> Đơn hàng</button></li>
        <li class="nav-item"><button class="btn" @click="setComponent('users')"><i class="fa fa-address-book-o"></i> Khách hàng</button></li>
    </ul>
      
    </div>
     <div  id ="column" >
            <component :is="activeComponent"></component>
        </div>
    </div>
</template>

<script>
    import Main from '../components/admin/Main'
    import Users from '../components/admin/Users'
    import Products from '../components/admin/Products'
    import Orders from '../components/admin/Orders'

    export default {
        data() {
            return {
                user: null,
                activeComponent: null
            }
        },
        components: {
            Main, Users, Products, Orders
        },
        beforeMount() {
            this.setComponent(this.$route.params.page)
            this.user = JSON.parse(localStorage.getItem('bigStore.  d fuser'))
            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('bigStore.jwt')
        },
        methods: {
            setComponent(value) {
                switch(value) {
                    case "users":
                        this.activeComponent = Users
                        this.$router.push({name: 'admin-pages', params: {page: 'users'}})
                        break;
                    case "orders":
                        this.activeComponent = Orders
                        this.$router.push({name: 'admin-pages', params: {page: 'orders'}})
                        break;
                    case "products":
                        this.activeComponent = Products
                        this.$router.push({name: 'admin-pages', params: {page: 'products'}})
                        break;
                    default:
                        this.activeComponent = Main
                        this.$router.push({name: 'admin'})
                        break;
                }
            }
        }
    }
</script>

<style scoped>
    .hero-section { height: 20vh; background: #ababab; align-items: center; margin-bottom: 20px; margin-top: -20px; }
    .title { font-size: 60px; color: #ffffff; }
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
     /* =========== Menu ================= */
     .admin{
         width: 100%;
     }
     #column{
         width: 55%;
         margin: auto;
         margin-left: 22%;
     }
      .sidebar {
        float: left;
        width:17%;
        max-height: 100%;
        background-color:#e4e7ea;
        height: 100%;
        

      }
      .sidebar.fix {
        margin:auto;
        left: 15%;
        max-height: 100%;       
        position: fixed !important;
        overflow: visible;
        /* top: 2%; */
        width: 15%;
        height: 100%;
        z-index: 1000;
      }
      .sidebar .account{
        background-color:#e4e7ea;
        font-size:30px;
        margin-top:30px;
         margin-bottom:30px;
        margin-left:50px;
      }
      .sidebar li{
        list-style-type: none;
      }
      .sidebar .nav{
          display:list-item;
      }
      .sidebar .nav-title {
          padding: 1.1rem 1rem;
          font-size: 1.5em;
          font-weight: 700;
          color: black;
        text-align: center;
          text-transform: uppercase;
         
      }

      .sidebar .nav-item {
          position: relative;
        
          transition: background .3s ease-in-out;
      }

      .sidebar .btn {
          display: block;
          padding: 1em 1em;
          color: #73818f;
          text-decoration: none;
          background: 0 0;
          cursor: pointer;
          width:200px;
          margin-left:15px;
      }

      .sidebar .btn.active,
      .sidebar .btn.active i {
          background-color: #20a8d8;
          color: #fff;
      }

      .sidebar .btn:hover:not(.active),
      .sidebar .btn:hover:not(.active) i {
          background-color: #4a7b8d;
          color: #fff;
      }

      .sidebar .btn i {
          display: inline-block;
          width: 1.09375em;
          margin: 0 .5rem 0 0;
          font-size: 1em;
          color: #73818f;
          text-align: center;
      }
</style>