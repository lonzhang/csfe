
module.exports = {
    login:'/login',   // 登录接口
    logout:'/logout',   // 登出接口

    appLists:'/app/lists',   // app列表接口
    appCreate:'/app/create',   // 创建App
    appUpdate:'/app/update',   // 更改App
    appDelete:'/app/delete',   // 删除App

    appMenu:'/app/app-menu',   // 获取单个App关联的Menu组装数据,参数：id
    appMenuItem:'/app-menu/item',   // 获取App_Menu单条数据,参数：id
    appMenuCreate:'/app-menu/create',   // 创建App_Menu,参数：表单数据
    appMenuUpdate:'/app-menu/update',   // 更改App_Menu,参数：表单数据
    appMenuDelete:'/app-menu/delete',   // 删除App_Menu,参数：id
}
