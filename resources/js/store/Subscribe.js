export const Subscribe = {
    // state: () => ({
    //     message: 'asdasd',
    // }),
    // getters: {
    //     message(state) {
    //         return state.message;
    //     },
    // },
    // mutations: {
    //     updateMessage(state, newValue){
    //         state.message = newValue
    //     }
    // },
    actions: {
        async subscribe({commit, state}, user_id){
            axios.get('/api/subscriptions/subscribe/' + user_id).then(response => {
                // this.state.message.push({
                //     message: this.newMessage,
                //     user: this.user
                // })
                // this.newMessage= ''
                console.log(response)
            }).catch(err => {
                console.log(err)
            })
        },
        // async fetchMessages({dispath, state}){
        //     axios.get('/api/messages').then(response => {
        //         //this.messages = response.data
        //         console.log(response)
        //     }).catch(err => {
        //         console.log(err)
        //     })
        // },
    },
    namespaced: true
}
