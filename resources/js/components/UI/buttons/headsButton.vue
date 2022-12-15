<template>
    <button>
        <slot>Action</slot>
    </button>
</template>

<script>
export default {
    data(){
        return{
            data: 123
        }
    },
    name: "headsButton"
}
</script>

<style scoped>
button{
    background-color: #00ff84ff;
    color: white;
    margin: 0 15px 0 auto;
    padding: 7px;
    border-radius: 7px;
}
</style>
