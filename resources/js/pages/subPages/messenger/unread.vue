<template>
    <template v-for="i in 6" >
        <div :class="{online: (i % 2) === 0}" class="content-row-header">
            <a href="" class="link-cont">
                <content-author class="message-author unread" avatar-size="55">
                    <template v-slot:other-info>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem dolor eaque eligendi facere molestiae voluptas?
                    </template>
                </content-author>

                <div class="h-55">
                    21 мая 2021
                    <div class="unread-messages-count">4</div>
                </div>
            </a>
        </div>
    </template>
</template>

<script>
export default {
    name: "unread"
}
</script>
.
<style scoped>
.unread{

}
</style>
