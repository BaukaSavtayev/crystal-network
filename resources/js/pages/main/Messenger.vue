<template>
    <form class="p-10" @submit.prevent="createGroup">
        <input type="text" placeholder="название группы" v-model="group.name">
        <input type="text" placeholder="Id пользователей">
        <button type="submit">Создать беседу</button>
    </form>
<!--    <avaContainer></avaContainer>-->
    <my-search></my-search>
    <router-view></router-view>
</template>

<script>
import contentAuthor from "../../components/content/contentAuthor";
export default {
    components: {contentAuthor},
    name: "Messenger",

    data(){
      return{
          group: {
              name: '',
              users: [78,79]
          }
      }
    },
    created() {
        this.$store.dispatch('Messenger/getChats')
    },
    methods: {
        createGroup(){
            axios.post("/api/chats/createGroup", {group: this.group})
        }
    }
}
</script>

<style>
    .h-55{
        color: #aaa;
        padding: 10px 5px 0 0;
        box-sizing: border-box;
        font-size: 0.9em;
        min-width: 14%;
        text-align: center;
    }
    .unread-messages-count{
        background-color: #e0c3fc;
        color: gray;
        margin: 5px auto 0 auto;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        text-align: center;
        line-height: 26px;
    }
</style>
