import router from 'vue-router'
export const OperationWithMessage = {
    state: () => ({
        message: 'asdasd',
        addressee_id: '',
    }),
    getters: {
        message(state) {
            return state.message;
        },
    },
    mutations: {
        updateMessage(state, newValue){
            state.message = newValue
        },
        updateAddressee_id(state, newValue){
            state.addressee_id = newValue
        }
    },
    actions: {
        async sendMessage({commit, state}, room_id){
            let message = {
                'message': state.message,
                'addressee_id': state.addressee_id,
                'room_id': room_id
            }
            axios.post('/api/messages', message).then(response => {
                console.log(response)
                commit('Messenger/addMessageToRoom', response.data.message, { root: true })
                commit('updateMessage', '')
            }).catch(err => {
                console.log(err)
            })
        },
        async fetchMessages({dispath, state}){
            axios.get('/api/messages').then(response => {
                //this.messages = response.data
                console.log(response)
            }).catch(err => {
                console.log(err)
            })
        },
    },
    namespaced: true
}
