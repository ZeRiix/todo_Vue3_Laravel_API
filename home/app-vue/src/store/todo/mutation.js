export function SET_NAME_ELEMENT (state, name) {
    state.nameElement = name
}

export function DROP_NAME_ELEMENT (state) {
    state.nameElement = ''
}

export function SET_ID_ELEMENT (state, id) {
    state.idElement = id
}

export function DROP_ID_ELEMENT (state) {
    state.idElement = null
}