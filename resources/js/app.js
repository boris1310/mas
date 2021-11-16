/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import AddCart from  "./components/AddCart";



Vue.component('add-cart',AddCart);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data:()=>({
        flag:false,
        flagRequired: 0,
        OrderId:'',
        record:{

        },
        mixing:{

        },
        lesson:{

        },
        rolik:{

        },
        arrangment:{

        },
        token:''
    }),
    methods:{
        saveRecord(obj){
            this.flagRequired--;
            this.record = obj;
        },
        saveMixing(obj){
            this.flagRequired--;
            this.mixing = obj;
        },
        saveLesson(obj){
            this.flagRequired--;
            this.lesson = obj;
        },
        saveRolik(obj){
            this.flagRequired--;
            this.rolik = obj;
        },
        saveArrangment(obj){
            this.flagRequired--;
            this.arrangment = obj;
        },
        async setServicesIntoOrder(service){
            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            const response = await fetch('/servicesIntoOrder',{
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                },
                method:"POST",
                body: JSON.stringify(service),
            });
            const result = await response.json();
        },
        async createOrder(user){

            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            const response = await fetch('/orders',{
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                },
                method:"POST",
                body:JSON.stringify(user),
            });
            const result = await response.json();
            this.OrderId = result.id;

            const obj = {
                OrderId:this.OrderId,
                record:this.record,
                mixing:this.mixing,
                lesson:this.lesson,
                rolik:this.rolik,
                arrangment:this.arrangment
            }

            const res = await fetch('/servicesIntoOrder',{
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                },
                method:"POST",
                body: JSON.stringify(obj),
            });
            const stat = res.json().then(async resolve=>{
                if(resolve.status){
                    document.getElementById('successBlock').style.display = 'block';
                    await setTimeout(()=>{
                        document.getElementById('successBlock').style.display = 'none';
                    },1500);
                }
            }).catch( async reject =>{
                document.getElementById('errorBlock').style.display = 'block';
                 await setTimeout(()=>{
                    document.getElementById('errorBlock').style.display = 'none';
                },1500);
            });
            window.location.reload();

        },
    }
});

