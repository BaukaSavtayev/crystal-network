<template>
    <template v-if="publications">
        <div class="content-row box-shadow mt-20 p-20" v-for="(post, key, index) in publications">
            <div class="content-row-header">
                <div class="content-author">
                    <a href="" class="avatar"><img src="/img/avatarjpg.jpg" alt=""></a>
                    <div>
                        <a href="" class="author-name">{{ post.author_id + '-' + key + '-' + index}}</a>
                        <a href="" class="other-info">54 минуты назад</a>
                    </div>
                </div>
                <flickr></flickr>
            </div>
            <div class="content-row-content">
                <p>
                    {{ post.content }}
                    <a class="readMore">Показать полностью...</a>
                    <span style="display: none">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio libero magni mollitia totam!
                    </span>
                </p>
                <img src="/img/content-image.jpg" alt="">
            </div>
            <div class="content-row-bottom">
                <button class="do-like fa fa-heart-o" title="Поставить лайк"></button>
                <button class="fa fa-comments-o" title="Коменитровать"></button>
                <button class="do-share fa fa-share" title="Поделиться" onclick="modals('share', 231)"></button>
                <span title="Количество просмотров" class="fa fa-eye"> 17K</span>
            </div>
            <div class="content-row-comments">
                <div class="content-row">
                    <div class="content-row-header">
                        <div class="content-author">
                            <a href="" class="avatar"><img src="/img/avatarjpg.jpg" alt=""></a>
                            <div>
                                <a href="" class="author-name">Some Group</a>
                                <a href="" class="content-time">54 минуты назад</a>
                            </div>
                        </div>
                        <flickr></flickr>
                    </div>
                    <div class="content-row-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio libero magni mollitia totam!</p>
                        <img src="/img/content-image.jpg" alt="">
                    </div>
                    <div class="content-row-bottom">
                        <button class="do-like fa fa-heart-o" title="Поставить лайк"></button>
                        <button class="fa fa-comments-o" title="Коменитровать"></button>
                        <button class="do-share fa fa-share" title="Поделиться" onclick="modals('share', 231)"></button>
                        <span title="Количество просмотров" class="fa fa-eye"> 17K</span>
                    </div>
                    <div class="subcomments">
                        <template v-for="u in 2">
                            <div :class="{'last-child': u == 2}" class="content-row">
                                <div class="content-row-header">
                                    <div class="content-author">
                                        <a href="" class="avatar"><img src="/img/avatarjpg.jpg" alt=""></a>
                                        <div>
                                            <a href="" class="author-name">Some Group</a>
                                            <a href="" class="content-time">54 минуты назад</a>
                                        </div>
                                    </div>
                                    <flickr></flickr>
                                </div>
                                <div class="content-row-content">
                                    <p><a href="">Some</a>, Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio libero magni mollitia totam!</p>
                                    <img src="/img/content-image.jpg" alt="">
                                </div>
                                <div class="content-row-bottom">
                                    <button class="do-like fa fa-heart-o" title="Поставить лайк"></button>
                                    <button class="fa fa-comments-o" title="Коменитровать"></button>
                                    <button class="do-share fa fa-share" title="Поделиться" onclick="modals('share', 231)"></button>
                                    <span title="Количество просмотров" class="fa fa-eye"> 17K</span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="content-row last-child">
                    <div class="content-row-header">
                        <div class="content-author">
                            <a href="" class="avatar"><img src="/img/avatarjpg.jpg" alt=""></a>
                            <div>
                                <a href="" class="author-name">Some Group</a>
                                <a href="" class="content-time">54 минуты назад</a>
                            </div>
                        </div>
                        <flickr></flickr>
                    </div>
                    <div class="content-row-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio libero magni mollitia totam!</p>
                        <img src="/img/content-image.jpg" alt="">
                    </div>
                    <div class="content-row-bottom">
                        <button class="do-like fa fa-heart-o" title="Поставить лайк"></button>
                        <button class="fa fa-comments-o" title="Коменитровать"></button>
                        <button class="do-share fa fa-share" title="Поделиться" onclick="modals('share', 231)"></button>
                        <span title="Количество просмотров" class="fa fa-eye"> 17K</span>
                    </div>
                </div>
                <div class="add-comment" v-if="false">
                    <div class="content-row last-child content-row-header">
                        <a href="" class="avatar"><img src="/img/avatarjpg.jpg" alt=""></a>
                        <form action="" @submit.prevent="createComment(key)">
                            <input type="text" v-model="comment.content" class="w100 input_with_button p-10" placeholder="Оставить комментарий...">
                            <button class="bgradient input_with_button p-10">Отправить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
</template>

<script>
export default {
    name: "ShortPublication",
    props: {
        publications: {
            type: Array
        }
    }
}
</script>

<style scoped>

</style>
