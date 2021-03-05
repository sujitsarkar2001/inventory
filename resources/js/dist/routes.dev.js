"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.routes = void 0;

var login = require('./components/auth/login.vue')["default"];

var register = require('./components/auth/register.vue')["default"];

var forgot = require('./components/auth/forgot-password.vue')["default"];

var logout = require('./components/auth/logout.vue')["default"];

var dashboard = require('./components/DashboardComponent.vue')["default"];

var pos = require('./components/POSComponent.vue')["default"]; // Employee Components Load Here


var employee = require('./components/pages/employee/index.vue')["default"];

var create_employee = require('./components/pages/employee/add.vue')["default"];

var edit_employee = require('./components/pages/employee/edit.vue')["default"];

var show_employee = require('./components/pages/employee/show.vue')["default"]; // Supplier Components Load Here


var supplier = require('./components/pages/supplier/index.vue')["default"];

var create_supplier = require('./components/pages/supplier/add.vue')["default"];

var edit_supplier = require('./components/pages/supplier/edit.vue')["default"];

var show_supplier = require('./components/pages/supplier/show.vue')["default"]; // Category Components Load Here


var category = require('./components/pages/category/index.vue')["default"];

var create_category = require('./components/pages/category/add.vue')["default"];

var edit_category = require('./components/pages/category/edit.vue')["default"]; // Product Components Load Here


var product = require('./components/pages/product/index.vue')["default"];

var create_product = require('./components/pages/product/add.vue')["default"];

var edit_product = require('./components/pages/product/edit.vue')["default"];

var show_product = require('./components/pages/product/show.vue')["default"]; // Expense Components Load Here


var expense = require('./components/pages/expense/index.vue')["default"];

var create_expense = require('./components/pages/expense/add.vue')["default"];

var edit_expense = require('./components/pages/expense/edit.vue')["default"]; // Salary Components Load Here


var salary = require('./components/pages/salary/index.vue')["default"];

var create_salary = require('./components/pages/salary/add.vue')["default"];

var edit_salary = require('./components/pages/salary/edit.vue')["default"];

var show_salary = require('./components/pages/salary/show.vue')["default"]; // Salary Components Load Here


var customer = require('./components/pages/customer/index.vue')["default"];

var create_customer = require('./components/pages/customer/add.vue')["default"];

var edit_customer = require('./components/pages/customer/edit.vue')["default"];

var show_customer = require('./components/pages/customer/show.vue')["default"]; // Salary Components Load Here


var order = require('./components/pages/order/index.vue')["default"];

var order_show = require('./components/pages/order/show.vue')["default"];

var routes = [{
  path: '/',
  component: login,
  name: '/'
}, {
  path: '/register',
  component: register,
  name: 'register'
}, {
  path: '/forgot-password',
  component: forgot,
  name: 'forgot'
}, {
  path: '/logout',
  component: logout,
  name: 'logout'
}, {
  path: '/dashboard',
  component: dashboard,
  name: 'dashboard'
}, {
  path: '/pos',
  component: pos,
  name: 'pos'
}, // Employee Routes Define Here...
{
  path: '/employee',
  component: employee,
  name: 'employee'
}, {
  path: '/employee/create',
  component: create_employee,
  name: 'employee/create'
}, {
  path: '/employee/edit/:id',
  component: edit_employee,
  name: 'employee/edit'
}, {
  path: '/employee/show/:id',
  component: show_employee,
  name: 'employee/show'
}, // Supplier Routes Define Here...
{
  path: '/supplier',
  component: supplier,
  name: 'supplier'
}, {
  path: '/supplier/create',
  component: create_supplier,
  name: 'supplier/create'
}, {
  path: '/supplier/edit/:id',
  component: edit_supplier,
  name: 'supplier/edit'
}, {
  path: '/supplier/show/:id',
  component: show_supplier,
  name: 'supplier/show'
}, // Category Routes Define Here...
{
  path: '/category',
  component: category,
  name: 'category'
}, {
  path: '/category/create',
  component: create_category,
  name: 'category/create'
}, {
  path: '/category/edit/:id',
  component: edit_category,
  name: 'category/edit'
}, // Product Routes Define Here...
{
  path: '/product',
  component: product,
  name: 'product'
}, {
  path: '/product/create',
  component: create_product,
  name: 'product/create'
}, {
  path: '/product/edit/:id',
  component: edit_product,
  name: 'product/edit'
}, {
  path: '/product/show/:id',
  component: show_product,
  name: 'product/show'
}, // Expense Routes Define Here...
{
  path: '/expense',
  component: expense,
  name: 'expense'
}, {
  path: '/expense/create',
  component: create_expense,
  name: 'expense/create'
}, {
  path: '/expense/edit/:id',
  component: edit_expense,
  name: 'expense/edit'
}, // Salary Routes Define Here...
{
  path: '/salary',
  component: salary,
  name: 'salary'
}, {
  path: '/salary/create',
  component: create_salary,
  name: 'salary/create'
}, {
  path: '/salary/edit/:id',
  component: edit_salary,
  name: 'salary/edit'
}, {
  path: '/salary/show/:id',
  component: show_salary,
  name: 'salary/show'
}, // Salary Routes Define Here...
{
  path: '/customer',
  component: customer,
  name: 'customer'
}, {
  path: '/customer/create',
  component: create_customer,
  name: 'customer/create'
}, {
  path: '/customer/edit/:id',
  component: edit_customer,
  name: 'customer/edit'
}, {
  path: '/customer/show/:id',
  component: show_customer,
  name: 'customer/show'
}, // Order Routes Define Here...
{
  path: '/order',
  component: order,
  name: 'order'
}, {
  path: '/order/show/:id',
  component: order_show,
  name: 'order/show'
}];
exports.routes = routes;