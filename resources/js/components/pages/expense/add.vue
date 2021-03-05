<template>
    <div>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h3>Expense</h3>
                    <div class="">
                        <router-link to="/expense" class="btn btn-danger">
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
                    <div class="col-sm-6 offset-sm-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Add New Expense</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form @submit.prevent="store" @keydown="form.onKeydown($event)">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="details">Details</label>
                                        <textarea class="form-control" id="details" placeholder="Enter details" v-model="form.details"
                                        :class="{ 'is-invalid': form.errors.has('details') }"></textarea>
                                        <has-error :form="form" field="details"></has-error>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" class="form-control" id="amount" placeholder="Enter amount" v-model="form.amount"
                                        :class="{ 'is-invalid': form.errors.has('amount') }">
                                        <has-error :form="form" field="amount"></has-error>
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
                details: '',
                amount: ''
            }),
        }
    },
    methods: {
        store() {
            this.$Progress.start()
            this.form.busy = true
            this.form.post('/api/expense')
                .then(response => {
                    
                    if (this.form.successful) {
                        
                        this.$router.push({ name: 'expense' })

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