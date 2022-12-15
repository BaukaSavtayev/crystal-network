<template>
    <div class="toggle-menu toggle-menu-header-vertical">
        <template v-for="(head, key, index) in headers">
            <router-link :to="'/' + key">
                {{ head }}
            </router-link>
        </template>
    </div>
</template>

<script>
export default {
    props:{
        headers:{
            type: Object    ,
            required: true
        }
    },
    name: "verticalMenu"
}
</script>

<style lang="scss" scoped>

</style>
