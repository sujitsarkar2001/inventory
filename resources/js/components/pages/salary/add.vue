<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Salary</h3>
                    <div class="">
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
                                <h3 class="card-title">Pay Salary</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form @submit.prevent="store" @keydown="form.onKeydown($event)">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                                            <select class="form-control select2" @change="employeeDetails()" v-model="form.name"
                                            :class="{ 'is-invalid': form.errors.has('name') }">
                                                <option value="">Select Emplyee Name</option>
                                                <option v-for="(employee, index) in employees" :key="index" :value="employee.id">{{employee.name}}</option>
                                            </select>
                                            <has-error :form="form" field="name" class="d-block"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email address</label>
                                            <input readonly type="email" class="form-control" id="email" placeholder="Email Address" v-model="employee.email">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone</label>
                                            <input readonly type="text" class="form-control" id="phone" placeholder="Phone number" v-model="employee.phone">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="salary">Salary</label>
                                            <input readonly type="number" class="form-control" id="salary" placeholder="Salary" v-model="employee.salary">
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="month">Month</label>
                                            <select class="form-control" id="month" v-model="form.month"
                                            :class="{ 'is-invalid': form.errors.has('month') }">
                                                <option value="">Select Month</option>
                                                <option value="January">January</option>
                                                <option value="February">February</option>
                                                <option value="March">March</option>
                                                <option value="April">April</option>
                                                <option value="May">May</option>
                                                <option value="Jun">Jun</option>
                                                <option value="July">July</option>
                                                <option value="August">August</option>
                                                <option value="September">September</option>
                                                <option value="October">October</option>
                                                <option value="November">November</option>
                                                <option value="December">December</option>
                                            </select>
                                            <has-error :form="form" field="month"></has-error>
                                        </div>

                                        <div class="form-group col-md-6">
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" :disabled="form.busy" class="btn btn-primary">
                                        <i class="fas fa-plus-circle"></i>
                                        Submit
                                    </button>
                                </div>
                            </form>
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
        this.$Progress.finish()
    },
    data() {
        return {
            form: new Form({
                name: '',
                month: ''
            }),
            employees: [],
            employee: []
        }
    },
    methods: {
        store() {
            this.$Progress.start()
            this.form.busy = true
            this.form.post('/api/salary')
                .then(response => {
                    if (this.form.successful) {
                        
                        if (response.data.alert == 'Warning') {
                            this.$snotify.warning(response.data.message, response.data.alert)
                        } else {
                            this.$router.push({ name: 'salary' })

                            this.$snotify.success(response.data.message, response.data.alert)
                        }
                        this.$Progress.finish()
                        
                    } else {
                        this.$Progress.fail()
                        this.$snotify.error('Something Wrong!!', 'Wrong')
                    }
                    
                })
                .catch(e => {
                    if (e.response.data.error) {
                        this.$snotify.error(e.response.data.error, 'Wrong')
                    }
                    this.$Progress.fail()
                    
                })
                
        },
        employeeDetails() {
            this.$Progress.start()
            let id = this.form.name;
            axios.get('/api/employee/'+id)
            .then(response => {
                this.employee = response.data.data
                this.$Progress.finish()
            })
            .catch(e => {
                this.$Progress.fail()
            })
        }
    },
    created() {
        axios.get('/api/allEmployee')
            .then(response => {
                this.employees = response.data
            })
            .catch(e => console.log(e))
    },
}
</script>

<style scoped>
    
</style>