<template>
    <horizontal-menu :headers="headers">

    </horizontal-menu>
</template>

<script>
import HorizontalMenu from "../../components/UI/horizontalMenu";
export default {
    components: {HorizontalMenu},
    data(){
        return{
            headers: {
                games: 'Каталог',
                'my-games': 'Мои игры',
                'download-games': 'Скачать игры',
                'games/profile': 'Профиль',
            }
        }
    },
    name: "Games"
}
</script>

<style scoped>

</style>
