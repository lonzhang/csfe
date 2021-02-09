// 提交 mutations是更改Vuex状态的唯一合法方法
const testActive = (state,name)=>{
    state.test = name
}

//清除单条数据，name，state=>key
const remove = (state,name) => {
    if (typeof state[name] == "object"){
        state[name] = {}
    }else {
        state[name] = ''
    }
}

//所有 state 数据
const removeAll = (state) => {
    for (let key in state) {
        if (typeof state[key] == "object"){
            state[key] = {}
        }else {
            state[key] = ''
        }
    }
}

const windowActions = (state,name)=>{
    // console.log(state,name,typeof name)
    if (typeof name == "object"){
        state.windowCheck = name
    }else {
        console.log('This is Name No Object')
    }
}

const loginAccountActions = (state,name)=>{
        state.loginAccount = name
}
module.exports = {
    testActive:testActive,
    remove:remove,
    removeAll:removeAll,
    windowActions:windowActions,
    loginAccountActions:loginAccountActions,
}


