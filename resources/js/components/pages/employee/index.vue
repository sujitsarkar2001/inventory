<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Employee</h3>
                    <div class="">
                        <router-link :to="{name: 'employee/create'}" class="btn btn-info">
                            <i class="fas fa-plus-circle"></i>
                            Create Employee
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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="input-group input-group-md">
                                                <select class="form-control form-control-md">
                                                    <option value="10">10</option>
                                                    <option value="15">15</option>
                                                    <option value="20">20</option>
                                                    <option value="25">25</option>
                                                    <option value="30">30</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="500">500</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 off">
                                        <div class="form-group">
                                            <div class="input-group input-group-md">
                                                <input type="search" class="form-control form-control-md" v-model="query" placeholder="Type your keywords here" value="Lorem ipsum">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-md btn-default">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped mb-2">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Salary</th>
                                            <th>Join</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-show="employees.length" v-for="(employee, index) in employees" :key="employee.id">
                                            <td>{{index + 1}}</td>
                                            <td>
                                                <img :src="employee.avatar != 'default.png' ? '/backend/employee/'+employee.avatar:'https://via.placeholder.com/240.png'" alt="" width="50px" height="50px">
                                            </td>
                                            <td>{{employee.name}}</td>
                                            <td>{{employee.phone}}</td>
                                            <td>{{employee.email}}</td>
                                            <td>{{employee.salary}}</td>
                                            <td>{{employee.joining_date}}</td>
                                            <td>
                                                <router-link :to="{name: 'employee/show', params:{id: employee.id}}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </router-link>
                                                <router-link :to="{name: 'employee/edit', params:{id: employee.id}}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </router-link>
                                                <button class="btn btn-danger btn-sm" @click="destroy(employee.id)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <tr v-show="!employees.length">
                                            <td colspan="8">
                                                <div class="alert alert-danger" role="alert">
                                                    Sorry :( No data found
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Avatar</th>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Salary</th>
                                            <th>Join</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <pagination-component v-if="pagination.last_page > 1"
                                    :pagination="pagination"
                                    :offset="5"
                                    @paginate="query == '' ? getData():searchData()"
                                ></pagination-component>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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
        data () {
            return {
                query: '',
                employees: [],
                pagination: {
                    current_page: 1
                }
                
            }
        },
        watch: {
            query:function (newQuery, oldQuery) {
                if (newQuery === '') {
                    this.getData()
                } else {
                    this.searchData()
                }
            }
        },
        mounted() {
            this.$Progress.start()
            this.getData();
            this.$Progress.finish()
        },
        methods: {
            getData() {
                this.$Progress.start()
                axios.get('/api/employee?page='+this.pagination.current_page)
                    .then(response => {
                        this.employees  = response.data.data
                        this.pagination = response.data.meta
                        this.$Progress.finish()
                    })
                    .catch(e => {
                        this.$Progress.fail()
                    })
            },
            searchData() {
                this.$Progress.start()

                axios('/api/search/employee/'+this.query+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.employees  = response.data.data
                        this.pagination = response.data.meta
                        this.$Progress.finish()
                    })
                    .catch(e => {
                        this.$Progress.fail()
                    })
            },
            destroy(id) {
                this.$snotify.clear()
                this.$snotify.confirm(
                    "You will not be able to recover this data!",
                    "Are You Sure",
                    {
                        showProgressBar: false,
                        closeOnClick: false,
                        pauseOnHover: true,
                        buttons: [
                            {
                                text: 'Yes',
                                action: toast => {
                                    this.$snotify.remove(toast.id);
                                    this.$Progress.start()
                                    axios.delete('/api/employee/' + id)
                                        .then(response => {
                                            this.getData()
                                            this.$Progress.finish()
                                            this.$snotify.success(response.data.message, response.data.alert)
                                        })
                                        .catch(e => {
                                            this.$Progress.fail()
                                        })
                                },
                                bold: true
                            },
                            {
                                text: 'No',
                                action: toast => {
                                    this.$snotify.remove(toast.id);
                                },
                                bold: true
                            }
                        ]
                    }
                )
            },
        }
    }
</script>

<style scoped>

</style>