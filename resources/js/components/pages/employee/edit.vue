<template>
    <div>

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Employee</h3>
                    <div class="">
                        <router-link :to="{name: 'employee/show', params:{id: this.$route.params.id}}" class="btn btn-info">
                            <i class="fas fa-eye"></i>
                            Show
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
                                <h3 class="card-title">Update Employee</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form @submit.prevent="update" @keydown="form.onKeydown($event)" enctype="multipart/form-data">
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

                                        <div class="form-group col-md-6">
                                            <label for="salary">Salary</label>
                                            <input type="number" class="form-control" id="salary" placeholder="Enter salary" v-model="form.salary"
                                            :class="{ 'is-invalid': form.errors.has('salary') }">
                                            <has-error :form="form" field="salary"></has-error>
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
                                            <label for="nid">NID Number</label>
                                            <input type="number" class="form-control" id="nid" placeholder="Enter NID" v-model="form.nid"
                                            :class="{ 'is-invalid': form.errors.has('nid') }">
                                            <has-error :form="form" field="nid"></has-error>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="joining_date">Joining Date</label>
                                            <input type="date" class="form-control" id="joining_date" placeholder="Joining Date" v-model="form.joining_date"
                                            :class="{ 'is-invalid': form.errors.has('joining_date') }">
                                            <has-error :form="form" field="joining_date"></has-error>
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
                                            <img v-if="form.new_avatar == null" :src="form.avatar != 'default.png' ? '/backend/employee/'+form.avatar:'https://via.placeholder.com/240.png'" alt="" width="40px" height="40px" class="img-fluid">
                                            <img v-else :src="form.new_avatar" width="40px" height="40px" class="img-fluid">
                                        </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" :disabled="form.busy" class="btn btn-primary">
                                        <i class="fas fa-arrow-circle-up"></i>
                                        Update
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
        
        let id = this.$route.params.id
        axios.get('/api/employee/'+id)
            .then(response => {
                this.form.fill(response.data.data)
            })
            .catch(e => {
                this.$router.push({ name: 'employee' })
                this.$snotify.warning('Sorry! Something Wrong', 'Warning')
            })
        this.$Progress.finish()
        
    },
    data() {
        return {
            form: new Form({
                name: '',
                email: '',
                phone: '',
                salary: '',
                address: '',
                avatar: '',
                nid: '',
                joining_date: '',
                new_avatar: null
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
                    this.form.new_avatar = e.target.result
                }
                reader.readAsDataURL(photo);
            }
        },
        update() {
            let id = this.$route.params.id
            this.$Progress.start()
            this.form.busy = true
            this.form.put('/api/employee/'+id)
                .then(response => {
                    
                    if (this.form.successful) {
                        
                        this.$router.push({ name: 'employee' })

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