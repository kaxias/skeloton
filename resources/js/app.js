// noinspection JSUnusedLocalSymbols,JSUnresolvedVariable

window.Vue = require('vue').default;
window._ = require('lodash');

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

const app = new Vue({
    el: '#app',
});
