<template>
    <div>
        <aside class="main-sidebar sidebar-dark-primary elevation-4" v-show="$route.path === '/' ? false:true">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <span class="brand-text font-weight-light">Inventory Management</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/assets/backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item" :class="$route.path == '/dashboard' ? 'menu-open':''">
                            <router-link to="/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                Dashboard
                            </router-link>
                        </li>

                        <li class="nav-item" :class="$route.path == '/register' ? 'menu-open':''">
                            <router-link to="/register" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                User
                            </router-link>
                        </li>

                        <li class="nav-item" :class="$route.path == '/pos' ? 'menu-open':''">
                            <router-link to="/pos" class="nav-link">
                                <i class="nav-icon fab fa-salesforce"></i>
                                POS
                            </router-link>
                        </li>

                        <li class="nav-item" :class="$route.path == '/employee' || $route.path == '/employee/create' || $route.path == '/employee/edit/'+this.$route.params.id || $route.path == '/employee/show/'+this.$route.params.id ? 'menu-is-opening menu-open':''">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Employee
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/employee/create" class="nav-link">
                                        Create Employee
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/employee" class="nav-link">
                                        Employee List
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item" :class="$route.path == '/order' || $route.path == '/order/create' || $route.path == '/order/edit/'+this.$route.params.id || $route.path == '/order/show/'+this.$route.params.id ? 'menu-is-opening menu-open':''">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-record-vinyl"></i>
                                <p>
                                    Order
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/order" class="nav-link">
                                        All Order
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/order/pending" class="nav-link">
                                        Pending Order
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/order/confirmed" class="nav-link">
                                        Confirmed Order
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item" :class="$route.path == '/supplier' || $route.path == '/supplier/create' || $route.path == '/supplier/edit/'+this.$route.params.id || $route.path == '/supplier/show/'+this.$route.params.id ? 'menu-is-opening menu-open':''">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Supplier
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/supplier/create" class="nav-link active">
                                        Create Supplier
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/supplier" class="nav-link active">
                                        Supplier List
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item" :class="$route.path == '/customer' || $route.path == '/customer/create' || $route.path == '/customer/edit/'+this.$route.params.id || $route.path == '/customer/show/'+this.$route.params.id ? 'menu-is-opening menu-open':''">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Customer
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/customer/create" class="nav-link active">
                                        Add Customer
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/customer" class="nav-link active">
                                        Customer List
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item" :class="$route.path == '/category' || $route.path == '/category/create' || $route.path == '/category/edit/'+this.$route.params.id || $route.path == '/category/show/'+this.$route.params.id ? 'menu-is-opening menu-open':''">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-comment-slash"></i>
                                <p>
                                    Category
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/category/create" class="nav-link" :class="$route.path == '/category/create' ? 'active':''">
                                        Create Category
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/category" class="nav-link" :class="$route.path == '/category' ? 'active':''">
                                        Category List
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item" :class="$route.path == '/product' || $route.path == '/product/create' || $route.path == '/product/edit/'+this.$route.params.id || $route.path == '/product/show/'+this.$route.params.id ? 'menu-is-opening menu-open':''">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fab fa-product-hunt"></i>
                                <p>
                                    Product
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/product/create" class="nav-link" :class="$route.path == '/product/create' ? 'active':''">
                                        Create Product
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/product" class="nav-link" :class="$route.path == '/product' ? 'active':''">
                                        Product List
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item" :class="$route.path == '/expense' || $route.path == '/expense/create' || $route.path == '/expense/edit/'+this.$route.params.id || $route.path == '/expense/show/'+this.$route.params.id ? 'menu-is-opening menu-open':''">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-bill-wave-alt"></i>
                                <p>
                                    Expense
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/expense/create" class="nav-link" :class="$route.path == '/expense/create' ? 'active':''">
                                        Create Expense
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/expense" class="nav-link" :class="$route.path == '/expense' ? 'active':''">
                                        Expense List
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item" :class="$route.path == '/sallary' || $route.path == '/sallary/create' || $route.path == '/sallary/edit/'+this.$route.params.id || $route.path == '/sallary/show/'+this.$route.params.id ? 'menu-is-opening menu-open':''">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>
                                    Salary
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/salary/create" class="nav-link" :class="$route.path == '/salary/create' ? 'active':''">
                                        Pay Salary
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/salary" class="nav-link" :class="$route.path == '/salary' ? 'active':''">
                                        Salary List
                                    </router-link>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <router-link to="/logout">Logout</router-link>
                                
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>

<script>
export default {
    created() {
        this.name = localStorage.getItem('user');
    },
    data() {
        return {
            name: ''
        }
    },
}
</script>