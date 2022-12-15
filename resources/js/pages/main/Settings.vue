<template>
    <horizontalMenu :headers="headers"></horizontalMenu>
    <div class="other-head">
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "Settings",
    data(){
        return{
            headers: {
                'set': 'Общие',
                'set/security': 'Безопастность',
                'set/privacy': 'Приватность',
                'set/notifications': 'Уведомления',
                'set/blacklist': 'Черный список',
                'set/help': 'Помощь',
            },
        }
    }
}
</script>

<style scoped>

</style>
