<template>

        <h3>Сейчас популярно:</h3>
        <div class="content-row-header" v-for="u in 3">
            <a href="" class="link-cont">
                <contentAuthor>
                    <template v-slot:other-info>
                        5.3 тыс. подписчиков
                    </template>
                </contentAuthor>
                <button class="follow">Подписаться</button>
            </a>
        </div>
        <h3>Тренды:</h3>
        <div v-for="u in 3" class="content-row-header">
            <a href="" class="link-cont">
                <div class="content-author">
                    <div class>
                        <span class="other-info">Обсуждают в мире:</span>
                        <span class="author-name">#DimashQudaibergen</span>
                        <span class="other-info">175 тыс. упоминаний</span>
                    </div>
                </div>
            </a>
        </div>
        <footer>
            <nav role="footer-nav">
                <a href="">Условия использования</a>,
                <a href="">Политика конфиденциальности</a>,
                <a href="">Политика использования Cookie</a>,
                <a href="">Досутпность</a>,
                <a href="">Информация о рекламе</a>,
                <a href="">© Crystal-Eagle, Inc., 2021 г.</a>
            </nav>
        </footer>
</template>

<script>
import contentAuthor from "./content/contentAuthor";
export default {
    components:{contentAuthor},
    name: "rightside"
}
</script>

<style scoped>

</style>
