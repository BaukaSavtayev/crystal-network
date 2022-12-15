<template>
    <header>
        <div id="logo">
            <a href="/">
                <img src="/img/eagle-logo.jpg" alt="">
                <span>Crystal-Eagle</span>
            </a>
        </div>
        <div id="header-search" class="search">
            <form action="">
                <input type="text" placeholder="Поиск" id="pizda">
                <button type="submit" class="fa fa-search"></button>
            </form>
        </div>
        <div class="df">
            <Player />
            <div
                @mouseover="visibility = true"
                @mouseout="visibility = false">

                <span class="fa fa-bell gradient-btn"></span>
                <div v-show="visibility" style="background: gray">
                    <div v-for="i in 5" class="p-10">Увдомление {{ i }}</div>
                    <div>
                        <span>Показать все</span>
                        <br>
                        <span><a href="/">Настройки</a></span></div>
                </div>
            </div>
        </div>
        <nav>
            <ul>
                <li><toggle toggle_type="1"></toggle></li>
                <li v-if="user">{{ user.name }}</li>
                <li v-if="user"><a href="" @click.prevent="logout"><span class="fa fa-user" /></a></li>
                <li v-else><router-link :to="{name : 'login'}"><span class="fa fa-sign-in" /></router-link></li>
                <li><a href=""><span class="fa fa-film" /></a></li>
                <li class="hassubmenu">
                    <a href="/set" class="submenu-header">
                        <span class="fa fa-cog" />
                    </a>
                    <ul class="submenu"></ul>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
import Player from "./Player";

export default {
    data(){
        return{
            user: this.$store.getters.user,
            visibility: false
        }
    },
    name: "Header",
    components:{
      Player
    },
    methods:{
        async logout() {
            await this.$store.dispatch('logout');
            this.$router.push({name : 'login'});
        }
    }

}
</script>

<style scoped>

</style>
