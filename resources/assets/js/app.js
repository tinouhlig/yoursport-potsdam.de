
window.$ = window.jQuery = require('jquery');
require('jquery-ui');

var bootstrap = require('bootstrap-sass');

require('admin-lte');
var datatables = require('datatables');



window.Vue = require('vue');

Vue.config.debug = true;

Vue.transition('fade', {
    enterClass: 'fadeIn',
    leaveClass: 'display-none'
})