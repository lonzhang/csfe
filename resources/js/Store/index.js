import Vue from 'vue'
import Vuex from 'vuex'
import persistedState from 'vuex-persistedstate'
import * as getters from './getters' // 导入响应的模块，*相当于引入了这个组件下所有导出的事例
import * as actions from './actions'
import * as mutations from './mutations'

Vue.use(Vuex)
// 首先声明一个需要全局维护的状态 state 赋值为默认值
const state = {
    test:'This is Test',
    loginAccount:{},
    windowCheck:{
        settingType:'',
        settingLabel:'Setting'
    }
}

// 注册上面引入的各大模块
const store = new Vuex.Store({
    state,    // 共同维护的一个状态，state里面可以是很多个全局状态
    getters,  // 获取数据并渲染
    actions,  // 数据的异步操作
    mutations,  // 处理数据的唯一途径，state的改变或赋值只能在这里
    plugins: [persistedState()]
})

export default store  // 导出store并在 main.js中引用注册。
