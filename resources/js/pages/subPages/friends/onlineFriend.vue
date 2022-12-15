<template>
    <template v-for="subscription in subscriptionsList">
        <div v-if="subscription.online == 1 && subscription.status == 1" class="content-row-header online">
            <a href="" class="link-cont">
                <contentAuthor :avatarSize="60" :name="subscription.name">
                    <template v-slot:other-info>
                        Facebook Inc.
                    </template>
                </contentAuthor>
                <button class="bgradient p-10">Написать сообщение</button>
                <flickr></flickr>
            </a>
        </div>
    </template>
</template>

<script>
export default {
    name: "onlineFriend",
    data(){

    },
    computed: {
        subscriptionsList(){ return this.$store.getters.subscriptionsList}
    },
    created() {
    }
}
</script>

<style scoped>

</style>
