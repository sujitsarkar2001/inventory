<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Orders</h3>
                    <div class="">
                        <router-link to="/pos" class="btn btn-info">
                            <i class="fas fa-plus-circle"></i>
                            Create Order
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
                                <h4 class="card-title">Orders List</h4>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Search By All Field:</label>
                                            <div class="input-group input-group-md">
                                                <input type="text" class="form-control form-control-md" v-model="query">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Search By Date:</label>
                                            <div class="input-group input-group-md">
                                                <input type="date" class="form-control form-control-md" v-model="date" value="Lorem ipsum">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-md btn-default">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="month">Search By Month:</label>
                                            <div class="input-group input-group-md">
                                                <select class="form-control" id="month" v-model="month">
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
                                                
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-md btn-default">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Search By Year:</label>
                                            <div class="input-group input-group-md">
                                                <select class="form-control" id="year" v-model="year">
                                                    <option value="">Select Yesr</option>
                                                    <option v-for="fullYear in fullYears" :value="fullYear" :key="fullYear">{{fullYear}}</option>
                                                </select>
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-md btn-default">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <table id="example1" class="table table-bordered table-striped mb-2">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Total Amount</th>
                                            <th>Pay</th>
                                            <th>Due</th>
                                            <th>Pay By</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-show="orders.length" v-for="(order, index) in orders" :key="order.id">
                                            <td>{{index + 1}}</td>
                                            <td>{{order.customer.name}}</td>
                                            <td>{{order.sub_total}}</td>
                                            <td>{{order.pay}}</td>
                                            <td>{{order.due}}</td>
                                            <td>{{order.pay_by}}</td>
                                            <td>
                                                <router-link :to="{name: 'order/show', params:{id: order.id}}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </router-link>
                                                <button class="btn btn-danger btn-sm" @click="destroy(order.id)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <tr v-show="!orders.length">
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
                                            <th>Total Amount</th>
                                            <th>Pay</th>
                                            <th>Due</th>
                                            <th>Pay By</th>
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
            this.getData()
            this.$Progress.finish()
        },
        data () {
            return {
                query: '',
                date: '',
                month: '',
                year: '',
                fullYears: '',
                orders: [],
                pagination: {
                    current_page: 1,
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
            this.getCurrentYear();
            this.$Progress.finish()
        },
        methods: {
            getCurrentYear() {
                let year = new Date().getFullYear();
                this.fullYears = Array.from({length: year - 1900}, (value, index) => 1901 + index)
                
            },
            getData() {
                this.$Progress.start()
                axios.get('/api/order?page='+this.pagination.current_page)
                    .then(response => {
                        this.orders  = response.data.data
                        this.pagination = response.data.meta
                        this.$Progress.finish()
                    })
                    .catch(e => {
                        this.$Progress.fail()
                    })
            },
            searchData() {
                this.$Progress.start()

                axios('/api/search/order/'+this.query+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.orders  = response.data.data
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
                                    axios.delete('/api/order/' + id)
                                        .then(response => {
                                            this.getData()
                                            this.$Progress.finish()
                                            this.$snotify.success(response.data.message, response.data.alert)
                                        })
                                        .catch(e => {
                                            this.$Progress.fail()
                                            this.$snotify.error('Sorry! Something Wrong', 'Warning')
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