<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Salary</h3>
                    <div class="">
                        <router-link :to="{name: 'salary/edit', params:{id: this.$route.params.id}}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                            Edit
                        </router-link>
                        <router-link to="/salary" class="btn btn-danger">
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
                                <h3 class="card-title">Salary Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <tbody>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>
                                                    <img :src="'/backend/employee/'+salary.employee.avatar" alt="" width="50px" height="50px">
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>{{salary.employee.name}}</th>
                                            </tr>
                                            <tr>
                                                <th>Email</th>
                                                <th>{{salary.employee.email}}</th>
                                            </tr>
                                            <tr>
                                                <th>Phone</th>
                                                <th>{{salary.employee.phone}}</th>
                                            </tr>
                                            <tr>
                                                <th>Salary</th>
                                                <th>{{salary.employee.salary}}</th>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <th>{{salary.employee.address}}</th>
                                            </tr>
                                            
                                            <tr>
                                                <th>NID Number</th>
                                                <th>{{salary.employee.nid}}</th>
                                            </tr>
                                            <tr>
                                                <th>Joining Date</th>
                                                <th>{{salary.employee.joining_date}}</th>
                                            </tr>
                                            <tr>
                                                <th>Amount</th>
                                                <th>{{salary.amount}}</th>
                                            </tr>
                                            <tr>
                                                <th>Date</th>
                                                <th>{{salary.date}}</th>
                                            </tr>
                                            <tr>
                                                <th>Month</th>
                                                <th>{{salary.month}}</th>
                                            </tr>
                                            <tr>
                                                <th>Year</th>
                                                <th>{{salary.year}}</th>
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
        axios.get('/api/salary/'+id)
            .then(response => {
                this.salary = response.data.data
            })
            .catch(e => {
                this.$router.push({ name: 'salary' })
                this.$snotify.warning('Sorry! Something Wrong', 'Warning')
            })
        this.$Progress.finish()
        
    },
    data() {
        return {
            salary: {}
        }
    }
}
</script>

<style scoped>
    
</style>