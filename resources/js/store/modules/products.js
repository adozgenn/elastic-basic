export const state = {
    queryParams: {
        brand: '',
        color: '',
        size: ''
    }
}
export const getters = {
    query_params: (state)=>state.queryParams,
}

export const mutations = {
    SET_QUERY_PARAMS(state, query){
        state.queryParams = query;
    }
}