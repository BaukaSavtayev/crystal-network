export const ModalWindow = {
    state: () => ({
        modalVisibility: false,
    }),
    getters: {
        modalVisibility(state) {
            return state.modalVisibility;
        },
        message(state){
            return 12312;
        }
    },
    mutations: {
        openModal(state, newValue){
            state.modalVisibility = true
        },
        closeModal(state){
            state.modalVisibility = false
        }
    },
    actions: {

    },
    namespaced: true
}
