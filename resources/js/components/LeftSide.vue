<template>
    <section id="leftsection">
        <ul>
            <li><router-link to="/bookmarks"><span class="fa gradient-btn fa-bookmark"></span>Закладки</router-link></li>
            <li><router-link to="/register"><span class="fa gradient-btn fa-home"></span>Реристрация</router-link></li>
            <li><router-link to="/login"><span class="fa gradient-btn fa-home"></span>Войти</router-link></li>
            <li><router-link to="/profile"><span class="fa gradient-btn fa-home"></span>Моя страница</router-link></li>
            <li><router-link to="/friends"><span class="fa gradient-btn fa-users"></span>Друзья</router-link></li>
            <li><router-link to="/messenger"><span class="fa gradient-btn fa-weixin"></span>Сообщения</router-link></li>
            <li><router-link to="/groups"><span class="fa gradient-btn fa-stack-exchange"></span>Группы</router-link></li>
            <li><router-link to="/videos"><span class="fa gradient-btn fa-play-circle-o"></span>Видео</router-link></li>
            <li><router-link to="/musics"><span class="fa gradient-btn fa-music"></span>Музыка</router-link></li>
            <li><router-link to="/games"><span class="fa gradient-btn fa-gamepad"></span>Игры</router-link></li>
            <li><router-link to="/photos"><span class="fa gradient-btn fa-picture-o"></span>Фотографии</router-link></li>
        </ul>
    </section>
</template>

<script>
export default {
    name: "LeftSide"
}
</script>

<style lang="scss" scoped>
    .profile-cont#leftsection{
        min-height: auto;
        position: static;
        ul{
            display: grid;
            width: 100%;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            grid-gap: 10px;
            li{
                a{
                    margin: 0;
                }
            }
        }
    }
</style>
