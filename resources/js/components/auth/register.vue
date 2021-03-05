<template>
    <div>
        <!-- Main content -->
        <section class="content">
            <div class="container">

                <div class="row">
                    <div class="col-sm-8 col-md-6 offset-sm-2 offset-md-3">
                        <div class="register-box">

                            <!-- /.login-logo -->
                            <div class="login-logo">
                                <b>Admin Register</b>
                            </div>

                            <div class="card">
                                <div class="card-body register-card-body">
                                    <p class="login-box-msg">Register a new membership</p>

                                    <form @submit.prevent="register" @keydown="form.onKeydown($event)">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Name" v-model="form.name"
                                             :class="{ 'is-invalid': form.errors.has('name') }">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" placeholder="Email" v-model="form.email"
                                             :class="{ 'is-invalid': form.errors.has('email') }">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Password" v-model="form.password"
                                             :class="{ 'is-invalid': form.errors.has('password') }">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                            <has-error :form="form" field="password"></has-error>
                                            
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Confirm password" v-model="form.password_confirmation">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <button type="submit" :disabled="form.busy" class="btn btn-primary btn-block">Register</button>
                                            
                                        </div>
                                    </form>
                                </div>
                                <!-- /.form-box -->
                            </div><!-- /.card -->
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
        if(!User.loggedIn()) {
            this.$router.push({ name: '/' })
        }
    },
    data() {
        return {
            form: new Form({
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            })
        }
    },
    methods: {
        register() {
            this.$Progress.start()
            this.form.busy = true
            this.form.post('/api/auth/register')
                .then(response => {
                    
                    if (this.form.successful) {
                        User.responseAfterLogin(response)
                        this.$Progress.finish()
                        this.$router.push({ name: 'dashboard' })
                    } else {
                        this.$snotify.error('Something Wrong!!', 'Wrong')
                        this.$Progress.fail()
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