<template>
    <app-layout>
        <div class="widget-top-fixed border-bottom">
            <a href="javascript:;"><i class="fa fa-refresh"></i>{{$t('security.refresh')}}</a>
        </div>
        <div class="content-header mt-30px pb-16px">
            <el-dropdown trigger="click" placement="bottom-start" @command="handTeams">
                <h1 class="page-title m-0">
                    <span>{{teamsName}}</span>
                    <i class="fa fa-angle-down"></i>
                </h1>
                <el-dropdown-menu>
                    <el-dropdown-item v-for="(mItem,mIndex) in teamsList" :command="mIndex" :key="mIndex">{{mItem.name}}</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-0">
                    <div class="card-body clearfix">
                        <div class="col-lg-12 col-sm-12 col-md-12 p-0 pb-10px clearfix">

                           <div class="float-left">
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
                                    :data="searchInput(tableData)">
                                    <el-table-column prop="date" :label="$t('security.team_name')" width="300" sortable></el-table-column>
                                    <el-table-column prop="address" :label="$t('security.business_unit')"></el-table-column>
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
                                :page-size="10"
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
                    {
                        date: '2016-05-03',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                        date: '2016-05-02',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                        date: '2016-05-04',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                        date: '2016-05-01',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                        date: '2016-05-08',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                        date: '2016-05-03',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                        date: '2016-05-02',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                        date: '2016-05-04',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                        date: '2016-05-01',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                        date: '2016-05-08',
                        name: '王小虎',
                        address: '上海市普陀区金沙江路 1518 弄'
                    }, {
                    date: '2016-05-06',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }, {
                    date: '2016-05-07',
                    name: '王小虎',
                    address: '上海市普陀区金沙江路 1518 弄'
                }],
                search: '',
                total: 400,
                pageSize: 10,
                currentPage: 1,

                teamsList:[
                    {id:1,name:'All Owner Teams'},
                    {id:2,name:'teams1'},
                ],
                teamsId:'',
                teamsName:'',
            }
        },
        created() {
            this.handTeams();
        },
        methods: {
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
                console.log(`每页 ${val} 条`);
            },
            handleCurrentChange(val) {
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
