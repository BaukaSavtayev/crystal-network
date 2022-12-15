<template>
    <div class="content-author">
        <span class="avatar"
              :style="'width:' +
               avatarSize + 'px; height:'
               + avatarSize + 'px; min-width:'
               + avatarSize + 'px'">
            <img src="/img/avatarjpg.jpg" alt="">
        </span>
        <div style="width: 100%;">
            <slot name="other-info-0">
            </slot>
            <span class="author-name">{{ name }}</span>
            <span class="other-info">
                <slot name="other-info"></slot>
            </span>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        avatarSize: {
            default: 50
        },
        name: {
            type: String,
            required: true
        }
    },
    name: "contentAuthor"
}
</script>

<style scoped>
.content-row-header .content-author .avatar{

}
.content-row-header .message-author{
    box-sizing: border-box;
    width: 86%;
}
.content-row-header .message-author .other-info{
    font-size: 0.8em;
    color: #565656;
    margin-top: 7px;
    white-space: nowrap;
    max-width: 85%;
    text-overflow: ellipsis;
    overflow: hidden;
    box-sizing: border-box;
}
</style>
