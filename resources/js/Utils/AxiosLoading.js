import axios from 'axios'
import {Loading, Message} from 'element-ui';

function loadingFn(){
    let loading = Loading.service({
        lock: true,
        text: 'Loading',
        spinner: 'el-icon-loading'
    });
    return loading;
}

function messageFn(message) {
    Message({
        dangerouslyUseHTMLString: true,
        message: message,
        type: 'error'
    });
}

let LS = '';
axios.interceptors.request.use(
    config => {
        if (config.method=='post') {
            if (config.data && config.data.loading != false){
                LS = loadingFn();
            }
        } else {
            if (config.loading == true){
                LS = loadingFn();
            }
        }
        return config;
    },
    error => {
        if (LS){
            LS.close()
        }
        return error;
    }
);
axios.interceptors.response.use(
    response => {
        if (LS){
            LS.close()
        }
        return response;
    },
    // 服务器状态码不是2开头的的情况
    // 这里可以跟后台开发人员协商好统一的错误状态码
    // 然后根据返回的状态码进行一些操作，例如登录过期提示，错误提示等等
    // 下面列举几个常见的操作，其他需求可自行扩展
    error => {
        if (LS){
            LS.close()
        }
        if (error.response.status) {
            switch (error.response.status) {
                // 401: 未登录
                // 未登录则跳转登录页面，并携带当前页面的路径
                // 在登录成功后返回当前页面，这一步需要在登录页操作。
                case 401:
                    messageFn('登录过期，请重新登录');
                    setTimeout(() => {
                        window.location.href='/login';
                    }, 1000);
                    break;

                // 403 token过期
                // 登录过期对用户进行提示
                // 清除本地token和清空vuex中token对象
                // 跳转登录页面
                case 403:
                    // Toast({
                    //     message: '登录过期，请重新登录',
                    //     duration: 1000,
                    //     forbidClick: true
                    // });
                    messageFn('登录过期，请重新登录');
                    // 清除token
                    //localStorage.removeItem('token');
                    // 跳转登录页面，并将要浏览的页面fullPath传过去，登录成功后跳转需要访问的页面
                    setTimeout(() => {
                        window.location.href='/login';
                    }, 1000);
                    break;

                // 404请求不存在
                case 404:
                    // Toast({
                    //     message: '网络请求不存在',
                    //     duration: 1500,
                    //     forbidClick: true
                    // });
                    break;
                case 419:
                    messageFn('token mismatch.');
                    setTimeout(() => {
                        window.location.href='/login';
                    }, 1000);
                    break;

                default:
                    // Toast({
                    //     message: error.response.data.message,
                    //     duration: 1500,
                    //     forbidClick: true
                    // });
            }
            return error;
        }
    }
);
