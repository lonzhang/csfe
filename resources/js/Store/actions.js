// 给action注册事件处理函数。当这个函数被触发时候，将状态提交到mutations中处理


export const windowActions = ({commit},name) => commit('windowActions',name);

export const remove = ({commit},name) => commit('remove',name);

export const removeAll = ({commit},name) => commit('removeAll',name);
