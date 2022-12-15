import axios from "axios";

require('./bootstrap');


import {createApp} from "vue";
import App from "./App";
import router from "./route/route";
import components from './components/UI';
import store from "./store";
import Echo from 'laravel-echo';




store.dispatch('getUser').then(()=>{
    const app = createApp(App)
    components.forEach(component => app.component(component.name, component))
    app
        .use(router)
        .use(store)
        .mount("#app");
})


axios.defaults.withCredentials = true;

window.Pusher = require('pusher-js');
//let socket = new WebSocket("ws://crystal.loc:6001/app/24124124124");


window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    disableStats: true,
    forceTLS: false,
    wsHost: window.location.hostname,
    wsPort: 6001,
    // authorizer: (channel, options) => {
    //     return {
    //         authorize: (socketId, callback) => {
    //             axios({
    //                 method: "POST",
    //                 url: "http://crystal.loc/api/broadcasting/auth",
    //                 data: {
    //                     socket_id: socketId,
    //                     channel_name: channel.name,
    //                 },
    //             })
    //                 .then((response) => {
    //                     console.log(response)
    //                     callback(false, response.data);
    //                 })
    //                 .catch((error) => {
    //                     console.log(error)
    //                     callback(true, error);
    //                 });
    //         },
    //     };
    // },
});
// console.log(77777);
// window.Echo.channel('DemoChannel').listen('WebsocketDemoEvent', (res)=>{
//     console.log(77777)
// })

