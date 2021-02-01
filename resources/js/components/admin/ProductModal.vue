<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container">
                <div class="modal-header">
                    <slot name="header" v-html="data.name"></slot>
                </div>
                <div class="modal-body">
                    <slot name="body">
                        <select class="select_categories" name="category_id" v-model="data.category_id">
                             <option   v-for="(cate,index) in categories" :key="index"  v-bind:value="cate.id">{{cate.name}}</option>
                        </select>
                        <p>Tên: <input class="input1" type="text" v-model="data.name"></p>
                        <p>Số lượng: <input class="sl" type="text" v-model="data.units"></p>
                        <p>Giá: <input class="input1" type="text" v-model="data.price"></p>
                        <textarea v-model="data.description" placeholder="Mô tả"></textarea>
                        <span >
                            <img :src="data.image" v-show="data.image != null">
                            <input type="file" id="file" @change="attachFile">
                        </span>
                    </slot>
                </div>
                <div class="modal-footer">
                    <slot name="footer">
                        <button class="modal-default-button" @click="uploadFile">
                            Hoàn thành
                        </button>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['product'],
        data() {
            return {
                attachment: null,
                categories:[]
            }
        },
        computed: {
            data: function() {
                if (this.product != null) {
                    return this.product
                }
                return {
                    name: "",
                    category_id: "",
                    units: "",
                    price: "",
                    description: "",
                    image: false
                }
            },
        },
        methods: {
            attachFile(event) {
                this.attachment = event.target.files[0];
            },
            getCategories(){
                axios.get('/api/categories').then(response=> {
                this.categories=response.data;
                })
            },
            uploadFile(event) {
                console.log(this.category_id)
                if (this.attachment != null) {
                    var formData = new FormData();
                    formData.append("image", this.attachment)
                    let headers = {'Content-Type': 'multipart/form-data'}
                    axios.post("/api/upload-file", formData, {headers}).then(response => {
                        this.product.image = response.data
                        this.$emit('close', this.product)
                    })
                } else {
                    this.$emit('close', this.product)
                }
            }
        },
        mounted(){
            this.getCategories();
        }
    }
</script>

<style scoped>
    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }
    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }
    .modal-container {
        width: 400px;
        margin: 0px auto;
        padding: 20px 30px;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
        transition: all .3s ease;
        font-family: Helvetica, Arial, sans-serif;
    }
    .modal-header h3 {
        margin-top: 0;
        color: #42b983;
    }
    .modal-body {
        margin: 20px 0;
    }
    .modal-default-button {
        float: right;
    }
    .modal-enter {
        opacity: 0;
    }
    .modal-leave-active {
        opacity: 0;
    }
    .input1{
        width:180px;
        margin-bottom: 10px;
        margin-left:38px;
        height:40px;
        border-radius:3px;
    }
    .sl{
        width:180px;
        margin-bottom: 10px;
        height:40px;
        border-radius:3px;
    }
    textarea{
        width:250px;
        margin-left: 15px;
        margin-bottom: 20px;
    }
    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
</style>