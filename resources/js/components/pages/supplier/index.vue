<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Supplier</h3>
                    <div class="">
                        <router-link :to="{name: 'supplier/create'}" class="btn btn-info">
                            <i class="fas fa-plus-circle"></i>
                            Create Supplier
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
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Shop Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-show="suppliers.length" v-for="(supplier, index) in suppliers" :key="supplier.id">
                                            <td>{{index + 1}}</td>
                                            <td>
                                                <img :src="supplier.avatar != 'default.png' ? '/backend/supplier/'+supplier.avatar:'https://via.placeholder.com/240.png'" alt="" width="50px" height="50px">
                                            </td>
                                            <td>{{supplier.name}}</td>
                                            <td>{{supplier.phone}}</td>
                                            <td>{{supplier.email}}</td>
                                            <td>{{supplier.address}}</td>
                                            <td>{{supplier.shop_name}}</td>
                                            <td>
                                                <router-link :to="{name: 'supplier/show', params:{id: supplier.id}}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </router-link>
                                                <router-link :to="{name: 'supplier/edit', params:{id: supplier.id}}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </router-link>
                                                <button class="btn btn-danger btn-sm" @click="destroy(supplier.id)">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <tr v-show="!suppliers.length">
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
                                            <th>Address</th>
                                            <th>Shop Name</th>
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
                suppliers: [],
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
            this.$Progress.finish()
        },
        methods: {
            getData() {
                this.$Progress.start()
                axios.get('/api/supplier?page='+this.pagination.current_page)
                    .then(response => {
                        this.suppliers  = response.data.data
                        this.pagination = response.data.meta
                        this.$Progress.finish()
                    })
                    .catch(e => {
                        this.$Progress.fail()
                    })
            },
            searchData() {
                this.$Progress.start()

                axios('/api/search/supplier/'+this.query+'?page='+this.pagination.current_page)
                    .then(response => {
                        this.suppliers  = response.data.data
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
                                    axios.delete('/api/supplier/' + id)
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
            },
        }
    }
</script>

<style scoped>

</style>