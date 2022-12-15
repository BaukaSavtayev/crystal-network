import router from 'vue-router'
import axios from "axios";
export const Messenger = {
    state: () => ({
        chats: false,
        messages: {},
        isActiveRoom: false,
    }),
    getters: {
        chats(state) {
            return state.chats;
        },
        messages(state){
            return state.messages
        },
        isActiveRoom(state){
            return state.isActiveRoom;
        }
    },
    mutations: {
        setChats(state, newValue){
            state.chats = newValue
        },
        setMessages(state, nv){
            state.messages[nv.roomId] = nv.messages
        },
        setIsActiveRoom(state, newValue){
            state.isActiveRoom = newValue
        },
        setActiveMessage(state, data){
            state.chats[data.room_id].activeMessage = data.message
        },
        setActiveUsers(state, data){
            state.chats[data.roomId].activeUser = data.userName
        },
        setTypingTimer(state, data){
            state.chats[data.roomId].typingTimer = data.typingTimer
        },
        addMessageToRoom(state, message){
            console.log(123)
            console.log(message)
            console.log(123)
            if (!state.messages[message.room_id]) state.messages[message.room_id] = []
            state.messages[message.room_id].push({
                'message': message.message,
                'author': message.user.name,
                'author_id': message.user.id,
                'id': message.id,
                'created_at': message.created_at,
                'have_read': message.have_read
            })
            console.log(state.messages)
        }
    },
    actions: {

        async getChats({commit, state}, room_id){
            await axios.get('/api/chats').then((res)=>{
                console.log(res)
                commit('setChats', res.data)
            }).catch(err => {
                console.log(err)
            })
        },
        async fetchMessages({dispath, state}){

        },
    },
    namespaced: true
}
