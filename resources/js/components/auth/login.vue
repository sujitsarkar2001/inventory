<template>
    <div>
        <!-- Main content -->
        <section class="content">
            <div class="container">

                <div class="row">
                    <div class="col-sm-8 col-md-6 offset-sm-2 offset-md-3">
                        <div class="login-box">

                            <!-- /.login-logo -->
                            <div class="login-logo">
                                <b>Admin Login</b>
                            </div>

                            <div class="card">
                                <div class="card-body login-card-body">
                                    <p class="login-box-msg">Sign in to start your session</p>

                                    <form @submit.prevent="login" @keydown="form.onKeydown($event)">

                                        <div class="input-group mb-3">
                                            <input type="email" name="email" class="form-control" placeholder="Email" v-model="form.email"
                                             :class="{ 'is-invalid': form.errors.has('email') }"
                                            >
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Password" v-model="form.password"
                                             :class="{ 'is-invalid': form.errors.has('password') }"
                                            >
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-lock"></span>
                                                </div>
                                            </div>
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="icheck-primary">
                                                    <input type="checkbox" id="remember" v-model="form.remember">
                                                    <label for="remember">
                                                        Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-12 my-2">
                                                <button type="submit" :disabled="form.busy" class="btn btn-primary btn-block">Sign In</button>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                    </form>

                                    <p class="mb-1 text-center">
                                        <router-link to="/forgot-password">I forgot my password</router-link>
                                    </p>
                                </div>
                                <!-- /.login-card-body -->
                            </div>
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
        if(User.loggedIn()) {
            this.$router.push({ name: 'dashboard' })
        }
    },
    data() {
        return {
            form: new Form({
                email: '',
                password: '',
                remember: false
            })
        }
    },
    methods: {
        login() {
            this.$Progress.start()
            this.form.busy = true
            this.form.post('/api/auth/login')
                .then(response => {

                    if (this.form.successful) {
                        User.responseAfterLogin(response)
                        this.$Progress.finish()
                        this.$router.push({ name: 'dashboard' })
                    } else {
                        this.$Progress.fail()
                        this.$snotify.error('Something Wrong!!', 'Wrong')
                    }

                })
                .catch(e => {
                    this.$Progress.fail()
                    if (e.response.data.error) {
                        this.$snotify.error(e.response.data.error, 'Wrong')
                    }

                })

        }
    }
}
</script>

<style scoped>

</style>
