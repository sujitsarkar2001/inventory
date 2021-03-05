<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Product</h3>
                    <div class="">
                        <router-link to="/product" class="btn btn-danger">
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
                                <h3 class="card-title">Add New Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form @submit.prevent="store" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Select Category</label>
                                            <select class="form-control select2" v-model="form.category">
                                                <option value="">Select Category</option>
                                                <option v-for="(category, index) in categories" :key="index" :value="category.id">{{category.name}}</option>
                                            </select>
                                            <has-error :form="form" field="category" class="d-block"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Select Supplier</label>
                                            <select class="form-control select2" v-model="form.supplier">
                                                <option value="">Select Supplier</option>
                                                <option v-for="(supplier, index) in suppliers" :key="index" :value="supplier.id">{{supplier.name}}</option>
                                            </select>
                                            <has-error :form="form" field="supplier" class="d-block"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="form.name"
                                            :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="code">Code</label>
                                            <input type="code" class="form-control" id="code" placeholder="Enter Code" v-model="form.code"
                                            :class="{ 'is-invalid': form.errors.has('code') }">
                                            <has-error :form="form" field="code"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="root">Root</label>
                                            <input type="text" class="form-control" id="root" placeholder="Enter root" v-model="form.root"
                                            :class="{ 'is-invalid': form.errors.has('root') }">
                                            <has-error :form="form" field="root"></has-error>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="qty">Quantity</label>
                                            <input type="number" class="form-control" id="qty" placeholder="Enter Quantity" v-model="form.qty"
                                            :class="{ 'is-invalid': form.errors.has('qty') }">
                                            <has-error :form="form" field="qty"></has-error>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="buying_price">Buying Price</label>
                                            <input type="number" class="form-control" id="buying_price" placeholder="Enter buying price" v-model="form.buying_price"
                                            :class="{ 'is-invalid': form.errors.has('buying_price') }">
                                            <has-error :form="form" field="buying_price"></has-error>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="selling_price">Selling Price</label>
                                            <input type="number" class="form-control" id="selling_price" placeholder="Enter selling price" v-model="form.selling_price"
                                            :class="{ 'is-invalid': form.errors.has('selling_price') }">
                                            <has-error :form="form" field="selling_price"></has-error>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="buy_date">Buy Date</label>
                                            <input type="date" class="form-control" id="buy_date" v-model="form.buy_date"
                                            :class="{ 'is-invalid': form.errors.has('buy_date') }">
                                            <has-error :form="form" field="buy_date"></has-error>
                                        </div>
                                        
                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-6">
                                            <label for="avatar">Avatar</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="avatar" @change="onFileSelected"
                                                        :class="{ 'is-invalid': form.errors.has('avatar') }">
                                                    <label class="custom-file-label" for="avatar">Choose file</label>
                                                    
                                                </div>
                                            </div>
                                            <has-error :form="form" field="avatar" class="d-block"></has-error>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="nid">View Avatar</label><br>
                                            <img :src="form.avatar" v-if="form.avatar != ''" alt="" width="40px" height="40px" class="img-fluid">
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
    mounted() {
        this.$Progress.start()
        if(!User.loggedIn()) {
            this.$router.push({ name: '/' })
        }
        this.$Progress.finish()
    },
    data() {
        return {
            form: new Form({
                category: '',
                supplier: '',
                name: '',
                code: '',
                root: '',
                qty: '',
                buying_price: '',
                selling_price: '',
                buy_date: '',
                avatar: '',
            }),
            categories: [],
            suppliers: []
        }
    },
    methods: {
        onFileSelected(e) {
            const photo = e.target.files[0];
            if (photo.size > 1048770) {
                this.$snotify.error('Upload image less then 1mb', 'Wrong')
            } else {
                let reader = new FileReader();
                reader.onload = e => {
                    this.form.avatar = e.target.result
                }
                reader.readAsDataURL(photo);
            }
        },
        store() {
            this.$Progress.start()
            this.form.busy = true
            this.form.post('/api/product')
                .then(response => {
                    
                    if (this.form.successful) {
                        
                        this.$router.push({ name: 'product' })

                        this.$snotify.success(response.data.message, response.data.alert)
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
                
        }
    },
    created() {
        axios.get('/api/category')
            .then(response => {
                this.categories = response.data.data
            })
            .catch(e => console.log(e))
        axios.get('/api/supplier')
            .then(response => {
                this.suppliers = response.data.data
            })
            .catch(e => console.log(e))

        this.$Progress.finish()
        
    }
}

</script>

<style scoped>
    
</style>