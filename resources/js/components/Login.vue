<template>
        <div class="p-30 box-shadow bgwhite">
            <Errors type="danger" v-if="errors" :content="errors" @close="errors=null" />

            <form @submit.prevent="login">
                    <input placeholder="Телефон или email" type="email" v-model="email_or_phone_number" name="email_or_phone_number">
                    <input placeholder="Пароль" type="password" v-model="password" name="password">
                    <div v-if="busy"  class="">
                    </div>
                    <div class="" v-else>
                        <button type="submit" class="write bdr-radius w100">Войти</button>
                        <router-link :to="{name : 'login'}"> Забыли пароль? </router-link>
                    </div>
            </form>
        </div>
    <Register></Register>
    <lastAuth></lastAuth>



</template>


<script>
import Errors from '../components/Errors.vue';
import Register from "../pages/Register";
import lastAuth from "./lastAuth";
export default {
    components : {
        Errors,
        Register,
        lastAuth
    },
    data() {
        return {

            email_or_phone_number : '' ,
            password : '' ,
            errors : null ,
            busy : false ,

        }
    },

    methods : {
        async login(){
            this.busy = true ;
            this.errors = null
            try {
                await this.$store.dispatch('login' , {'email_or_phone_number' : this.email_or_phone_number , 'password' : this.password})
                this.$router.push({name: 'home'})
            }
            catch (e){
                this.errors = e.data
            };
            this.busy = false ;

        }
    },

}
</script>
<style scoped lang="scss">
form{
    input{
        border-color: #00dbde;
        padding: 10px;
        display: block;
        box-sizing: border-box;
        width: 100%;
        margin: 10px 0;
        &::placeholder{
            font-weight: 500;
            color: #e8d4ef;
            //background-color: ;
        }
    }
    a{
        color: #258aff;
    }
}
</style>

