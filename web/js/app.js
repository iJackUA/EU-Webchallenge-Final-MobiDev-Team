var g = require('./global');
var Vue = require('./vendor/vue');
var _ = require('./vendor/lodash.min.js');
Vue.config.debug = true;
Vue.use(require('./vendor/vue-resource.min'));
Vue.http.headers.common['X-CSRF-Token'] = $('meta[name=csrf-token]').attr('content');


window.gon['defaults'] = {
    heading: {
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
                    icon: 'fa fa-4x fa-diamond',
                    title: 'Autos',
                    description: 'Cars'
                },
                {
                    icon: 'fa fa-4x fa-diamond',
                    title: 'Moto',
                    description: 'Bikes'
                },
                {
                    icon: 'fa fa-4x fa-diamond',
                    title: 'Aero',
                    description: 'Fly'
                },
            ]
        }
    }
};


var App = new Vue({
    el: '#awesome-builder',
    data: {},
    ready: function () {
        if (window.gon.landing) {
            this.$set('$data', _.clone(window.gon.landing, true));
        }
        if (!this.currentSection && this.sectionsExists) {
            this.currentSection = this.sections[0];
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
        },
        currentSectionExists: function () {
            return !_.isEmpty(this.currentSection)
        },
        defaultSections: function () {
            return window.gon.defaults;
        }
    },
    methods: {
        sectionName: function (section) {
            return section.type.charAt(0).toUpperCase() + section.type.slice(1);
        },
        addSection: function (type, e) {
            e.preventDefault();
            var section = _.clone(window.gon['defaults'][type], true);
            this.sections.push(section);
        },
        changeSection: function (index, e) {
            e.preventDefault();
            var section = this.sections[index];
            this.currentSection = section;
        },
        saveLanding: function (e) {
            e.preventDefault();
            this.$http.post(window.gon.saveUrl, JSON.stringify(this.$data),
                function (data, status, request) {
                    $('#previewBtn').attr('href', '/' + this.slug);
                    alert('Saved!');
                }).error(function (data, status, request) {
                alert('Error');
                console.log(data, status);
            })

        },
        removeSection: function (index, e) {
            e.preventDefault();
            this.sections.$remove(index);
            if (!this.currentSection && this.sectionsExists) {
                this.currentSection = this.sections[0];
            }
        }
    }
});

window.dbgApp = App;
