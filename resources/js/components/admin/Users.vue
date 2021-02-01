<template>
    <div>
        <table id="user">
            <tr>
                <th>STT</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Đã tham gia</th>
                <th>Tổng Đơn Hàng</th>
            </tr>
            <tr v-for="(user,index) in users" :key="index">
                <td>{{index+1}}</td>
                <td>{{user.name}}</td>
                <td>{{user.email}}</td>
                <td>{{user.created_at}}</td>
                <td>{{user.orders.length}}</td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                users : []
            }
        },
        beforeMount() {
            axios.get('/api/users/').then(response => this.users = response.data)
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
        #user {
        /* color:white ; */
        /* background-color:black; */
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      #user td, #user th {
        border: 1px solid #ddd;
        padding: 8px;
      }
      #user tr:nth-child(even){background-color: #f2f2f2;}

      #user tr:hover {background-color: #ddd;}

      #user th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #3ca840;
        color: white;
      }
</style>
