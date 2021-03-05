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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
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
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{data.total_sell}}</h3>

                            <p>Total Sell</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <router-link to="/order" class="small-box-footer">
                            <i class="fas fa-arrow-circle-right"></i>
                            More info
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{data.today_sell}}</h3>

                                <p>Today Sell</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <router-link to="/order" class="small-box-footer">
                                <i class="fas fa-arrow-circle-right"></i>
                                More info
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{data.total_income}}</h3>

                                <p>Total Income</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <router-link to="/order" class="small-box-footer">
                                <i class="fas fa-arrow-circle-right"></i>
                                More info
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{data.today_income}}</h3>

                                <p>Today Income</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <router-link to="/order" class="small-box-footer">
                                <i class="fas fa-arrow-circle-right"></i>
                                More info
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{data.total_due}}</h3>

                                <p>Total Due</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <router-link to="/order" class="small-box-footer">
                                <i class="fas fa-arrow-circle-right"></i>
                                More info
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{data.today_due}}</h3>

                                <p>Today Due</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <router-link to="/order" class="small-box-footer">
                                <i class="fas fa-arrow-circle-right"></i>
                                More info
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{data.expense}}</h3>

                            <p>Expense</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <router-link to="/expense" class="small-box-footer">
                            <i class="fas fa-arrow-circle-right"></i>
                            More info
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{data.today_expense}}</h3>

                                <p>Today Expense</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <router-link to="/expense" class="small-box-footer">
                                <i class="fas fa-arrow-circle-right"></i>
                                More info
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
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
    data() {
        return {
            data: []
        }
    },
    methods: {
        getData() {
            axios.get('/api/dashboard')
                .then(response => {
                    this.data = response.data
                })
                .catch(e => {
                    console.log(e);
                })
        }
    },
}
</script>

<style scoped>

</style>