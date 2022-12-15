<template>
    <template v-if="room">
        <h4 v-if="isActiveRoom" class="flex-btw">
            <span>{{ room.name }}</span>
            <form action="" @submit.prevent="offNotice">
                <label>Отключить уведомления на:</label>
                <select name="" id="" v-model="disableDuration">
                    <option value="1">1 день</option>
                    <option value="2">3 дня</option>
                    <option value="3">Неделю</option>
                    <option value="4">2 недели</option>
                    <option value="5">Месяц</option>
                    <option value="6">Год</option>
                    <option value="7">Навсигда</option>
                </select>
                <button type="submit">Отправить</button>
            </form>
        </h4>
        <div class="message_cont">
            <div class="message_wrap">
                <div v-for="(message,index) in messages" :key="index">
<!--            <strong>{{ message.author }}: </strong>-->
                    <div class="mess" :class="{my_mess: message.author_id == user.id}">
                        <span class="mess-text">
                            <span v-if="message.have_read == user.id" class="fa fa-check"></span>
                            <span v-if="message.have_read == user.id" class="fa fa-check mr-10"></span>
                            {{ message.message }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="$store.dispatch('OperationWithMessage/sendMessage', roomId)">
            <input @keydown="sendTypingEvent" v-model="message" class="p-10 w100 mt-20" placeholder="написать сообщение" type="text">
            <button type="submit">Отправть</button>
        </form>
            <div v-if="room.typingTimer">{{ room.activeUser }} Пишет...</div>
    </template>
    <div>
        <ul>
            <li v-for="(user, index) in users" :key="index">
                {{
                    user.name
                }}
            </li>
        </ul>
    </div>

</template>

<script>

export default {
    name: "room",
    props: {
    },
    data(){
      return{
          users: [],
          user: this.$store.getters.user,
          typingTimer: false,
          disableDuration: 1,
      }
    },
    computed:{
        roomId(){
            return this.$route.path.match(/messenger\/room\/(\d+)/)[1]
        },
        room(){
            return this.$store.getters['Messenger/chats'][this.roomId];
        },
        messages(){
            return this.$store.getters['Messenger/messages'][this.roomId]
        },
        isActiveRoom(){
            return this.$store.getters['Messenger/isActiveRoom']
        },
        message: {
            get () {
                return this.$store.getters['OperationWithMessage/message']
            },
            set (value) {
                this.$store.commit('OperationWithMessage/updateMessage', value)
            }
        },
        activeUser(){
            return this.$store.getters['Messenger/chats'][this.roomId].activeUser
        },

    },
    created(){
        let obj = {

        }
        console.log(obj)
        this.$store.commit('Messenger/setIsActiveRoom', true)
        this.fetchMessages()
        // window.Echo.join("typing." + this.user.id)
        //     .listenForWhisper('typing', user => {
        //         console.log(user.name + 'пищет')
        //         this.activeUser = user
        //         if (this.typingTimer) clearTimeout(this.typingTimer)
        //         this.typingTimer = setTimeout(()=>{
        //            this.activeUser = false
        //         },1500)
        //     })
            // .here(user => {
            //     this.users = user
            // })
            // .joining(user => {
            //     this.users.push(user)
            // })
            // .leaving(user => {
            //     this.users = this.users.filter(u => u.id != user.id)
            // })
            // .listen('MessageSent',event => {
            //     this.messages.push(event.message)
            // })

        /*window.Echo.join("/room/${roomId}")
            .here(user => {
                this.users = user
            })
            .joining(user => {
                this.users.push(user)
            })
            .leaving(user => {
                this.users = this.users.filter(u => u.id != user.id)
            })
            .listen('MessageSent',event => {
                this.messages.push(event.message)
            })
            .listenForWhisper('typing', user => {
                this.activeUser = user
                if (this.typingTimer) clearTimeout(this.typingTimer)
                this.typingTimer = setTimeout(()=>{
                    this.activeUser = false
                },2000)
            })*/

    },
    methods:{
        async offNotice(){
          await axios.post("/api/messages/room/" + this.roomId + '/disable', {
              'disable_duration': this.disableDuration
          }).then(response => {
              console.log(response.data)
          }).catch(err => {
              console.log(err)
          })
        },
        async fetchMessages(){
            let messages
            await axios.get("/api/messages/room/" + this.roomId).then(response => {
                this.$store.commit('Messenger/setMessages', {roomId: this.roomId, messages: response.data})
            }).catch(err => {
                console.log(err)
            })
            return messages
        },
        sendTypingEvent(){
            let accessUser = this.room.access_users.split(',')
            accessUser.forEach(e => {
                window.Echo.join(`typing.` + e).whisper('typing', {
                    user: this.user, roomId: this.roomId
                })
            })
        }
    },
    watch:{
    }
}
</script>

<style lang="scss" scoped>
.message_cont{
    background-color: rgba(73,220,221,0.23);
    height: 600px;
    overflow: auto;
    .message_wrap{
        height: 100%;
    }
}
.mess{

    .mess-text{
        margin: 5px;
        border-radius: 5px;
        padding: 5px 10px;
        background-color: rgba(210,182,221,0.33);
    }
    display: flex;

}
.my_mess{
    .mess-text{
        background-color: rgba(0,255,97,0.33);
    }
    flex-direction: row-reverse;
}
</style>
