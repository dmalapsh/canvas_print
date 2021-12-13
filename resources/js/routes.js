window.Vue = require('vue');

const files = require.context('./components/global', true, /\.vue$/i);
let Components = {};
files.keys().map(key =>{
    let name = key.split('/').pop().split('.')[0];
    Components[name] = Vue.component(name, files(key).default);
} )


export const nativeroutes = [
    {
        path: '/',
        redirect: { name: 'main-page' }
    }, {
        path: '/login',
        name: 'login',
        component: Components.Login,
    },{
        path: '/users',
        name: 'Users',
        component: Components.Users,
    },{
        path: '/widgets',
        name: 'main-page',
        component: Components.mainPage,
    },{
        path: '/report',
        name: 'report',
        component: Components.Report,
    },{
        path: '/col',
        name: 'col',
        component: Components["color-picker"],
    },
];
