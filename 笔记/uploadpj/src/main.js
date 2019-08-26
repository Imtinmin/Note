// Vue Family
import Vue from 'vue'
import store from './store'
import router from './router'
//import VueRouter from "vue-router";


// Element
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

//App
import App from './App';


Vue.use(ElementUI);


/*const router = new VueRouter({
    routes: [
        { path: '/',component: upload}
    ]
})*/

new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App)
})



