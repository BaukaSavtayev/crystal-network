<template>
    <div class="box-shadow mt-20 p-30 bgwhite">
        <h4>Зарегистрироваться</h4>
        <div class="lastauth gg10 mt-20">
            <a class="lastauthitem bdr bdr-radius">
                <span class="fa fa-close"></span>
                <img src="/img/avatarjpg.jpg" alt="">
                <span>Орёл Орёлов</span>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "lastAuth"
}
</script>

<style scoped lang="scss">
    .lastauth{
        display: grid;
        grid-template-columns: repeat(auto-fit, 160px);
    }
    .lastauthitem{
        cursor: pointer;
        padding: 15px;
        position: relative;
        text-align: center;
        .fa-close{
            position: absolute;
            right: 5px;
            top: 5px;
        }
        img{
            border-radius: 50%;
            width: 100%;
            height: 130px;
            object-fit: cover;
        }
    }
</style>
