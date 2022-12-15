<template>
    <horizontalMenu :headers="headers">
    </horizontalMenu>
    <MySearch></MySearch>
    <div class="other-head"><router-view></router-view></div>
</template>

<script>

export default {
    name: "Friends",
    data(){
      return{
          headers: {
              'friends': 'Все друзья',
              'friends/online': 'Друзья онлайн',
              'friends/incoming': 'Входящие заявки',
              'friends/outgoing': 'Исходящие',
          },
      }
    },
    created() {
        this.getFriends()
    },
    methods: {
        getFriends(){
            axios.get('/api/subscriptions').then(res => {
                console.log(res.data)
                this.$store.commit("setSubscriptionsList", res.data)
                console.log(this.$store.getters.subscriptionsList)
                console.log(this.$store.state.user)
            }).catch(err => {
                console.log(err)
            })
        }
    }


}
</script>

<style scoped>

</style>
