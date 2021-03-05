<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Supplier</h3>
                    <div class="">
                        <router-link :to="{name: 'supplier/edit', params:{id: this.$route.params.id}}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit
                        </router-link>
                        <router-link to="/supplier" class="btn btn-danger">
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
                                <h3 class="card-title">Supplier Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th>{{supplier.name}}</th>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <th>{{supplier.email}}</th>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <th>{{supplier.phone}}</th>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <th>{{supplier.address}}</th>
                                            </tr>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>
                                                    <img :src="'/backend/supplier/'+supplier.avatar" alt="" width="50px" height="50px">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Shop Name</th>
                                                <th>{{supplier.shop_name}}</th>
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
        axios.get('/api/supplier/'+id)
            .then(response => {
                this.supplier = response.data.data
            })
            .catch(e => {
                this.$router.push({ name: 'supplier' })
                this.$snotify.warning('Sorry! Something Wrong', 'Warning')
            })
        this.$Progress.finish()
        
    },
    data() {
        return {
            supplier: {}
        }
    }
}
</script>

<style scoped>
    
</style>