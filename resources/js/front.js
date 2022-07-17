
window.axios = require('axios');
window.Vue = require('vue');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
*/

import App from './App.vue';

const app = new Vue({
    el: '#app',
    render: h => h(App)
});

