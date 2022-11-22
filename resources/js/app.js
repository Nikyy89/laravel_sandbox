/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.toastr = require('toastr');
window.Chart = require('chart.js/auto').default;

//window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//const app = new Vue({
  //  el: '#app',
//});

window.onload = () => {
    let new_comment_btn = document.getElementsByClassName('new_comment_btn');
    var j;
    for (j = 0; j < new_comment_btn.length; j++) {
        new_comment_btn[j].addEventListener("click", function(e) {
            let form_id = e.target.parentNode.id.substring(16);
            let form_1 = document.getElementById('new_comment_' + form_id)
            //form_1.style.display = "block";
            if(form_1.style.display === "block"){
                form_1.style.display = "none";
            }
            else {
                form_1.style.display = "block";
            }
        });
    }
}

