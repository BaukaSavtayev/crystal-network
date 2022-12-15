<template>
    <div @click="createPost" v-if="false">
        Создать пост
    </div>

    <template v-if="posts">
        <ShortPublication :publications="posts"></ShortPublication>
    </template>

</template>

<script>
import ShortPublication from "../../components/ShortPublication";
export default {
    name: "Main",
    components: {
      ShortPublication,
    },
    data(){
        return{
            posts: [],
            comment: {
                content: '',
                post_id: '',
            }
        }
    },
    created() {
            axios.get('/api/posts').then(res => {
                console.log(res)
                this.posts = res.data;
            })

    },

    methods:{
        createPost(){
          axios.post('/api/post/create', {title: 'Пост номер адин', content: 'Кантент паста номер адин',})
              .then(res => {
                  //this.posts = res
              })
              .catch(e => {
                  //this.posts = e
              })
        },
        createComment(post_id){
            axios.post('/api/comment/create',
                {
                    post_id: post_id,
                    content: this.comment.content,
                })
                .then(res => {console.log(res)})
                .catch(e => {console.log(e)})
        }
    },
}
</script>

<style scoped>

</style>
