<template>
    <app-layout>
        <div class="widget-top-fixed border-bottom">
            <a href="javascript:;"><i class="fa fa-save"></i>{{$t('security.save')}}</a>
            <a href="javascript:;"><i class="fa fa-save"></i>{{$t('security.save_close')}}</a>
        </div>
        <div class="content-header mt-30px pb-16px">
            <h1 class="page-title m-0">{{props.app_title}}</h1>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-0">
                    <div class="card-body clearfix">

                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-md-12 pb-10px">
                                <p class="text-uppercase font-weight-bold color-000000 font-18">
                                    {{$t('application.select_component')}}
                                </p>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-md-12 pb-10px clearfix">
                                <el-button v-for="item in topNavList"
                                           @click="topNavActive = item.id"
                                           :type="topNavActive==item.id?'primary':''"
                                           :key="item.id"
                                           :icon="item.icon">
                                    <span class="csfe-btn-text">{{$t('application.'+item.title)}}</span>
                                </el-button>
                            </div>

                            <!--navigation_menu-->
                            <AppsNavigationMenu v-if="topNavActive == 1" :props-obj="props"></AppsNavigationMenu>
                            <!--navigation_menu-->

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import AppsNavigationMenu from './../../Components/AppsNavigationMenu'
    import {mapActions, mapGetters} from 'vuex'

    export default {
        computed: {
            ...mapGetters(['windowCheck'])
        },
        name: "SelectComponent",
        components: {
            AppLayout,
            AppsNavigationMenu,
        },
        data() {
            return {
                isRequired: [{required: true, message: this.$t('routine.required'), trigger: 'blur'}],
                isRequiredChange: [{required: true, message: this.$t('routine.required_selection'), trigger: 'change'}],
                topNavActive:1,//已点按钮
                topNavList:[
                    {id:1,title:'navigation_menu',icon:'fa fa-navicon'},
                    {id:2,title:'views',icon:'el-icon-s-grid'},
                    {id:3,title:'forms',icon:'el-icon-edit-outline'},
                    {id:4,title:'manage_roles',icon:'fa fa-shield'},
                ],//按钮列表

                props:this.getUrlQuery(this.$page.url), // 参数获取
            }
        },
        created() {

        },
        methods:{
        }
    }
</script>

<style>
    .el-header {
        background-color: #B3C0D1;
        color: #333;
        line-height: 60px;
    }

    .el-aside {
        color: #333;
    }
    .simplebar-scrollbar:before{ background-color: #8c8c8c!important;}
</style>

