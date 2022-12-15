<template>
    <div class="toggle-menu toggle-menu-header-horizontal bdr-bottom">
        <template v-for="(head, key, index) in headers">
            <router-link :to="'/' + key">
                {{ head }}
            </router-link>
        </template>
        <slot></slot>
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
    name: "horizontalMenu"
}
</script>

<style lang="scss" scoped>

</style>
