<template>
    <div class="overlay_of_modal">
        <div class="">
            Test lazy modal
        </div>
    </div>
</template>

<script>
export default {
    name: "testLazyModal"
}
</script>

<style scoped>
    .overlay_of_modal{
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        background-color: rgba(255,255,255,0.3);
        z-index: 20;
        display: flex;
        justify-content: center;
        align-items: center;
        box-sizing: border-box;
    }
    .overlay_of_modal div{
        background-color: red;
        width: 320px;
        min-height: 300px;
        box-sizing: border-box;
    }
</style>
