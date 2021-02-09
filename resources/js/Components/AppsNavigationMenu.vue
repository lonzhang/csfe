<template>
    <!--navigation_menu-->

    <div class="col-lg-12 col-md-12 col-sm-12 mt-20px clearfix">
        <div id="apps-edit-menu" class="float-left border-right">
            <p class="text-uppercase font-weight-bold color-000000 font-18 mb-0 mt-15px pb-15px border-bottom">
                {{$t('application.navigation_menu')}}
            </p>

            <vue-simplebar style="max-height: 400px;">
                <div class="secondary-sidebar-menu">
                    <ul class="accordion-menu apps-menu mt-15px">
                        <li v-for="(sItem,sIndex) in appMenuList">
                            <a :class="nMenuActiveID && nMenuActiveID == sItem.id?'select-item-url clearfix no-cursor-pointer':'clearfix no-cursor-pointer'" href="javascript:;">
                                <div class="a_open float-left cursor-pointer">

                                    <i :class="'menu-icon '+sItem.apm_icon"></i><span>{{sItem.apm_title}}</span>
                                    <i v-if="sItem.level_two" class="fa fa-angle-right ml-1"></i>
                                    <i v-if="!sItem.level_two" class="accordion-icon ml-1"></i>

                                </div>
                                <div class="float-right">
                                    <el-tag @click="editItem(sItem.id)" size="mini" class="ml-5px cursor-pointer"><i class="el-icon-edit"></i></el-tag>
                                    <el-tag @click="deleteItem(sItem.id)" type="danger" size="mini" class="ml-5px cursor-pointer"><i class="el-icon-delete"></i></el-tag>
                                </div>
                            </a>
                            <ul v-if="sItem.level_two" class="sub-menu">
                                <li v-for="(cItem,cIndex) in sItem.level_two">
                                    <a href="javascript:;" :class="nMenuActiveID && nMenuActiveID == cItem.id?'select-item-url':''">
                                        <i :class="'menu-icon apps-icon '+cItem.apm_icon"></i>
                                        {{cItem.apm_title}}

                                        <el-tag @click="deleteItem(cItem.id)" type="danger" size="mini" class="float-right ml-9px mr-10px"><i class="el-icon-delete"></i></el-tag>
                                        <el-tag @click="editItem(cItem.id,sIndex)" size="mini" class="float-right ml-9px"><i class="el-icon-edit"></i></el-tag>
                                    </a>
                                    <ul v-if="cItem.level_three" class="sub-sub-menu">
                                        <li v-for="(tItem,tIndex) in cItem.level_three" :class="nMenuActiveID && nMenuActiveID == tItem.id?'select-item-url':''">
                                            <a href="javascript:;">
                                                <i :class="'menu-icon apps-icon '+tItem.apm_icon"></i>
                                                {{tItem.apm_title}}
                                                <el-tag @click="deleteItem(sItem.id)" type="danger" size="mini" class="float-right ml-9px mr-10px"><i class="el-icon-delete"></i></el-tag>
                                                <el-tag @click="editItem(tItem.id,sIndex,cIndex)" size="mini" class="float-right ml-9px"><i class="el-icon-edit"></i></el-tag>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </vue-simplebar>
            <div class="width-100">
                <el-button @click="addItem" class="ml-20px mt-15px" icon="fa fa-plus" size="mini">
                    <span class="csfe-btn-text">{{$t('application.add_item')}}</span>
                </el-button>
            </div>
        </div>

        <div v-if="nMenuType" class="apps-right-menu float-left border-left" style="margin-left: -1px;">

            <p class="text-uppercase font-weight-bold color-000000 font-18 mb-0 mt-15px pb-15px border-bottom">
                {{$t('application.'+nMenuType)}}
            </p>
            <el-form :model="form" ref="form" label-width="90px" class="csfe-form csfe-label-left mt-20px">
<!--                <el-form-item :label="$t('application.entity')" prop="apm_entity" :rules="isRequiredChange">-->
<!--                    <el-select clearable class="w-100" v-model="form.apm_entity" :placeholder="$t('application.please_select_the_entity')" :no-data-text="$t('routine.no_data')">-->
<!--                        <el-option label="entity 1" value="1"></el-option>-->
<!--                        <el-option label="entity 2" value="2"></el-option>-->
<!--                    </el-select>-->
<!--                </el-form-item>-->

                <el-form-item :label="$t('application.level')" prop="apm_level" :rules="isRequiredChange">
                    <el-select @change="levelChange()" clearable class="w-100" :disabled="nMenuType=='edit_item'?true:false"
                        v-model="form.apm_level" :placeholder="$t('application.please_select_the_level')" :no-data-text="$t('routine.no_data')">
                        <el-option label="Level 1" value="1"></el-option>
                        <el-option label="Level 2" value="2"></el-option>
                        <el-option label="Level 3" value="3"></el-option>
                    </el-select>
                </el-form-item>

                <!--一级导航-->
                <div v-if="form.apm_level!=1 && form.apm_level">
                    <el-form-item :label="$t('application.level_1')" prop="apm_level1" :rules="isRequiredChange">
                        <el-select
                            @change="levelChange" clearable class="w-100" :disabled="nMenuType=='edit_item'?true:false"
                            v-model="form.apm_level1" :placeholder="$t('application.please_select_the_level')" :no-data-text="$t('routine.no_data')">

                            <el-option v-for="(l1Item,l1Index) in appMenuList" :label="l1Item.apm_title" :value="l1Item.id" :key="'l1'+l1Index"></el-option>

                        </el-select>
                    </el-form-item>
                    <!--二级导航-->
                    <el-form-item v-if="form.apm_level!=2" :label="$t('application.level_2')" prop="apm_father_id" :rules="isRequiredChange">
                        <el-select clearable class="w-100" :disabled="nMenuType=='edit_item'?true:false"
                                   v-model="form.apm_father_id" :placeholder="$t('application.please_select_the_level')" :no-data-text="$t('routine.no_data')">

                            <el-option v-for="(l2Item,l2Index) in nMenuLevel2List" :label="l2Item.apm_title" :value="l2Item.id" :key="'l1'+l2Index"></el-option>

                        </el-select>
                    </el-form-item>
                </div>


                <el-form-item :label="$t('application.page')" prop="apm_url" :rules="isRequired">
                    <el-input clearable v-model="form.apm_url" autocomplete="off"></el-input>
                </el-form-item>

                <el-form-item :label="$t('application.title')" prop="apm_title" :rules="isRequired">
                    <el-input clearable v-model="form.apm_title" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item :label="$t('application.icon')" prop="apm_title" :rules="isRequired">
                    <el-input clearable class="width-90" v-model="form.apm_icon" autocomplete="off"></el-input>
                    <el-tooltip class="item" effect="dark" :content="$t('application.icon_sample')" placement="top-start">
                        <a href="https://fontawesome.dashgame.com/" target="_blank">
                            <i class="el-icon-warning-outline width-7 d-inline-block text-right cursor-pointer"></i>
                        </a>
                    </el-tooltip>
                </el-form-item>
                <el-form-item :label="$t('application.description')" prop="apm_description">
                    <el-input class="csfe-textarea-height" v-model="form.apm_description" type="textarea" autocomplete="off"></el-input>
                </el-form-item>

                <el-form-item :label="$t('application.active')">
                    <el-radio v-model="form.apm_display_flag" label="0">{{$t('routine.no')}}</el-radio>
                    <el-radio v-model="form.apm_display_flag" label="1">{{$t('routine.yes')}}</el-radio>
                </el-form-item>
            </el-form>

            <div class="width-100 text-right">
                <el-button @click="menuCreateUpdate" class="ml-20px mt-15px" size="mini">
                    <span class="csfe-btn-text">{{$t('routine.update')}}</span>
                </el-button>
                <el-button class="ml-20px mt-15px" size="mini">
                    <span class="csfe-btn-text">{{$t('routine.cancel')}}</span>
                </el-button>
            </div>
        </div>
    </div>

    <!--navigation_menu-->
</template>

<script>
    export default {
        name: "AppsNavigationMenu",
        data() {
            return {
                isRequired: [{required: true, message: this.$t('routine.required'), trigger: 'blur'}],
                isRequiredChange: [{required: true, message: this.$t('routine.required_selection'), trigger: 'change'}],
                appMenuList:[],
                nMenuActiveID:'',//修改Item项id
                nMenuType:'',// 修改或新增状态
                propsObjs:this.propsObj, // 参数获取
                nMenuLevel2List:'',//二级菜单
                form: {},
            }
        },
        props: {
            propsObj:{
                type: Object,
                default: {}
            },
        },
        created() {
            this.appMenu();
        },
        methods:{
            // id,l1Key,l2Key
            editItem(id,l1Key,l2Key){
                let that = this;
                if (id){
                    that.nMenuKeyLevel1 = ''
                    that.nMenuType = 'edit_item'
                    that.nMenuActiveID = id
                    that.$ajax.get(that.$api.appMenuItem, {params:{id:id}}).then(res => {
                        console.log(res)
                        that.form = res.data;
                        that.form.apm_level1 = l1Key?that.appMenuList[l1Key].id:'';
                    })
                }
            },
            addItem(){
                let that = this;
                that.nMenuType = 'add_item'
                that.nMenuKeyLevel1 = ''
                that.initForm();
                console.log(that.form)
            },
            levelChange(val){
                let that = this;
                that.form.apm_father_id = ''
                if (!val && that.form.apm_level==1){
                    that.form.apm_level1 = ''
                }
                val = val || that.nMenuKeyLevel1 || '';
                that.nMenuKeyLevel1 = val
                that.appMenuList.forEach((item,index)=>{
                    if (item.id == val){
                        that.nMenuLevel2List = that.appMenuList[index].level_two || []
                        return
                    }
                })
            },
            deleteItem(id){
                console.log(id)
                let that = this;
                that.$ajax.post(that.$api.appMenuDelete, {id:id}).then(res => {
                    if (res.data.status){
                        that.$message({message: that.$t('routine.delete_successfully'), type: 'success'});
                        that.appMenu();
                        that.nMenuType = '';
                    }else {
                        that.$message.error(res.data.message);
                    }
                })
            },
            menuCreateUpdate(){
                let that = this;
                that.$refs['form'].validate((valid) => {
                    if (valid) {
                        let api = that.nMenuType == 'edit_item' ? that.$api.appMenuUpdate : that.$api.appMenuCreate

                        that.form.apm_father_id = that.form.apm_father_id || that.form.apm_level1 || 0

                        that.$ajax.post(api, that.form).then(res => {
                            if (res.data.status){
                                that.$message({message: that.nMenuType == 'edit_item'?that.$t('routine.updated_successfully'):that.$t('routine.submitted_successfully'), type: 'success'});
                                that.appMenu();
                                that.nMenuType = '';
                            }else {
                                that.$message.error(res.data.message);
                            }
                            console.log(res.data)
                        })
                    } else {
                        return false;
                    }
                });
            },
            appMenu(){
                let that = this;
                that.$ajax.get(that.$api.appMenu, {params:{id:that.propsObjs.id}}).then(res => {
                    console.log(res.data.level_one)
                    that.appMenuList = res.data.level_one || []
                })
            },
            initForm(){
                let that = this;
                let form ={
                    apm_description: '',
                    apm_display_flag: '0',
                    apm_father_id: '',
                    apm_icon: '',
                    // apm_entity: '',
                    apm_level: '',
                    apm_level1: '',
                    apm_title: '',
                    apm_url: '',
                    app_id: that.propsObjs.id,
                };
                that.form = form;
            },
        }
    }
</script>

<style scoped>

</style>
