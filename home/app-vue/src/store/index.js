import {createStore} from "vuex";
import todo from './todo/index'

export default function () {
    const store = createStore({
        modules: {
            todo
        }
    })
    return store
}


