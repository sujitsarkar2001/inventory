<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Employee</h3>
                    <div class="">
                        <router-link :to="{name: 'employee/edit', params:{id: this.$route.params.id}}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit
                        </router-link>
                        <router-link to="/employee" class="btn btn-danger">
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
                                <h3 class="card-title">Employee Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Name</th>
                                                <th>{{employee.name}}</th>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <th>{{employee.email}}</th>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <th>{{employee.phone}}</th>
                                            </tr>
                                            <tr>
                                                <th>Salary</th>
                                                <th>{{employee.salary}}</th>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <th>{{employee.address}}</th>
                                            </tr>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>
                                                    <img :src="'/backend/employee/'+employee.avatar" alt="" width="50px" height="50px">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>NID Number</th>
                                                <th>{{employee.nid}}</th>
                                            </tr>
                                            <tr>
                                                <th>Joining Date</th>
                                                <th>{{employee.joining_date}}</th>
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
        axios.get('/api/employee/'+id)
            .then(response => {
                this.employee = response.data.data
            })
            .catch(e => {
                this.$router.push({ name: 'employee' })
                this.$snotify.warning('Sorry! Something Wrong', 'Warning')
            })
        this.$Progress.finish()
        
    },
    data() {
        return {
            employee: {}
        }
    }
}
</script>

<style scoped>
    
</style>