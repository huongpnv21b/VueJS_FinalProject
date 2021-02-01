 <template>
    <div>
        <table id="products">
            
                <tr>
                    <th></th>
                    <th>Sản Phẩm</th>
                    <th> Loai </th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Mô tả sản phẩm</th>
                    <th>Khác</th>
                </tr>
            
                <tr v-for="(product,index) in products" :key="index" @dblclick="editingItem = product">
                    <td>{{index+1}}</td>
                    <td v-html="product.name"></td>
                    <td>
                     <div v-for="cate in categories" :key="cate.id" > 
                        <div v-if="cate.id===product.category_id">
                           <h6 v-html="product.category_id"> {{cate.name}}</h6>                 
                        </div>
                    </div>
                    </td>
                    <td ><input type="text" v-model="product.units" ></td>
                    <td ><input type="text" v-model="product.price"></td>
                    <td ><input type="text" v-model="product.description"></td>
                    <td>
                        <form action='' method="POST">
                            <button class="buttonDelete" type="submit" @click.prevent="deleteProduct(index+1)"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
          
        </table>
        <modal @close="endEditing" :product="editingItem" v-show="editingItem != null"></modal>
        <modal @close="addProduct"  :product="addingProduct" v-show="addingProduct != null"></modal>
        <br>
        <button class="btn btn-primary" @click="newProduct">Thêm sản phẩm mới</button>
    </div>
    
</template>


<script>
    import Modal from './ProductModal'

    export default {
        data() {
            return {
                categories:[],
                products: [],
                editingItem: null,
                addingProduct: null
            }
        },
        components: {Modal},
        beforeMount() {
            axios.get('/api/products/').then(response => this.products = response.data),
            axios.get('/api/categories/').then(response => this.categories = response.data)
        },
        methods: {
            newProduct() {
                this.addingProduct = {
                    name: null,
                    category_id: null,
                    units: null,
                    price: null,
                    image: null,
                    description: null,
                }
            },
             getCategories(){
                axios.get('/api/categories').then(response=> {
                this.categories=response.data;
                })
            },
            endEditing(product) {
                this.editingItem = null

                let index = this.products.indexOf(product)
                let name = product.name
                let category_id =product.category_id
                let units = product.units
                let price = product.price
                let description = product.description

                axios.put(`/api/products/${product.id}`, {name,category_id, units, price, description})
                     .then(response => this.products[index] = product)
            },
            addProduct(product) {
                this.addingProduct = null

                let name = product.name
                let category_id = product.category_id
                let units = product.units
                let price = product.price
                let description = product.description
                let image = product.image 

                axios.post("/api/products/", {name,category_id, units, price, description, image})
                     .then(response => this.products.push(product))
            },
            deleteProduct(id) {
            // No done
            axios.delete("/api/admin/"+id+"/deleteProduct");
            console.log(id);
            },
        }
    }
</script>
<style>
        table,tr,th{
          border: 1px solid;
        }
        img{
          width:100px;
        }
        table{
          width:100%;
          
        }
        #products {
        /* color:white ; */
        /* background-color:black; */
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      #products td, #products th {
        border: 1px solid #ddd;
        padding: 8px;
      }

      #products tr:nth-child(even){background-color: #f2f2f2;}

      #products tr:hover {background-color: #ddd;}

      #products th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
      }
</style>
