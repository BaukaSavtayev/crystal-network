import axios from 'axios';
import {createStore} from "vuex";
import {playerModule} from "../route/player";
import {ModalWindow} from "./ModalWindow";
import {OperationWithMessage} from "./OperationWithMessage";
import {Subscribe} from "./Subscribe";
import {Messenger} from "./Messenger";

import sharedMutations from 'vuex-shared-mutations';


export default createStore({
    state() {
        return {
            user: null,
            subscriptionsList: []
        }
    },
    getters: {
        user(state) {
            return state.user;
        },
        verified(state) {
            if (state.user) return state.user.email_verified_at
            return null
        },
        id(state) {
            if (state.user) return state.user.id
            return null
        },
        subscriptionsList(state){
            return state.subscriptionsList
        }
    },
    mutations: {

        setUser(state, payload) {
            state.user = payload;
        },
        setSubscriptionsList(state, list) {
            state.subscriptionsList = list;
        },

    },

    actions: {

        async login({ dispatch }, payload) {
            try {
                await axios.get('/sanctum/csrf-cookie');

                await axios.post('/api/login', payload).then((res) => {
                    return dispatch('getUser');
                }).catch((err) => {
                    throw err.response
                });
                // const res = await axios.post('/api/login', payload);

                // if (res.status != 200) throw res;

                // if (res.data.status_code != 200) throw res.data.message;

            } catch (e) {
                throw e
            }

        },

        async register({ dispatch }, payload) {
            try {

                await axios.post('/api/register' , payload).then((res) => {
                    return dispatch('login' ,
                        {
                            'email_or_phone_number' : payload.email_or_phone_number,
                            'password' : payload.password
                        })
                }).catch((err) => {
                    throw(err.response)
                })
            } catch (e) {
                throw (e)
            }
        },
        async logout({ commit }) {
            await axios.post('/api/logout').then((res) => {
                commit('setUser', null);
            }).catch((err) => {

            })

        },
        async getUser({commit}) {

            await axios.get('/api/user').then((res) => {
                commit('setUser', res.data);
            }).catch((err) => {
                console.log(err)
            })

        },
        async profile({commit},payload) {
            await axios.patch('/api/profile', payload).then((res) => {
                commit('setUser', res.data.user);
            }).catch((err) => {
                throw err.response
            })
        },
        async password({commit},payload) {
            await axios.patch('/api/password', payload).then((res) => {

            }).catch((err) => {
                throw err.response
            })
        },

        async verifyResend({dispatch} , payload){
            let res = await axios.post('/api/verify-resend' , payload)
            if (res.status != 200) throw res
            return res
        },
        async verifyEmail({dispatch} , payload){
            let res = await axios.post('/api/verify-email/' + payload.id + '/' + payload.hash)
            if (res.status != 200) throw res
            dispatch('getUser')
            return res

        },


    },
    plugins: [sharedMutations({ predicate: ['setUser'] })],

    modules:{
        player: playerModule,
        ModalWindow: ModalWindow,
        OperationWithMessage: OperationWithMessage,
        Subscribe:Subscribe,
        Messenger:Messenger,
    }

})
