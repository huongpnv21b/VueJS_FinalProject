 <template>
    <div class="static">
        <div class="Orders">

            <a href='/admin/orders'>Đơn Hàng ({{orders.length}})</a>
              <i class="fa fa-th-list"></i>
        </div>
        <hr>
        <div class="Products">
            <a href='/admin/products'>Sản Phẩm ({{products.length}})</a>
              <i class="fa fa-mobile"></i>
        </div>
       <div class="Users">
            <a href='/admin/users'>Khách Hàng ({{users.length}})</a>
            <i class="fa fa-users"></i>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                user : null,
                orders : [],
                products : [],
                users : []
            }
        },
        mounted() {
            axios.get('/api/users/').then(response => this.users = response.data)
            axios.get('/api/products/').then(response => this.products = response.data)
            axios.get('/api/orders/').then(response => this.orders = response.data)
        }
    }
</script>

<style scoped>
    .static{
        height:100%;
        width:80%;
        display:flex;
    }
     .Users{
         font-size: 22px;
        background-color:rgb(3, 233, 250) ;
        border-radius:20px;
        width:200px;
        height:150px;
        margin-right:70px;
        display:flex;
    }
    .Users a{  
        width:180px;
         margin-left: 45px;
        margin-top: 50px;
    }
    .Users i{
         margin-top: 50px;
        font-size:57px;
        position :center;
        margin-left:70px; 
    }
    .Products{
         font-size: 22px;
        border-radius:20px;
        width:200px;
        height:150px;
        margin-right:70px;
        display:flex;
        background-color:hsl(56, 100%, 50%) ;
    }
    .Products a{   
        width:180px;
        margin-left: 80px;
        margin-top: 50px;
    }
    .Products i{
         margin-top: 40px;
        font-size:90px;
        position :center;
        margin-left:50px; 
    }
    .Orders{
         font-size: 22px;
        background-color:#f85353 ;
        border-radius:20px;
        width:200px;
        height:150px;
        margin-right:100px;
        display:flex;
    }
    .Orders a{   
        width:180px;
         margin-left: 90px;
        margin-top: 50px;
    }
    .Orders i{
         margin-top: 50px;
        font-size:57px;
        position :center;
        margin-left:20px; 
    }
</style>