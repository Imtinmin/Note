//Vue
import Vue from 'vue'
import VueRouter from 'vue-router'


//model
import upload from '../components/upload'



//use
Vue.use(VueRouter);




export default new VueRouter({
    routes: [
        {
            path: '/',
            name: 'upload',
            component: upload,
        }
    ]
});

