import { createStore } from 'vuex'

export default createStore({
  state: {
    selectedElement: "Home",
  },
  mutations: {
    setSelectedElement(state, elem) {
      state.selectedElement = elem;
    },
  },
});