<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Customer</h3>
                    <div class="">
                        <router-link :to="{name: 'customer/edit', params:{id: this.$route.params.id}}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit
                        </router-link>
                        <router-link to="/customer" class="btn btn-danger">
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
                                                    <img :src="customer.avatar != 'default.png' ? '/backend/customer/'+customer.avatar:'https://via.placeholder.com/240.png'" alt="" width="50px" height="50px">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Name</th>
                                                <th>{{customer.name}}</th>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <th>{{customer.email}}</th>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <th>{{customer.phone}}</th>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <th>{{customer.address}}</th>
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
    created() {
        this.$Progress.start()
        if(!User.loggedIn()) {
            this.$router.push({ name: '/' })
        }
        
        let id = this.$route.params.id
        axios.get('/api/customer/'+id)
            .then(response => {
                this.customer = response.data.data
            })
            .catch(e => {
                this.$router.push({ name: 'customer' })
                this.$snotify.warning('404 Not Found!!', 'Warning')
            })
        this.$Progress.finish()
        
    },
    data() {
        return {
            customer: {}
        }
    }
}
</script>

<style scoped>
    
</style>