<template>
    <h4>Создать сообщество</h4>
    <form @submit.prevent="createGroup" class="p-10">
        <input @keyup.enter=""
               placeholder="Название сообщества" class="p-10" type="text" v-model="form.community_name">
        <button type="submit">Создать</button>
    </form>
    <h4>Недавние:</h4>
    <avaContainer></avaContainer>
    <my-search></my-search>
    <horizontalMenu :headers="headers">
        <headsButton>Создать сообщество</headsButton>
    </horizontalMenu>
    <div class="other-head">
        <router-view></router-view>
    </div>

</template>

<script>
export default {
    name: "AllGroups",
    data(){
        return{
            form: {
                community_name: '',
            },
            headers: {
                groups: 'Мои группы',
                'my-groups': 'Управление',
            },
        }
    },
    methods: {
        createGroup(){
            axios.post('/api/community/create', {
                'community_name': this.form.community_name
            }).then(res => {
                console.log(res)
            }).catch(err => {
                console.log(err)
            })
        },
    },
    mounted() {
    }
}
</script>

<style scoped>
h4{
    padding: 0;
    margin: 20px 10px 10px 10px;
}
</style>
