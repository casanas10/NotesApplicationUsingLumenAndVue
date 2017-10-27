import './bootstrap';

import router from './routes'
import store from '../store/store'

new Vue ({
    
    el:'#app',
    store,
    router

});