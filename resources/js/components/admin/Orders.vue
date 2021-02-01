 <template>
    <div>
      <table id="user">
        <tr>
            <th>STT</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Địa chỉ giao hàng</th>
            <th>Đã được phân phối?</th>
            <th>Khác</th>
        </tr>
        <tr v-for="(order,index) in orders" :key="index">
            <td>{{index+1}}</td>
            
            <td v-html="order.product.name"></td>
            <td>{{order.quantity}}</td>
        
            <td>{{order.quantity * order.product.price}}</td>
            <td>{{order.address}}</td>
            <td>{{order.is_delivered == 1? "Yes" : "No"}}</td>
            <td v-if="order.is_delivered == 0"><button class="btn btn-success" @click="deliver(index)">Giao hàng</button></td>
        </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                orders : [],
                products : []
            }
        },
        beforeMount(){
            axios.get('/api/orders/').then(response => this.orders = response.data),
            axios.get('/api/products/').then(response => this.products = response.data)
        },
        methods: {
            deliver(index) {
                let order = this.orders[index]
                axios.patch(`/api/orders/${order.id}/deliver`).then(response => {
                    this.orders[index].is_delivered = 1
                    this.$forceUpdate()
                })
            },
            getProduct(){
                axios.get('/api/products/').then(response=> {
                this.products=response.data;
                })
            },
        },
        mounted(){
            this.getProduct();
        }
    }
</script>