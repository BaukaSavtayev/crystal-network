<template>
    <template v-for="subscription in subscriptionsList" >
        <div v-if="subscription.friend_2 != $store.getters.user.id && subscription.status == 0" class="content-row-header" :class="{online: subscription.online == 1}">
            <a href="" class="link-cont">
                <contentAuthor :avatarSize="60" :name="subscription.name +' '+ subscription.surname">
                    <template v-slot:other-info>
                        Facebook Inc.
                    </template>
                </contentAuthor>
                <button class="bgradient p-10 bdr-radius">Написать сообщение</button>
                <flickr></flickr>
            </a>
        </div>
    </template>
</template>


<script>
export default {
    name: "outgoingFriends",
    computed: {
        subscriptionsList(){ return this.$store.getters.subscriptionsList}
    },
}
</script>

<style scoped>

</style>
