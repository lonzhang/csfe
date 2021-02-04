<template>
    <app-layout>
        <div class="content-header">
            <h1 class="page-title m-0">{{$t('security.user_title')}}</h1>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body calc-height">
                        <div class="w-100">
                            psodf
                        </div>
                        <vue-simplebar style="max-height: 100%;">

                            <el-table :data="tableData">
                                <el-table-column prop="date" label="日期" width="140">
                                </el-table-column>
                                <el-table-column prop="name" label="姓名" width="120">
                                </el-table-column>
                                <el-table-column prop="address" label="地址">
                                </el-table-column>
                            </el-table>


                        </vue-simplebar>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../Layouts/AppLayout'
    export default {
        name: "Index",
        components: {
            AppLayout
        },
        data() {
            const item = {
                date: '2016-05-02',
                name: '王小虎',
                address: '上海市普陀区金沙江路 1518 弄'
            };
            return {
                tableData: Array(20).fill(item)
            }
        },
    }
</script>

<style scoped>

</style>
