var g = require('./global');
var Vue = require('./vendor/vue');
var _ = require('./vendor/lodash.min.js');
Vue.config.debug = true;
Vue.use(require('./vendor/vue-resource.min'));
Vue.http.headers.common['X-CSRF-Token'] = $('meta[name=csrf-token]').attr('content');

window.gon = {};


window.gon['templates'] = {
    contacts: function () {
        return "CONT"
    },
    gallery: function () {
        return "GAL"
    },
    heading: function () {
        return "{{s.title}} -- {{s.description}}"
    },
    services: function () {
        return "SERV"
    }
};

window.gon['defaults'] = {
    heading: {
        id: '1',
        type: 'heading',
        meta: {
            title: 'Hi there!',
            description: 'Awesome landing page is waiting for you!',
            anchor: '#contacts'
        }
    },
    contacts: {
        type: 'contacts',
        meta: {
            title: 'Hi there',
            description: 'A lot of info',
            phone: '123-456-6789',
            email: 'feedback@awesomelandingpage.com'
        }
    },
    gallery: {
        type: 'gallery',
        meta: {
            heading: 'Look how awesome it is!',
            images: [
                {
                    imageUrl: 'https://static.pexels.com/photos/6471/woman-hand-smartphone-desk-large.jpg',
                    url: 'http://google.com?q=how+to+work+hard',
                    title: 'Work Hard',
                },
                {
                    imageUrl: 'https://static.pexels.com/photos/4158/apple-iphone-smartphone-desk-large.jpg',
                    url: 'http://google.com?q=work+desk',
                    title: 'Work desk',
                },
                {
                    imageUrl: 'https://static.pexels.com/photos/6488/sunglasses-hand-smartphone-desk-large.jpg',
                    url: 'http://google.com?q=Smart+and+clever',
                    title: 'Smart and clever',
                },
                {
                    imageUrl: 'https://static.pexels.com/photos/6416/apple-desk-office-technology-large.jpg',
                    url: 'http://google.com?q=apple+is+awesome',
                    title: 'Apple',
                },
                {
                    imageUrl: 'https://static.pexels.com/photos/3327/construction-work-carpenter-tools-large.jpg',
                    url: 'http://google.com?q=old+school',
                    title: 'Old School',
                },
                {
                    imageUrl: 'https://static.pexels.com/photos/232/apple-iphone-books-desk-large.jpg',
                    url: 'http://google.com?q=be+brights',
                    title: 'Be bright',
                },
            ]
        }
    },
    services: {
        type: 'services',
        meta: {
            heading: 'Ready to serve, Master!',
            services: [
                {
                    icon: 'fa-plus',
                    title: 'Autos',
                    description: 'Cars'
                },
                {
                    icon: 'fa-plus',
                    title: 'Moto',
                    description: 'Bikes'
                },
                {
                    icon: 'fa-plus',
                    title: 'Aero',
                    description: 'Fly'
                },
            ]
        }
    }
};

window.gon['landing'] = {
    title: 'New Awesome Landing',
    sections: [
        _.clone(window.gon.defaults['heading'], true),
        _.clone(window.gon.defaults['heading'], true),
        _.clone(window.gon.defaults['gallery'], true),
        _.clone(window.gon.defaults['services'], true),
        _.clone(window.gon.defaults['contacts'], true),
    ]
};


var App = new Vue({
    el: '#awesome-builder',
    data: {
        title: 'New landing',
        sections: []
    },
    ready: function () {
        if (window.gon.landing) {
            this.$set('$data', _.clone(window.gon.landing, true));
        }
    },
    components: {
        'contacts': require('./sections/contacts'),
        'gallery': require('./sections/gallery'),
        'heading': require('./sections/heading'),
        'services': require('./sections/services')
    },
    computed: {
        sectionsExists: function () {
            return !_.isEmpty(this.sections)
        }
    },
    methods: {
        sectionName: function (section) {
                return section.type.charAt(0).toUpperCase() + section.type.slice(1);
        },
        addSection: function (type) {
            this.sections.push(section);
        }
    }
});

window.dbgApp = App;
