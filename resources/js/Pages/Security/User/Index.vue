<template>
    <app-layout>
        <div class="widget-top-fixed border-bottom">
            <a href="javascript:;"><i class="fa fa-plus color-67C23A"></i>{{$t('security.new')}}</a>
            <a href="javascript:;"><i class="fa fa-trash-o color-F56C6C"></i>{{$t('security.delete')}}</a>
            <a href="javascript:;"><i class="fa fa-refresh"></i>{{$t('security.refresh')}}</a>
            <a href="javascript:;"><i class="fa fa-download"></i>{{$t('security.export')}}</a>
        </div>
        <div class="content-header mt-30px">
            <h1 class="page-title m-0">{{$t('security.user_title')}}</h1>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-0">
                    <div class="card-body clearfix">
                        <div class="col-lg-12 col-sm-12 col-md-12  p-0 pb-10px clearfix">
                            <el-button size="mini" plain>{{$t('security.copy')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.csv')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.excel')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.pdf')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.print')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.column_visibility')}}</el-button>

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
                                    class="min-w-1000"
                                    max-height="570"
                                    ref="multipleTable"
                                    :empty-text="$t('routine.no_data')"
                                    :data="searchInput(tableData)"
                                    @selection-change="handleSelectionChange">
                                    <el-table-column type="selection" width="55" align="center"></el-table-column>
                                    <el-table-column prop="id" :label="$t('security.id')" width="80" sortable></el-table-column>
                                    <el-table-column prop="name" :label="$t('security.name')" width="150" sortable>
                                        <template slot-scope="scope">
                                            <inertia-link href="/user/edit">{{scope.row.name}}</inertia-link>
                                        </template>
                                    </el-table-column>
                                    <el-table-column prop="email" :label="$t('security.email')" width="300" sortable></el-table-column>
                                    <el-table-column prop="business_unit" :label="$t('security.business_unit')" width="300" sortable></el-table-column>
                                    <el-table-column prop="roles" :label="$t('security.roles')">
                                        <template slot-scope="scope">
                                            <span v-for="item in scope.row.roles" class="mr-3px">
                                                <el-tag size="mini" cl>{{item.name}}</el-tag>
                                            </span>
                                        </template>
                                    </el-table-column>
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
                    {id:1,name:'张小虎',email:'zhangxiaohu@qq.com',business_unit:'CS-PAC',roles:[{name:'cs-test1'},{name:'cs-test2'},]},
                    {id:1,name:'张小虎',email:'zhangxiaohu@qq.com',business_unit:'CS-PAC',roles:[{name:'cs-test1'},{name:'cs-test2'},]},
                    {id:1,name:'张小虎',email:'zhangxiaohu@qq.com',business_unit:'CS-PAC',roles:[{name:'cs-test1'},{name:'cs-test2'},]},
                    {id:1,name:'张小虎',email:'zhangxiaohu@qq.com',business_unit:'CS-PAC',roles:[{name:'cs-test1'},{name:'cs-test2'},]},
                ],
                search: '',
                total: 400,
                pageSize: 10,
                currentPage: 1,
                multipleSelection:[]
            }
        },
        methods: {
            handleSelectionChange(val) {
                console.log(val)
                this.multipleSelection = val;
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
