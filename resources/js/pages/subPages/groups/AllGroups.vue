<template>
    <div class="content-row-header" v-for="u in 3">
        <a href="" class="link-cont">
            <contentAuthor avatar-size="60">
                <template v-slot:other-info-0>
                    <span class="other-info">
                        Открытая группа
                    </span>
                </template>
                <template v-slot:other-info>
                    5.3 тыс. участников
                </template>
            </contentAuthor>
            <flickr></flickr>
        </a>
    </div>
</template>

<script>
export default {
    name: "groups"
}
</script>

<style scoped>

</style>
