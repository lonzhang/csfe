<template>
    <app-layout>
        <div class="content-header">
            <h1 class="page-title m-0">Home</h1>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card">
                    <div class="card-body calc-height">
                        <vue-simplebar style="max-height: 100%;">
                            <p> Your scrollable content goes here </p>
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
    import AppLayout from './../Layouts/AppLayout'

    export default {
        name: "Dashboard",
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
        created() {
            console.log(this.$api.testApi)
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
