import {createStore} from "vuex";
import todo from './todo/index'
import user from './user/index'

export default createStore({
    modules: {
        todo,
        user
    }
})