<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Order Details</h3>
                    <div class="">
                        <router-link to="/order" class="btn btn-danger">
                            <i class="fa fa-arrow-circle-left"></i>
                            Back to List
                        </router-link>
                        
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Customer Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Avatar</th>
                                            <th>
                                                <img :src="order.customer.avatar != 'default.png' ? '/backend/customer/'+order.customer.avatar:'https://via.placeholder.com/240.png'" alt="" width="50px" height="50px">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Name</th>
                                            <th>{{order.customer.name}}</th>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <th>{{order.customer.email}}</th>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <th>{{order.customer.phone}}</th>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <th>{{order.customer.address}}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Order Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Quantity</th>
                                            <th>{{order.qty}}</th>
                                        </tr>
                                        <tr>
                                            <th>Sub Total</th>
                                            <th>{{order.sub_total}}</th>
                                        </tr>
                                        <tr>
                                            <th>Vat</th>
                                            <th>{{order.vat}}%</th>
                                        </tr>
                                        <tr>
                                            <th>Total Amount</th>
                                            <th>{{order.total}}</th>
                                        </tr>
                                        <tr>
                                            <th>Pay Amount</th>
                                            <th>{{order.pay}}</th>
                                        </tr>
                                        <tr>
                                            <th>Due Amount</th>
                                            <th>{{order.due}}</th>
                                        </tr>
                                        <tr>
                                            <th>Pay By</th>
                                            <th>{{order.pay_by}}</th>
                                        </tr>
                                        <tr>
                                            <th>Date</th>
                                            <th>{{order.date}}</th>
                                        </tr>
                                        <tr>
                                            <th>Month</th>
                                            <th>{{order.month}}</th>
                                        </tr>
                                        <tr>
                                            <th>Year</th>
                                            <th>{{order.year}}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Order Details Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped mb-2">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-show="order.order_details.length" v-for="(order_detail, index) in order.order_details" :key="order_detail.id">
                                            <td>{{index + 1}}</td>
                                            <td>{{order_detail.product.name}}</td>
                                            <td>{{order_detail.product.code}}</td>
                                            <td>
                                                <img :src="order_detail.product.image != 'default.png' ? '/backend/product/'+order_detail.product.image:'https://via.placeholder.com/240.png'" alt="" width="50px" height="50px"> 
                                            </td>
                                            <td>{{order_detail.qty}}</td>
                                            <td>{{order_detail.price}}</td>
                                            <td>{{order_detail.sub_total}}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" @click="destroy(order_detail.id)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <tr v-show="!order.order_details.length">
                                            <td colspan="9">
                                                <div class="alert alert-danger" role="alert">
                                                    Sorry :( No data found
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Image</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div><!-- /.container-fluid -->

        </section>
        <!-- /.content -->
        
    </div>
</template>

<script>
export default {
    created() {
        this.$Progress.start()
        if(!User.loggedIn()) {
            this.$router.push({ name: '/' })
        }
        this.getData()
        this.$Progress.finish()
    },
    data() {
        return {
            order: []
        }
    },
    methods: {
        getData() {
            let id = this.$route.params.id
            axios.get('/api/order/'+id)
                .then(response => {
                    console.log(response);
                    this.order = response.data.data
                })
                .catch(e => {
                    // this.$router.push({ name: 'order' })
                    this.$snotify.warning('Sorry! Something Wrong', 'Warning')
                })
        }
    }
}
</script>

<style scoped>
    
</style>