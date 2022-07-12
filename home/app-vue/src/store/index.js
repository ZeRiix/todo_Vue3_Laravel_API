import {createStore} from "vuex";
import todo from './todo/index'

export default createStore({
    modules: {
        todo
    }
})