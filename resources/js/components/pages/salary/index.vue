<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Salary</h3>
                    <div class="">
                        <router-link :to="{name: 'salary/create'}" class="btn btn-info">
                            <i class="fas fa-plus-circle"></i>
                            Pay Salary
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
                                                <select name="" id="" class="form-control form-control-md">
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
                                    <div class="col-sm-6 offset-sm-3">
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
                                            <th>Pay Amount</th>
                                            <th>Date</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-show="salaries.length" v-for="(salary, index) in salaries" :key="salary.id">
                                            <td>{{index + 1}}</td>
                                            <td>
                                                <img :src="salary.employee.avatar != 'default.png' ? '/backend/employee/'+salary.employee.avatar:'https://via.placeholder.com/240.png'" alt="" width="50px" height="50px">
                                            </td>
                                            <td>{{salary.employee.name}}</td>
                                            <td>{{salary.amount}}</td>
                                            <td>{{salary.date}}</td>
                                            <td>{{salary.month}}</td>
                                            <td>{{salary.year}}</td>
                                            <td>
                                                <router-link :to="{name: 'salary/create'}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                </router-link>
                                                <router-link :to="{name: 'salary/show', params:{id: salary.id}}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </router-link>
                                                <router-link :to="{name: 'salary/edit', params:{id: salary.id}}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </router-link>
                                                <button class="btn btn-danger btn-sm" @click="destroy(salary.id)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <tr v-show="!salaries.length">
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
                                            <th>Pay Amount</th>
                                            <th>Date</th>
                                            <th>Month</th>
                                            <th>Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="d-flex justify-content-between">
                                    <p>Total Data: {{pagination.total}}</p>
                                    <pagination-component v-if="pagination.last_page > 1"
                                        :pagination="pagination"
                                        :offset="5"
                                        @paginate="query == '' ? getData():searchData()"
                                    ></pagination-component>
                                </div>
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
            salaries: [],
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
            axios.get('/api/salary?page='+this.pagination.current_page)
                .then(response => {
                    this.salaries  = response.data.data
                    this.pagination = response.data.meta
                    this.$Progress.finish()
                })
                .catch(e => {
                    this.$Progress.fail()
                })
        },
        searchData() {
            this.$Progress.start()

            axios('/api/search/salary/'+this.query+'?page='+this.pagination.current_page)
                .then(response => {
                    this.salaries  = response.data.data
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
                                axios.delete('/api/salary/' + id)
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
        }
    }
}
</script>

<style scoped>

</style>