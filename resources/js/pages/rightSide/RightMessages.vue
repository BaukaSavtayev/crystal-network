<template>
    <vertical-menu :headers="verticalMenuHeads"></vertical-menu>
</template>

<script>
export default {
    name: "Messages",
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
