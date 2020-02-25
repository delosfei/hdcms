//系统配置
export default {
  namespaced: true,
  state: {
    data: null
  },
  mutations: {
    set(state, data) {
      state.data = data
    }
  },
  actions: {
    async get({ state, commit }, force = false) {
      if (state.data && force === false) return Promise.resolve(state.data)
      let response = await window.axios.get('system/config/1').then(r => r.data.data)
      commit('set', response)
      return response
    }
  }
}
