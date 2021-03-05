<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Customer</h3>
                    <div class="">
                        <router-link to="/customer" class="btn btn-danger">
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
                                <h3 class="card-title">Add New Customer</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form @submit.prevent="store" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Enter name" v-model="form.name"
                                            :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" placeholder="Enter email" v-model="form.email"
                                            :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone</label>
                                            <input type="number" class="form-control" id="phone" placeholder="Enter phone number" v-model="form.phone"
                                            :class="{ 'is-invalid': form.errors.has('phone') }">
                                            <has-error :form="form" field="phone"></has-error>
                                        </div>
                                        
                                    </div>

                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" id="address" placeholder="Enter address" v-model="form.address"
                                        :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
                                        <has-error :form="form" field="address"></has-error>
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
                                            <img :src="form.avatar" alt="" width="40px" height="40px" class="img-fluid">
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
                email: '',
                phone: '',
                address: '',
                avatar: ''
            }),
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
            this.form.post('/api/customer')
                .then(response => {
                    
                    if (this.form.successful) {
                        
                        this.$router.push({ name: 'customer' })

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
    }
}
</script>

<style scoped>
    
</style>