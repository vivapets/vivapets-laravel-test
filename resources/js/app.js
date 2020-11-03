/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

/**
 * Toast notification plugin
 */
import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';

Vue.use(VueToast, {
    position: 'top-right',
    duration: 5000
});

/**
 * Loader
 */
import VueLoading from 'vuejs-loading-plugin'
Vue.use(VueLoading, {
    dark: true, // default false
    text: 'Loading', // default 'Loading'
    loading: false, // default false
    background: 'rgb(255,255,255)', // set custom background
    classes: ['myclass'] // array, object or string
});


/**
 * Views
 */
import App from './views/App'
import Home from './views/Home'
import Login from './views/auth/Login'
import Register from './views/auth/Register'
import Logout from './views/auth/Logout'
import Animals from './views/animals/Animals'
import Animal from './views/animals/Animal'
import Breeds from './views/animals/Breeds'
import Breed from './views/animals/Breed'
import Types from './views/animals/Types'
import Type from './views/animals/Type'
import Users from './views/users/Users'

/**
 * Register Componenets
 */

Vue.component('menu-component', require('./components/MenuComponent.vue').default);

/**
 * Setup router
 */
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout,
        },
        {
            path: '/animals',
            name: 'animals',
            component: Animals,
        },
        {
            path: '/animals/create',
            name: 'create_animal',
            component: Animal,
        },
        {
            path: '/animals/:id',
            name: 'edit_animal',
            component: Animal,
        },
        {
            path: '/breeds',
            name: 'breeds',
            component: Breeds,
        },
        {
            path: '/breeds/create',
            name: 'create_breed',
            component: Breed,
        },
        {
            path: '/breeds/:id',
            name: 'edit_breed',
            component: Breed,
        },
        {
            path: '/types',
            name: 'types',
            component: Types,
        },
        {
            path: '/types/create',
            name: 'create_type',
            component: Type,
        },
        {
            path: '/types/:id',
            name: 'edit_type',
            component: Type,
        },
        {
            path: '/users',
            name: 'users',
            component: Users,
        },
        {
            path: '/users/:user/animals',
            name: 'user_animals',
            component: Animals,
        },
    ],
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 window.Vue = Vue;

import Repository from "./repositories/RepositoryFactory";
const UserRepository = Repository.get("users");

const app = new Vue({
    el: '#app',
    data: {
        menu: [],
        stateChanged: 0,
        user: {}
    },
    components: { App },
    router,
    methods: {
        getUser: async function() {
            if(window.localStorage.getItem('access_token')) {
                const result = await UserRepository.getUser().catch(error => {     
                    this.$root.menu = [
                        {
                            name: 'Login',
                            url: '/login'
                        },
                        {
                            name: 'Register',
                            url: '/register'
                        }
                    ];
                    
                    if(error.response) {
                        if(error.response.status == 401) {
                            this.$router.push({ name: 'login' });
                        }
                    }
                });

                return result;
            } else {
                this.$router.push({ name: 'login' });
            }
        },
        loadMenu: async function() {
            this.$loading(true);
            const user = await this.getUser();
            if(user !== undefined) {
                this.user = user.data;
                /**
                 * For test proposals, i`ll not implement the menu with services. This can be easily replaced for a service and them the menus permitions become dynamic
                 */
                if(user.data.type_id == 1) {
                    this.menu = [
                        {
                            name: 'Users',
                            url: '/users'
                        },
                        {
                            name: 'Breeds',
                            url: '/breeds'
                        },
                        {
                            name: 'Animals Types',
                            url: '/types'
                        },
                        {
                            name: 'Logout',
                            url: '/logout'
                        }
                    ];
                } else {
                    this.menu = [
                        {
                            name: 'Animals',
                            url: '/animals'
                        },
                        {
                            name: 'Logout',
                            url: '/logout'
                        }
                    ];
                }
            }

            this.$loading(false);
        }
    },
    mounted() {
        this.loadMenu();
    },
    watch: {
        stateChanged: function(value) {
            this.loadMenu();
        }
    }
});

window.App = app;