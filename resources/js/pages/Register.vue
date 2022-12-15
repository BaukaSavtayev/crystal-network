<template>

    <div class="box-shadow p-30 mt-20 bgwhite">
        <div  class=" flex-btw" @click="visibility=!visibility">
            <h4>Зарегистрироваться</h4>
            <button class="fa fa-chevron-down"></button>
        </div>
        <div v-show="visibility">
            <errors  v-if="errors" :content="errors"  @close="errors=null" />
            <form @submit.prevent="register">
                <div class="grid2 gg10">
                    <input placeholder="Имя" type="text" name="name" v-model="name" class="">
                    <input placeholder="Фамилия" type="text" name="surname" v-model="surname" class="">
                </div>
                <input placeholder="Телефон или Email" type="text" name="email_or_phone_number" v-model="email_or_phone_number">
                <input placeholder="Пароль" type="password" name="password" v-model="password" class="">

                <div v-if="busy"  class="">

                </div>
                <button v-else type="submit" class="write mt-10 w100 bdr-radius">
                    Register
                </button>
            </form>

        </div>
    </div>

</template>



<script>
import Errors from '../components/Errors.vue';
export default {
    components :{
        Errors
    },
    data() {
        return {
            name : '',
            surname: '',
            password : '' ,
            email_or_phone_number: '',
            errors : null,
            busy : false ,
            visibility: true,
        }
    },

    methods : {
        async register() {
            this.busy = true ;
            this.errors = null
            this.success = ''
            try {
                await this.$store.dispatch('register' , {
                    'name' : this.name,
                    'surname' : this.surname,
                    'password' : this.password ,
                    'email_or_phone_number' : this.email_or_phone_number,
                });
                this.$router.push({name: 'home'})
            } catch (e) {
                console.log(e)
                this.errors = e
            }
                this.busy = false ;
        }
    }
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
        margin: 10px 0 0 0;
        &::placeholder{
            font-weight: 500;
            color: #e8d4ef;
        }
    }
    a{
        color: #258aff;
    }
}

</style>
