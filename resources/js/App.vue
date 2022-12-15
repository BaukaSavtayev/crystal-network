<template>
    <Header></Header>
    <LeftSide v-if="isAuth" />
    <main
        :class="{
        'profile-cont': isTwoArea,
        'not-auth': !isAuth,
        }"
    >
        <ModalWindow></ModalWindow>
        <router-view />
    </main>
    <section
        id="rightsection"
        v-if="isAuth"
        >
        <router-view name="RightSide" v-if="!isTwoArea" />
    </section>
<!--    <router-view name="modal" />-->

</template>

<script>
import Header from "./components/Header";
import LeftSide from "./components/LeftSide";
import RightSide from "./components/RightSide";
import ModalWindow from "./components/ModalWindow";

export default {
    components:{Header, LeftSide, RightSide, ModalWindow,},
    data(){
        return {
            isAuth: this.$store.getters.user,
            typingTimer: false,
        }
    },
    computed: {
        isTwoArea(){
            //return this.$route.path.match(/profile|musics|user/g)
            return this.$route.path.match(/profile|musics|user/g)
        },
    },
    created() {
        //let channel = Echo.channel("private-channel");
        // channel.listen("pusher:subscription_succeeded", () => {
        //     let triggered = channel.whisper("client-someeventname", {
        //         your: "data",
        //     });
        // });
        if (this.isAuth){
            window.Echo.private(`App.Models.User.` + this.$store.getters.user.id)
                .listen("MessageSent", (data) => {
                    //this.messages.push(event.message)
                    this.$store.commit('Messenger/addMessageToRoom', data.message)
                    this.$store.commit('Messenger/setActiveMessage', data.message)
                });
            window.Echo.join("typing." + this.$store.getters.user.id)
                .listenForWhisper('typing', data => {
                    let isMessenger = this.$route.path.match(/messenger/)
                    let isRoom = this.$route.path.match(/room/)
                    let thisRoomId = this.$route.path.match(/messenger\/room\/(\d+)/)
                    let roomId = data.roomId
                    if (isRoom || isMessenger) {
                        this.$store.commit('Messenger/setActiveUsers', {
                            roomId: roomId, userName: data.user.name
                        })
                        if (this.$store.getters['Messenger/chats'][roomId].typingTimer) clearTimeout(this.$store.getters['Messenger/chats'][roomId].typingTimer)
                        this.$store.getters['Messenger/chats'][roomId].typingTimer = setTimeout(()=>{
                            this.$store.commit('Messenger/setTypingTimer', {roomId: roomId, typingTimer: false})
                        },500)
                    } else {
                        console.log('Любая другая страница')
                    }

                })
        }

    },
    name: "App"
}
</script>

<style lang="scss" scoped>
.not-auth{
    grid-column-start: 2;
    grid-column-end: 3;
}
.profile-cont{
    margin: 0 20px 0 0;
    grid-column-start: 2;
    grid-column-end: -1;
}

</style>
