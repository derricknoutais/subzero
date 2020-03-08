require('./bootstrap');

import Multiselect from 'vue-multiselect'
import VueAlertify from 'vue-alertify';
import VueCurrencyFilter from 'vue-currency-filter';
import VueBarcode from 'vue-barcode';




window.Vue = require('vue');
Vue.component('multiselect', Multiselect)
Vue.component('barcode', VueBarcode);
Vue.use(VueAlertify, {
    notifier : {
            delay: 2,
            position: 'top-right',
            closeButton: true,
    }
});

Vue.use(VueCurrencyFilter,
    {
        symbol: 'F CFA ',
        thousandsSeparator: '.',
        fractionCount: 0,
        fractionSeparator: ',',
        symbolPosition: 'back',
        symbolSpacing: true
    })



const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
});
