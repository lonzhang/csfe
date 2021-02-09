// 给action注册事件处理函数。当这个函数被触发时候，将状态提交到mutations中处理

const testActive = ({commit},name) => commit('testActive',name);

const windowActions = ({commit},name) => commit('windowActions',name);

const remove = ({commit},name) => commit('remove',name);

const removeAll = ({commit},name) => commit('removeAll',name);

const loginAccountActions = ({commit},name) => commit('loginAccountActions',name);

module.exports = {
    testActive:testActive,
    remove:remove,
    removeAll:removeAll,
    windowActions:windowActions,
    loginAccountActions:loginAccountActions,
}
