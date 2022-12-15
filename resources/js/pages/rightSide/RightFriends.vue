<template>
    <vertical-menu :headers="verticalMenuHeads"></vertical-menu>
</template>

<script>
export default {
    name: "Friends",
    data(){
        return {
            verticalMenuHeads: {
                'messenger': 'Все',
                'messenger/unread': 'Непрочитанные'
            }
        }
    }
}
</script>

<style scoped>

</style>
