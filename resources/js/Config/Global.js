const global_ = {
    loginLogo:'/images/CSFE_Trans.png',
    defaultMenu:[
        {
            apm_title: 'home',apm_url:'/home',apm_icon: 'fa fa-cog fa-fw',
        },
        {
            apm_title: 'security',apm_url:'',apm_icon: 'fa fa-shield',
            level_two:[
                {apm_title: 'business_units',apm_url:'/test'},
                {apm_title: 'teams',apm_url:''},
                {apm_title: 'users',apm_url:'/user'},
                {apm_title: 'abilities',apm_url:''},
                {apm_title: 'roles',apm_url:''},
            ]
        },
        {
            apm_title: 'email_confiuration',apm_url:'',apm_icon: 'fa fa-envelope-o',
            level_two:[
                {apm_title: 'mailboxes',apm_url:''},
                {apm_title: 'queues',apm_url:''},
                {apm_title: 'emails',apm_url:''},
                {apm_title: 'templates',apm_url:''},
            ]
        },
        {
            apm_title: 'processes',apm_url:'',apm_icon: 'fa fa-navicon',
            level_two:[
                {apm_title: 'triggers',apm_url:''},
                {apm_title: 'cronjobs',apm_url:''},
            ]
        },
        {
            apm_title: 'application',apm_url:'',apm_icon: 'fa fa-windows',
            level_two:[
                {apm_title: 'apps',apm_url:''},
            ]
        },
        {
            apm_title: 'entites',apm_url:'',apm_icon: 'el-icon-menu font-20',
            level_two:[
                {apm_title: 'views',apm_url:''},
                {apm_title: 'forms',apm_url:''},
            ]
        },
        {
            apm_title: 'data_management',apm_url:'',apm_icon: 'fa fa-database',
            level_two:[
                {apm_title: 'imports',apm_url:''},
            ]
        },
        {
            apm_title: 'logs',apm_url:'',apm_icon: 'fa fa-clone',
            level_two:[
                {apm_title: 'system_logs',apm_url:''},
                {apm_title: 'audit_histories',apm_url:''},
            ]
        },
        {
            apm_title: 'search_records',apm_url:'',apm_icon: 'fa fa-search',
        },
    ]
}
export default{
    global_
}
