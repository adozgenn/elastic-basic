import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

// Load store modules dynamically.
const requireContext = require.context('./modules', false, /.*\.js$/)

const modules = requireContext.keys()
  .map(file =>
    [file.replace(/(^.\/)|(\.js$)/g, ''), requireContext(file)]
  )
  .reduce((modules, [name, module]) => {
    modules[name] = module
    return modules
  }, {})

console.log("modules", modules)
  export default new Vuex.Store({
      modules,
      plugins : [createPersistedState({storage : window.sessionStorage})]
  })