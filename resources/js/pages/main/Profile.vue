<template>
    <div class="profile-wrap p-20 box-shadow">
        <div class="profile-picture mr-40">
            <img src="/img/samaraweavingnet_vogueau2020_008.jpg" alt="">
        </div>
        <div class="info-wrap">
            <div class="profile-info">
                <div class="profile-header">
                    <h1 v-if="!user_id">Самара Уивинг</h1>
                    <h1 v-else>{{ user.name }} <span v-if="user.online == 1" class="online-user"></span></h1>
                    <spaт class="profile-status">Лучше посрать и опоздать, чем придти вовремя и обосраться.</spaт>
                </div>
                <div>
                <div class="info-table mt-20">
                    <span>День рождения:</span><a href="">10 октября 1984 г.</a>
                    <span>Город:</span><a href="">Санкт-Петербург</a>
                    <span>Место работы:</span><a href="">Telegram</a>
                </div>
                </div>
            </div>
            <div class="social-info mt-20">
                <span class="mr-40"><strong>3 216</strong> публикаций</span>
                <span class="mr-40"><strong>385млн</strong> подписчиков</span>
                <span class="mr-40"><strong>491</strong> подписок</span>
            </div>
            <div class="mt-20">
                <button class="bgradient mr-40" @click="$store.dispatch('Subscribe/subscribe', user_id)">Подписаться</button>
                <button class="bgradient" @click="$store.commit('OperationWithMessage/updateAddressee_id', $route.path.match(/user\/(\d+)/)[1]); $store.commit('ModalWindow/openModal')">Написать</button>
            </div>
        </div>

    </div>
    <div class="profile-content">
        <div class="flex-btw p20 mt-20 box-shadow">
            <div class="content-filter">
                <router-link to="/profile/">Публикации</router-link>
                <router-link to="/profile/history">Истории</router-link>
                <router-link to="/profile/videos">Видео</router-link>
                <router-link to="/profile/photos">Фото</router-link>
                <router-link to="/profile/musics">Музыка</router-link>
                <router-link to="/profile/marks">Отметки</router-link>
            </div>
            <div class="profile-action df">
                <input type="text" placeholder="Поделитесь своими никому не ненужными мыслями" class="input_with_button p-10">
                <button class="fa fa-pencil mh40 input_with_button p-10" title="Написать статью"></button>
                <button class="fa fa-picture-o mh40 bdr-radius ml-5" title="Фото"></button>
                <button class="fa fa-music mh40 bdr-radius ml-5" title="Аудио"></button>
                <button class="fa fa-history mh40 bdr-radius ml-5" title="Опубликовать историю"></button>
                <button class="fa fa-play-circle-o mh40 bdr-radius ml-5" title="Видео"></button>
            </div>
        </div>
        <router-view></router-view>
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; grid-gap: 20px">
            <ShortPublication :publications="posts"></ShortPublication>
        </div>
        <div class="content-wrap mt-20">
            <div v-for="u in 6" class="unit-of-content">
                <img src="/img/unit.png" alt="">
            </div>
        </div>
    </div>
</template>

<script>
import ShortPublication from "../../components/ShortPublication";
export default {
    name: "Profile",
    components: {
        ShortPublication,
    },
    data(){
        return{
            user: '',
            posts: [],
            user_id: ''
        }
    },
    methods:{
        getUserProfile(){
            axios.get('/api/user/' + this.user_id).then(response => {
                console.log(response)
                this.user = response.data
            }).catch(e => {
                console.log(e)
            })
        }
    },
    created() {
        this.user_id = this.$route.path.match(/user/)
        if (this.user_id) {
            this.user_id = this.$route.path.match(/user\/(\d+)/)[1]
            this.getUserProfile()
        }
        axios.get('/api/posts').then(res => {
            console.log(res)
            this.posts = res.data;
        })
    },
    mounted() {

    }
}
</script>

<style lang="scss" scoped>
.profile-action{
    button{
        background: #8ec5fc;
    }
}
.profile-wrap{
    .online-user{
        background-color: rgb(0,255,97);
        width: 20px;
        height: 20px;
        display: inline-block;
        border-radius: 50%;
    }
    display: flex;
    justify-content: center;

    .profile-header{
        h1{
            margin: 10px 0;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .profile-status{
            color: #777;
        }
    }
    .profile-info{
        .info-table{
            display: grid;
            grid-template-columns: 200px 1fr;
            a{
                color: #8ec5fc;
            }
        }
    }
    .info-wrap{
        .bgradient{
            width: 220px;
            border-radius: 10px;
            font-weight: bold;
            height: 50px;
            display: inline-block;
        }
    }
}

.profile-picture{
        height: 300px;
        width: 300px;
        img{
            height: 100%;
            width: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
    }
.profile-content{
    .content-filter{
        display: flex;
        border-top: 1px solid #eee;
        a{
            &:first-child{
                border-top: 1px solid #666;
            }
            padding: 15px 10px;
            display: block;
        }
    }
    .content-wrap{
        display: grid;
        grid-template-columns: repeat(3, 300px);
        grid-gap: 20px;
        justify-content: center;
        .unit-of-content{
            height: 300px;
        }
        img{
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    }
}

</style>
