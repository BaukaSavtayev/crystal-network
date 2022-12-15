<template>
    <template v-for="(chat, key) in chats" >
        <div class="content-row-header">
                <router-link :to="'/messenger/room/' + key" class="link-cont">
                    <content-author class="message-author" avatar-size="55" :name="chat.name">
                        <template v-slot:other-info>
                            <template v-if="!chat.typingTimer">
                                {{ chat.activeMessage }}
                            </template>
                            <span v-else style="color: lawngreen">
                                {{ chat.activeUser }} пишет...
                            </span>

                        </template>
                    </content-author>
                    <div class="h-55">
                        21 мая 2021
                        <div class="unread-messages-count" v-if="Number(chat.have_no_read) != 0">{{ chat.have_no_read }}</div>
                    </div>
                </router-link>
        </div>
    </template>
</template>

<script>
import axios from "axios";

export default {
    name: "read",
    data(){
        return{
        }
    },
    methods: {
    },
    computed: {
        chats() {
            return this.$store.getters['Messenger/chats'];
        }
    },
     created() {
        console.log(this.chats)
     }
}
</script>

<style scoped>

</style>
