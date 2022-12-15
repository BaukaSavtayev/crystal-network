<template>
    <div class="moreActionsBtn"
         @mouseover="visibility = true"
         @mouseout="visibility = false">
        <div class="action-btns">
            <slot name="more-btns"></slot>
            <span class="moreBtn fla fa-flickr"
            ></span>
        </div>
        <div class="moreActions"
             v-show="visibility">
            <div class="btns">
                <a href="">Не интересно</a>
                <a href="">Сохранить в закладках</a>
                <a href="">Пожаловаться</a>
                <a href="">Уведомлять о записях</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "flickr",
    data(){
      return{
          visibility: false
      }
    },
    methods: {
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
