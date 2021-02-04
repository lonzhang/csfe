<template>
    <div class="page-container">

        <div class="page-content">

            <!--left-nav-->
            <div class="secondary-sidebar">
                <div class="secondary-sidebar-bar">
                    <a href="#" class="logo-box text-center">
                        <img :src="'images/CSFE_Trans.png'" alt="">
                    </a>
                </div>
                <div class="secondary-sidebar-menu">

                    <ul class="accordion-menu">

                        <!-- 父级li选中active-page，子项选中 a > active -->

                        <li v-for="sItem in (settingType?menuData[settingType].level_one:$global.defaultMenu)">

                            <jet-nav-link v-if="sItem.apm_url" :href="sItem.apm_url">
                                <i :class="'menu-icon '+sItem.apm_icon"></i><span>{{settingType?sItem.apm_title:$t('menu.'+sItem.apm_title)}}</span>
                            </jet-nav-link>

                            <a v-if="!sItem.apm_url" href="javascript:;">
                                <i :class="'menu-icon '+sItem.apm_icon"></i><span>{{settingType?sItem.apm_title:$t('menu.'+sItem.apm_title)}}</span>
                                <i v-if="sItem.level_two" class="accordion-icon fa fa-angle-right"></i>
                            </a>

                            <ul v-if="sItem.level_two" class="sub-menu">
                                <li v-for="cItem in sItem.level_two">
                                    <jet-nav-link v-if="cItem.apm_url" :href="cItem.apm_url">{{settingType?cItem.apm_title:$t('menu.'+cItem.apm_title)}}</jet-nav-link>
                                    <a v-else href="javascript:;">{{settingType?cItem.apm_title:$t('menu.'+cItem.apm_title)}}</a>
                                </li>
                            </ul>

                        </li>
                    </ul>
                </div>
            </div>

            <!-- Page Header -->
            <div class="page-header">
                <nav class="navbar navbar-default navbar-expand-md">
                    <div class="container-fluid">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="navbar-collapse justify-content-between sidebar-toggle-button" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav mr-auto">
                                <li class="collapsed-sidebar-toggle-inv">
                                    <a href="javascript:;" id="collapsed-sidebar-toggle-button" class="n-logo-sm">
                                        <i class="fa fa-bars color-ffffff font-18"></i>
                                    </a>
                                    <a href="javascript:;" id="sidebar-toggle-button" class="logo-sm-s"><i class="fa fa-bars color-ffffff font-18"></i></a>
                                </li>
                                <!--<li><a href="javascript:;" id="toggle-fullscreen"><i class="el-icon-full-screen"></i></a></li>-->
                                <li style="height: 56px;">
                                    <el-dropdown trigger="click" placement="bottom-start" @command="handSetting">
                                        <div class="header-log-down clearfix">
                                            <span class="color-ffffff font-13">{{settingLabel}}</span>
                                            <i class="fa fa-angle-down color-ffffff font-18"></i>
                                        </div>
                                        <el-dropdown-menu>
                                            <el-dropdown-item v-for="(mItem,mIndex) in menuData" :command="mItem.id" :key="mIndex">{{mItem.app_title}}</el-dropdown-item>
                                        </el-dropdown-menu>
                                    </el-dropdown>
                                </li>
                            </ul>
                        </div>

                        <ul class="nav navbar-nav mr-auto float-right nos-pc">
                            <li>
                                <a href="javascript:;" @click="handSetting('Setting')">
                                    <i class="fa fa-cog fa-fw color-ffffff font-18"></i>
                                </a>
                            </li>
                            <li>
                                <el-dropdown trigger="click" placement="bottom-start" @command="handUser">
                                    <div class="header-log-down clearfix">
                                        <img :src="'images/CSFE_Trans.png'" alt="">
                                        <span class="color-ffffff font-13">Admin</span>
                                        <i class="fa fa-angle-down color-ffffff font-18"></i>
                                    </div>
                                    <el-dropdown-menu>
                                        <el-dropdown-item command="1">
                                            {{$t('others.setting')}}<el-tag type="danger" size="mini" class="ml-1">{{$t('others.change_password')}}</el-tag></el-dropdown-item>
                                        <el-dropdown-item command="2">
                                            {{$t('others.logout')}}<i class="fa fa-sign-in font-18 float-right line-height-36 mr-0"></i>
                                        </el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </li>
                        </ul>
                    </div>
                    <!-- /.container-fluid -->
                </nav>
            </div>

            <!-- Page Inner -->
            <div class="page-inner no-page-title">
                <div id="main-wrapper">
                    <main>
                        <slot></slot>
                    </main>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import {mapActions, mapGetters} from 'vuex'

    export default {
        components: {
            JetNavLink,
            JetResponsiveNavLink
        },

        computed: {
            ...mapGetters(['windowCheck'])
        },
        data() {
            return {
                menuData:this.$page.props.common.app_menu,
                settingType:'',
                settingLabel:'Setting'
            }
        },

        created() {
            this.settingType = this.windowCheck.settingType
            this.settingLabel = this.windowCheck.settingLabel
            console.log(this.$page.props.common.app_menu)
        },
        methods: {
            handSetting(command){
                let menu = this.menuData;
                location.href='/home'
                this.windowActions({
                    settingType:menu[command]?command:'',
                    settingLabel:menu[command]?menu[command].app_title:'Setting'
                })

            },
            handUser(command){

            },

            ...mapActions( // 语法糖
                ['windowActions']
            ),
        }
    }
</script>
