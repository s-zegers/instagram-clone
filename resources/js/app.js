/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('post-card', require('./components/PostCard.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$('#profile-picture').change(function () {
    if (!$('#image-preview').length) {
        $('.card-body').prepend('<img id="image-preview" class="img-fluid mb-3 profile-picture rounded-circle mx-auto">')
    }
});

$('#file, #profile-picture').change(function () {
    if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image-preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]); // convert to base64 string
    }
});
