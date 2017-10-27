import VueRouter from 'vue-router';
import store from '../store/store'

let routes = [
    {
        path: '/login',
        component: require('./views/Login'),
        name: 'login',
    },
    {
        path: '/',
        component: require('./views/Dashboard'),

    },
    {
    	path: '/logout',
        component: require('./views/Logout'),
        name: 'logout',
    },
    {
    	path: '/dashboard',
        component: require('./views/Dashboard'),
        name: 'dashboard',
    }
];

export default new VueRouter({
    routes
});