
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('domains-component', {
    template: '#domain-template',//require('./components/ExampleComponent.vue'),
    props: ['domains'],
    data: function () {
        return {
            parsed_domains : []
        }
    },
    created: function () {
        // `this` points to the vm instance.
        this.parsed_domains = JSON.parse(this.domains);
    },

    methods: {
        deleteDomain : function (domain , id) {
            if(!confirm("Are you sure you want to delete?"))
                return false;
            //this.parsed_domains.$remove(domain);
            var index = this.parsed_domains.indexOf(domain);
            Vue.delete(this.parsed_domains, index);
            $.getJSON('/api/domain/delete/'+id);
        }
    }
});

Vue.component('form-domain-component', {
    template: '#form-domain-template',
    props: ['domain'],
    data: function() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    created: function () {
        // `this` points to the vm instance.
        this.parsed_domain = JSON.parse(this.domain);
    }
});

Vue.component('form-domain-create-component', {
    template: '#form-domain-create-template',
    data: function() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    props: ['domain'],
    created: function () {
        // `this` points to the vm instance.
        this.parsed_domain = JSON.parse(this.domain); //the returned data after a fail save
    }
});


/* Pages */
Vue.component('pages-component', {
    template: '#pages-template',
    props: ['pages'],
    data: function () {
        return {
            parsed_pages : []
        }
    },
    created: function () {
        // `this` points to the vm instance.
        this.parsed_pages = JSON.parse(this.pages);
    },

    methods: {
        deletePage : function (page , id) {
            if(!confirm("Are you sure you want to delete?"))
                return false;
            //this.parsed_domains.$remove(domain);
            var index = this.parsed_pages.indexOf(domain);
            Vue.delete(this.parsed_pages, index);
            $.getJSON('/api/pages/delete/'+id);
        }
    }
});


const app = new Vue({
    el: '#app'
});
