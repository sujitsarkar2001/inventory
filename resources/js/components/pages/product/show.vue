<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Product</h3>
                    <div class="">
                        <router-link :to="{name: 'product/edit', params:{id: this.$route.params.id}}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit
                        </router-link>
                        <router-link to="/product" class="btn btn-danger">
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
                    <div class="col-sm-10 offset-sm-1">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Product Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Category</th>
                                                <th>{{product.category.name}}</th>
                                            </tr>
                                            <tr>
                                                <th>Supplier</th>
                                                <th>{{product.supplier.name}}</th>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <th>{{product.name}}</th>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <th>{{product.code}}</th>
                                            </tr>
                                            <tr>
                                                <th>Root</th>
                                                <th>{{product.root}}</th>
                                            </tr>
                                            <tr>
                                                <th>Quantity</th>
                                                <th>{{product.qty}}</th>
                                            </tr>
                                            <tr>
                                                <th>Buying Price</th>
                                                <th>{{product.buying_price}}</th>
                                            </tr>
                                            <tr>
                                                <th>Selling Price</th>
                                                <th>{{product.selling_price}}</th>
                                            </tr>
                                            <tr>
                                                <th>Buy Date</th>
                                                <th>{{product.buy_date}}</th>
                                            </tr>
                                            <tr>
                                                <th>Image</th>
                                                <th>
                                                    <img :src="'/backend/product/'+product.image" alt="" width="50px" height="50px">
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    
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
    mounted() {
        this.$Progress.start()
        if(!User.loggedIn()) {
            this.$router.push({ name: '/' })
        }
        
    },
    data() {
        return {
            product: []
        }
    },
    created() {
        let id = this.$route.params.id
        axios.get('/api/product/'+id)
            .then(response => {
                this.product = response.data.data
            })
            .catch(e => {
                this.$router.push({ name: 'product' })
                this.$snotify.warning('Sorry! Something Wrong', 'Warning')
            })
        this.$Progress.finish()
        
    }
}
</script>

<style scoped>
    
</style>