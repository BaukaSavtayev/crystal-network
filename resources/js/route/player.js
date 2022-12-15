

export const playerModule = {
    state: () => ({
        track_index: 3,
    }),
    getters: {

    },
    mutations: {
        current_track(state, newValue){
            state.track_index = newValue
        }
    },
    actions: {

    },
    namespaced: true
}
