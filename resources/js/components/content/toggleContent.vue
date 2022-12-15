<template>
    <div id="mainwrap">
        <template v-for="(block, index) in blocks">
            <div :id="'block' + index">

            </div>
        </template>
    </div>
</template>

<script>
export default {

    props:{
        blocks: {
            types: Array
        }
    },
    name: "toggleContent"
}
</script>

<style scoped>

</style>
