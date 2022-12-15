<template>
    <div v-if="modal_type == 1">Первый тип</div>
    <div v-else-if="modal_type == 2">Второй тип</div>
<!--    <div v-else> {{ modal_type }} </div>-->
<!--    <div @click="change"></div>-->
    <testLazyModal v-if="false"></testLazyModal>
    <div class="modal-window" v-if="modalVisibility">
        <div class="modal-wrap">
            <div class="modal-header">
                Написать сообщение
                <button class="fa fa-close" @click="$store.commit('ModalWindow/closeModal')">
                </button>
            </div>
            <form @submit.prevent="$store.dispatch('OperationWithMessage/sendMessage')">
                <input v-model="message" class="w100 mt-20" placeholder="написать сообщение" type="text">
                <button type="submit">Отправть</button>
            </form>
        </div>
    </div>
</template>

<script>
import {defineAsyncComponent} from 'vue';
export default {
    name: "ModalWindow",
    components:{
        testLazyModal: defineAsyncComponent(() =>
            import('./testLazyModal')
        )
    },
    props: {
    },
    data(){
        return{
            modal_type: this.$store.state.ModalWindow.modal_type,
            header: 'Заголовок модального окна',
        }
    },
    created() {
    },
    computed:{
        modalVisibility(){
            return this.$store.getters['ModalWindow/modalVisibility']
        },
        message: {
            get () {
                return this.$store.getters['OperationWithMessage/message']
            },
            set (value) {
                this.$store.commit('OperationWithMessage/updateMessage', value)
            }
        }
    },
    methods: {
        change(){
        },
    },
    watch: {
         '$store.state.ModalWindow.modalVisibility': function(nv) {
         }
     },

}
</script>

<style scoped lang="scss">
.modal-window {
    position: fixed;
    top: 0;
    right: 0;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 1, 2, 0.68);
    z-index: 11;

    .modal-wrap {
        width: 320px;
        margin: 0 auto;
        background-color: white;
        border-radius: 10px;
        margin-top: 130px;
        padding: 20px;

        .modal-header {
            border-bottom: 1px solid #8ec5fc;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;

            .fa-close {
                padding: 5px;
                font-size: 20px;
                cursor: pointer;
                color: black;
            }
        }

        form {
            .radios {
                display: grid;
                grid-template-columns: 30px 1fr;
                margin: 20px 0 10px 0;
                align-items: center;
            }

            textarea {
                width: 100%;
                box-sizing: border-box;
                display: block;
                padding: 10px;
                margin-top: 10px;
            }

            button {
                display: block;
                width: 100%;
                background-image: linear-gradient(90deg, #00dbde 0%, #fc00ff 100%);
                padding: 10px;
                box-sizing: border-box;
                color: white;
                border-radius: 10px;
                margin-top: 10px;
                background-size: 200% auto;
                transition: background-position 0.5s;

                &:hover {
                    background-position: right center;
                }
            }

            input,
            label {
                padding: 7px;
            }
        }
    }
}
</style>
