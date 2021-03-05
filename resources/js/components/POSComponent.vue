<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><router-link to="/dashboard">Dashboard</router-link></li>
                        <li class="breadcrumb-item active text-capitalize"><router-link :to="this.$route.path">{{this.$route.name}}</router-link></li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cart Products</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Unit</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-show="total_cart.length" v-for="cart in total_cart" :key="cart.id">
                                                <td>{{cart.name}}</td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-btn" @click="minusCart(cart.id)">
                                                            <button type="button" class="quantity-left-minus btn btn-danger btn-sm btn-number"  data-type="minus" data-field="">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </span>
                                                        <input type="number" class="form-control form-control-sm" readonly min="1" max="100" :value="cart.quantity">
                                                        <span class="input-group-btn" @click="sumCart(cart.id)">
                                                            <button type="button" class="quantity-right-plus btn btn-success btn-sm btn-number" data-type="plus" data-field="">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>{{cart.price}}</td>
                                                <td>{{cart.sub_total}}</td>
                                                <td>
                                                    <button class="btn btn-danger" @click="destroyCart(cart.id)">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr v-show="!total_cart.length">
                                                <td class="text-danger text-center" colspan="5">
                                                    Cart Empty
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body p-2">
                                <table class="table table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <th>Total Quantity:</th>
                                            <td>{{total_qty}}</td>
                                        </tr>
                                        <tr>
                                            <th>Sub Total:</th>
                                            <td>{{sub_total}}</td>
                                        </tr>
                                        <tr>
                                            <th>Vat:</th>
                                            <td>{{vat}}</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>{{total}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <form @submit.prevent="order" @keydown="form.onKeydown($event)">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-sm-3">
                                            <label for="name">Customer Name</label>
                                            <select class="form-control" v-model="form.name"
                                            :class="{ 'is-invalid': form.errors.has('name') }" @change="getCartData()">
                                                <option value="">Select Customer Name</option>
                                                <option v-for="customer in customers" :key="customer.id" :value="customer.id">{{customer.name}}</option>
                                            </select>
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="pay">Pay</label>
                                            <input type="number" class="form-control" v-model="form.pay"
                                            :class="{ 'is-invalid': form.errors.has('pay') }">
                                            <has-error :form="form" field="pay"></has-error>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="pay">Due</label>
                                            <input type="number" class="form-control" v-model="form.due"
                                            :class="{ 'is-invalid': form.errors.has('due') }">
                                            <has-error :form="form" field="due"></has-error>
                                        </div>
                                        <div class="form-group col-sm-3">
                                            <label for="pay_by">Pay By</label>
                                            <select  class="form-control" v-model="form.pay_by"
                                            :class="{ 'is-invalid': form.errors.has('pay_by') }">
                                                <option value="Hand Cash">Hand Cash</option>
                                                <option value="Cheaque">Cheaque</option>
                                                <option value="Gift Card">Gift Card</option>
                                            </select>
                                            <has-error :form="form" field="pay_by"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" :disabled="form.busy" class="btn btn-primary">
                                        <i class="fas fa-plus-circle"></i>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills mb-1">
                                    <li class="nav-item"><a class="nav-link active" href="#all" data-toggle="tab" @click="getDefault()">All Products</a></li>
                                    <li class="nav-item" v-for="category in categories" :key="category.id" @click="getCategoryProduct(category.id, category.slug)"><a class="nav-link" :href="'#'+category.slug" data-toggle="tab">{{category.name}}</a></li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
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
                                <div class="tab-content">
                                    <div class="tab-pane" :class="category_mode == false ? 'active':''" :id="category_mode == false ? 'all':category_name">
                                        <div class="row">
                                            <div v-show="products.length" class="col-md-2" v-for="product in products" :key="product.id" @click="addToCart(product.id)">
                                                <div class="card">
                                                    <div class="card-body p-1">
                                                        <img :src="product.image != 'default.png' ? '/backend/product/'+product.image:'https://via.placeholder.com/240x200.png'" alt="" class="w-100">
                                                    </div>
                                                    <div class="card-footer p-1 text-center">
                                                        <strong>{{product.name}}</strong><br>
                                                        <span v-if="product.qty > 0" class="badge badge-success">Available({{product.qty}})</span>
                                                        <span v-else class="badge badge-danger">Stock Out</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div v-show="!products.length" class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-body text-danger">
                                                        Product does not availabe!!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->

                            <!-- <div class="card-footer text-center">
                                
                            </div> -->

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- <div class="tab-content text-center loading" :class="loading == false ? 'd-block':'d-none'">
            <div class="tab-loading">
                <div>
                    <h4 class="display-4">
                        Please Wait 
                        <i class="fa fa-sync fa-spin"></i>
                    </h4>
                </div>
            </div>
        </div> -->
        

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
        this.getCategory()
        this.getCustomer()
        this.$Progress.finish()
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
    data() {
        return {
            form: new Form({
                name: '',
                pay: '',
                due: '',
                pay_by: ''
            }),
            category_mode: false,
            category_id: 0,
            categories: [],
            products: [],
            category_name: null,
            query: '',
            customers: '',
            total_cart: '',
            total_qty: '',
            sub_total: '',
            vat: '',
            total: '',
        }
    },
    methods: {
        // Get All Product Function
        getData() {
            // Get Product 
            axios.get('/api/pos/product')
                .then(response => {
                    this.products = response.data
                })
                .catch()
        },
        // Get Category Data
        getCategory() {
            // Get All Category
            axios.get('/api/pos/category')
                .then(response => {
                    this.categories = response.data
                })
                .catch()
        },
        // Get Customers Data
        getCustomer() {
            // Get All Customers
            axios.get('/api/pos/customer')
                .then(response => {
                    this.customers = response.data
                })
                .catch()
        },
        // Get Cart Data by Customer
        getCartData() {
            this.$Progress.start()
            if (this.form.name != '') {
                // Get All Carts
                axios.get('/api/pos/cart/'+this.form.name)
                    .then(response => {
                        this.total_cart = response.data.total_cart
                        this.total_qty = response.data.total_qty
                        this.sub_total = response.data.sub_total+'.00'
                        this.vat = response.data.vat+'%'
                        this.total = response.data.total
                        this.$Progress.finish()
                    })
                    .catch(e => {
                        console.log(e)
                        this.$Progress.fail()
                    })
            } else {
                this.total_cart = 0
                this.total_qty = 0
                this.sub_total = 0
                this.vat = 0
                this.total = 0
            }
            
        },
        // Get Product By Category
        getCategoryProduct(id, slug) {
            this.category_mode = true
            this.category_id = id
            this.category_name = slug
            this.$Progress.start()
            axios.get('/api/pos/product/'+id)
            .then(response => {
                this.products = response.data
                this.$Progress.finish()
            })
            .catch(e => {this.$Progress.fail()})
            
        },
        // Back Default
        getDefault() {
            this.category_mode = false
            this.$Progress.start()
            this.getData()
            this.category_id = 0
            this.$Progress.finish()
        },
        // Search Data Method
        searchData() {
            this.$Progress.start()
            axios('/api/pos/search/product/'+this.category_id+'/'+this.query)
                .then(response => {
                    this.products  = response.data
                    this.$Progress.finish()
                })
                .catch(e => {
                    console.log(e)
                    this.$Progress.fail()
                })
        },
        // Add to Cart Product
        addToCart(id) {
            this.$snotify.clear()
            if (this.form.name == '') {
                this.$snotify.warning('Please select customer name then add cart to product', 'Warning')
            } else {
                this.$Progress.start()
                axios.get('/api/pos/cart/'+id+'/'+this.form.name)
                .then(response => {
                    if (response.data.alert == 'Success') {
                        this.getCartData()
                        this.$snotify.success(response.data.message, response.data.alert)
                    } else {
                        this.$snotify.warning(response.data.message, response.data.alert)
                    }
                    
                    this.$Progress.finish()
                    
                })
                .catch(e => {
                    this.$Progress.fail()
                    this.$snotify.error('Sorry something wrong!!', 'Error')
                })
            }
            
        },
        // Destroy Cart
        destroyCart(id) {
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
                                axios.delete('/api/pos/cart/'+id+'/'+this.form.name)
                                    .then(response => {
                                        this.getCartData()
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
        // Sum Cart Method
        sumCart(id) {
            axios.put('/api/pos/cart-sum/'+id)
                .then(response => {
                    this.getCartData()
                    this.$Progress.finish()
                    
                })
                .catch(e => {
                    this.$Progress.fail()
                    this.$snotify.error('Sorry something wrong!!', 'Error')
                })
        },
        // Sum Cart Method
        minusCart(id) {
            axios.put('/api/pos/cart-minus/'+id)
                .then(response => {
                    
                    this.getCartData()
                    this.$Progress.finish()
                })
                .catch(e => {
                    this.$Progress.fail()
                    this.$snotify.error('Sorry something wrong!!', 'Error')
                })
        },
        // Order
        order() {
            this.$Progress.start()
            this.form.busy = true
            this.form.post('/api/order')
                .then(response => {
                    if (this.form.successful) {
                        this.form.reset()
                        this.form.clear()
                        this.$Progress.finish()
                        this.$snotify.success(response.data.message, response.data.alert)
                    } else {
                        this.$Progress.fail()
                        this.$snotify.error('Something Wrong!!', 'Error')
                    }
                    this.getCartData()
                    this.getDefault()
                    
                })
                .catch(e => {
                    this.$Progress.fail()
                    this.$snotify.error(e.response.data.error, 'Wrong')
                })
        }

    }
    
}
</script>

<style scoped>
    .tab-content.loading {
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgb(red, green, blue);
    }
    .tab-loading {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>