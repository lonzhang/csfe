<template>
    <app-layout>
        <div class="widget-top-fixed border-bottom">
            <a href="javascript:;"><i class="fa fa-plus color-67C23A"></i>{{$t('security.new')}}</a>
            <a href="javascript:;"><i class="fa fa-refresh"></i>{{$t('security.refresh')}}</a>
        </div>
        <div class="content-header mt-30px">
            <h1 class="page-title m-0">
                <span>{{$t('menu.business_units')}}</span>
            </h1>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-0">
                    <div class="card-body clearfix">
                        <div class="col-lg-12 col-sm-12 col-md-12 p-0 pb-10px clearfix">

                            <div class="float-left">
                                <el-dropdown trigger="click" placement="bottom-start" @command="handTeams">
                                    <span>{{teamsName}}</span>
                                    <i class="fa fa-angle-down"></i>
                                    <el-dropdown-menu>
                                        <el-dropdown-item v-for="(mItem,mIndex) in teamsList" :command="mIndex" :key="mIndex">{{mItem.name}}</el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </div>
                           <div class="float-right">
                               {{ $t('security.search') }}:
                               <el-input
                                   style="width: 150px"
                                   v-model="search"
                                   size="mini"
                                   :placeholder="$t('security.search')"/>
                           </div>
                        </div>

                        <vue-simplebar>
                            <div class="col-lg-12 col-sm-12 col-md-12 p-0">
                                <el-table
                                    class="min-w-600"
                                    max-height="570"
                                    ref="multipleTable"
                                    :empty-text="$t('routine.no_data')"
                                    :data="searchInput(tableData)"
                                    @selection-change="handleSelectionChange">
                                    <el-table-column type="selection" width="55" align="center"></el-table-column>
                                    <el-table-column prop="name" :label="$t('security.name')" width="200" sortable></el-table-column>
                                    <el-table-column prop="main_phone" :label="$t('security.main_phone')" width="200"></el-table-column>
                                    <el-table-column prop="website" :label="$t('security.website')" width="200">
                                        <template slot-scope="scope">
                                            <p class="t-o-ellipsis mb-0">{{scope.row.website}}</p>
                                        </template>
                                    </el-table-column>
                                    <el-table-column prop="parent_business" :label="$t('security.parent_business')"></el-table-column>
                                </el-table>
                            </div>
                        </vue-simplebar>

                        <div class="col-lg-12 col-sm-12 col-md-12 mt-15px">
                            <el-pagination
                                class="text-right"
                                @size-change="handleSizeChange"
                                @current-change="handleCurrentChange"
                                :current-page="currentPage"
                                :page-sizes="$global.pageSizes"
                                :page-size="pageSize"
                                layout="slot, prev, pager, next"
                                :total="total">
                                <span class="float-left">Total {{total}} Records</span>
                            </el-pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../../Layouts/AppLayout'
    export default {
        name: "Index",
        components: {
            AppLayout
        },
        data() {

            return {
                tableData: [
                    { name: '王小虎', main_phone: '+856 1325554641', website:'http://csfe.com/business-units', parent_business:'Cargo Services (Production)'},
                    { name: '王小虎', main_phone: '+856 1325554641', website:'http://csfe.com/business-units', parent_business:'Cargo Services (Production)'},
                    { name: '王小虎', main_phone: '+856 1325554641', website:'http://csfe.com/business-units', parent_business:'Cargo Services (Production)'},
                    { name: '王小虎', main_phone: '+856 1325554641', website:'http://csfe.com/business-units', parent_business:'Cargo Services (Production)'},
                    { name: '王小虎', main_phone: '+856 1325554641', website:'http://csfe.com/business-units', parent_business:'Cargo Services (Production)'},
                    { name: '王小虎', main_phone: '+856 1325554641', website:'http://csfe.com/business-units', parent_business:'Cargo Services (Production)'},
                    { name: '王小虎', main_phone: '+856 1325554641', website:'http://csfe.com/business-units', parent_business:'Cargo Services (Production)'},
                    { name: '王小虎', main_phone: '+856 1325554641', website:'http://csfe.com/business-units', parent_business:'Cargo Services (Production)'},
                ],
                search: '',
                total: 400,
                pageSize: 10,
                currentPage: 1,

                teamsList:[
                    {id:1,name:'Active Business Units'},
                    {id:2,name:'teams1'},
                ],
                teamsId:'',
                teamsName:'',
                multipleSelection:[]
            }
        },
        created() {
            this.handTeams();
        },
        methods: {
            handleSelectionChange(val) {
                console.log(val)
                this.multipleSelection = val;
            },
            handTeams(command){
                if (command||command==0){
                    this.teamsId = this.teamsList[command].id
                    this.teamsName = this.teamsList[command].name
                }else {
                    this.teamsId = this.teamsList[0].id
                    this.teamsName = this.teamsList[0].name
                }
            },
            handleSizeChange(val) {
                this.pagesize = val;
                console.log(`每页 ${val} 条`);
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                console.log(`当前页: ${val}`);
            },

            searchInput: function () {
                let _search = this.search.toLowerCase();
                if (_search) {
                    //不区分大小写处理
                    return this.tableData.filter(function (e) {
                        return Object.keys(e).some(function (key) {
                            return String(e[key]).toLowerCase().indexOf(_search) > -1;
                        })
                        // 匹配某个字段
                        // return e.ol_order_no.match(searchReg) || e.ol_status.match(statusReg);
                    })
                };
                return this.tableData;
            }
        },
    }
</script>

<style scoped>

</style>
