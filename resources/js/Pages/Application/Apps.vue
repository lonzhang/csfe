<template>
    <app-layout>
        <div class="widget-top-fixed border-bottom">
            <a @click="dialogShow('')" href="javascript:;"><i class="fa fa-plus color-67C23A"></i>{{$t('security.new')}}</a>
            <a href="javascript:;"><i class="fa fa-refresh"></i>{{$t('security.refresh')}}</a>
        </div>
        <div class="content-header mt-30px pb-16px">
            <h1 class="page-title m-0">{{$t('application.application_apps')}}</h1>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-0">
                    <div class="card-body clearfix">
                        <vue-simplebar>
                            <div class="col-lg-12 col-sm-12 col-md-12 p-0">
                                <el-table
                                    class="min-w-800"
                                    max-height="570"
                                    ref="multipleTable"
                                    :empty-text="$t('routine.no_data')"
                                    :data="tableData.slice((currentPage-1)*$global.pageSize,currentPage*$global.pageSize)">
                                    <el-table-column prop="name" :label="$t('application.action')" align="center" width="150">
                                        <template slot-scope="scope">
                                            <el-tooltip class="item" effect="dark" :content="$t('application.edit')" placement="top-start">
                                                <el-tag class="csfe-i-btn" @click="dialogShow(scope.row)">
                                                    <i class="el-icon-edit-outline"></i>
                                                </el-tag>
                                            </el-tooltip>
                                            <el-tooltip class="item" effect="dark" :content="$t('application.delete')" placement="top-start">
                                                <el-tag class="csfe-i-btn" type="danger" @click="deleteItem(scope.row.id)">
                                                    <i class="el-icon-delete"></i>
                                                </el-tag>
                                            </el-tooltip>
                                        </template>
                                    </el-table-column>
                                    <el-table-column prop="app_title" :label="$t('application.title')">
                                        <template slot-scope="scope">
                                            <inertia-link :href="'/apps/select-component?'+encryptString(scope.row)">{{scope.row.app_title}}</inertia-link>
                                        </template>
                                    </el-table-column>
                                    <el-table-column prop="app_description" :label="$t('application.description')"></el-table-column>
                                    <el-table-column prop="app_active" :label="$t('application.active')" width="150">
                                        <template slot-scope="scope">
                                            <el-tag :type="scope.row.app_active=='1'?'':'info'" size="mini">{{scope.row.app_active=='1'?$t('routine.yes'):$t('routine.no')}}</el-tag>
                                        </template>
                                    </el-table-column>
                                </el-table>
                            </div>
                        </vue-simplebar>

                        <Pagination :current-page="currentPage" :total="total" @ChangeSize="handleSizeChange" @ChangeCurrent="handleCurrentChange"></Pagination>
                    </div>
                </div>
            </div>
        </div>
        <el-dialog
            class="csfe-dialog-m-h-3"
            :title="dialogType?$t('application.new'):$t('application.edit')"
            :visible.sync="dialogFormVisible"
            :close-on-click-modal="false">
            <el-form :model="form" ref="form" label-width="100px" class="csfe-form csfe-label-left">
                <el-form-item :label="$t('application.title')" prop="app_title" :rules="isRequired">
                    <el-input clearable v-model="form.app_title" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item :label="$t('application.permission_path')" prop="app_permission_path" :rules="isRequired">
                    <el-input clearable v-model="form.app_permission_path" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item :label="$t('application.icon')" prop="app_icon" :rules="isRequired">
                    <el-input clearable class="width-90" v-model="form.app_icon" autocomplete="off"></el-input>
                    <el-tooltip class="item" effect="dark" :content="$t('application.icon_sample')" placement="top-start">
                        <a href="https://fontawesome.dashgame.com/" target="_blank">
                            <i class="el-icon-warning-outline width-7 d-inline-block text-right cursor-pointer"></i>
                        </a>
                    </el-tooltip>
                </el-form-item>
                <el-form-item :label="$t('application.description')" prop="app_description">
                    <el-input class="csfe-textarea-height" v-model="form.app_description" type="textarea" autocomplete="off"></el-input>
                </el-form-item>
                <el-form-item :label="$t('application.active')">
                    <el-radio v-model="form.app_active" label="0">{{$t('routine.no')}}</el-radio>
                    <el-radio v-model="form.app_active" label="1">{{$t('routine.yes')}}</el-radio>
                </el-form-item>
            </el-form>
            <div slot="footer" class="dialog-footer">
                <el-button @click="dialogFormVisible = false">{{$t('routine.cancel')}}</el-button>
                <el-button type="primary" @click="handConfirm">{{$t('routine.confirm')}}</el-button>
            </div>
        </el-dialog>
    </app-layout>
</template>

<script>
    import AppLayout from './../../Layouts/AppLayout'
    import Pagination from './../../Components/Pagination'

    export default {
        name: "Apps",
        components: {
            AppLayout,
            Pagination
        },
        data() {
            return {
                isRequired: [{required: true, message: this.$t('routine.required'), trigger: 'blur'}],
                tableData: [],
                dialogFormVisible: false,
                form: {},
                total: 0,
                currentPage: 1,
                dialogType: '',
            }
        },
        created() {
            this.listData();
        },
        methods:{
            handConfirm(){
                let that = this;
                that.$refs['form'].validate((valid) => {
                    if (valid) {
                        let api = that.dialogType ? that.$api.appCreate : that.$api.appUpdate;
                        that.apiOperation(api,that.form)
                    } else {
                        return false;
                    }
                });
            },
            dialogShow(Obj){
                let that = this;
                console.log(Obj)
                if (Obj){
                    Obj.app_active = Obj.app_active.toString()
                    that.form = Obj;
                    that.dialogType = false;
                    console.log(that.form)
                }
                else{
                    that.initForm();
                    that.dialogType = true;
                }
                that.dialogFormVisible = true
            },
            deleteItem(id){
                console.log(id)
                let that = this;
                that.$confirm(that.$t('routine.confirm_deletion'), that.$t('routine.prompt'), {
                    confirmButtonText: this.$t('routine.confirm'),
                    cancelButtonText: this.$t('routine.cancel'),
                    type: 'warning',
                    center: true
                }).then(() => {
                    that.apiOperation(that.$api.appDelete,{id:id})
                    that.$message({
                        type: 'success',
                        message: that.$t('routine.delete_successfully')
                    });
                }).catch(() => {});
            },
            apiOperation(api,form){
                let that = this;
                that.$ajax.post(api, form).then(res => {
                    // that.listData();
                    location.replace(location)
                    that.dialogFormVisible = false
                })
            },
            initForm(){
                let form = {
                    app_title: '',
                    app_permission_path: '',
                    app_description: '',
                    app_icon: '',
                    app_active: "0",
                }
                this.form = form;
            },
            listData(){
                let that = this;
                that.$ajax.get(that.$api.appLists).then(res => {
                    that.tableData = res.data || []
                    that.total = res.data.length || 0
                })
            },
            handleSizeChange(val) {
                this.pagesize = val;
                console.log(`每页 ${val} 条`);
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                console.log(`当前页: ${val}`);
            },
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

