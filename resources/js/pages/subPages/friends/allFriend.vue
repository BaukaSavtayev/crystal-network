<template>
    <template v-for="subscription in subscriptionsList" >
        <div v-if="subscription.status == 1" class="content-row-header" :class="{online: subscription.online == 1}">
            <div href="" class="link-cont">
                <contentAuthor :avatarSize="60" :name="subscription.name +' '+ subscription.surname">
                    <template v-slot:other-info>
                        Facebook Inc.
                    </template>
                </contentAuthor>
                <button class="bgradient p-10 bdr-radius" @click.stop="$store.commit('OperationWithMessage/updateAddressee_id', subscription.id); $store.commit('ModalWindow/openModal')">Написать сообщение</button>
                <flickr></flickr>
            </div>
        </div>
    </template>
</template>

<script>
export default {
    name: "allFriends",
    data(){
      return{

      }
    },
    computed: {
        subscriptionsList(){ return this.$store.getters.subscriptionsList}
    },

}
</script>

<style scoped>

</style>
