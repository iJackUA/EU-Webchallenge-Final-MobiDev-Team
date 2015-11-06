var g = require('./global');
var Vue = require('../vendor/vue');
Vue.config.debug = true;
Vue.use(require('../vendor/vue-resource.min'));
Vue.http.headers.common['X-CSRF-Token'] = $('meta[name=csrf-token]').attr('content');

window.dbgApp = App;
