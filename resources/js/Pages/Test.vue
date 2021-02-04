<template>
    <app-layout>
        <div class="content-header">
            <h1 class="page-title m-0" @click="windowActions('这是测试')">{{windowCheck}}-增加</h1>
            <h1 class="page-title m-0" @click="remove('windowCheck')">清除</h1><br>
            <div @click="removeAll">sdf</div>

<!--            <div v-for="item in $page.props.common.app_menu[2]">-->
<!--                <pre>{{$page.props.common.app_menu}}</pre>-->
<!--                <hr>-->
<!--            </div>-->
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
    import {mapActions, mapGetters} from 'vuex'

    export default {
        name: "Test",
        components: {
            AppLayout
        },

        computed: {
            ...mapGetters(['windowCheck']) // 动态计算属性，相当于this.$store.getters.windowCheck
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
        },
        methods:{
            ...mapActions( // 语法糖
                ['windowActions','remove','removeAll'] // 相当于this.$store.dispatch('windowActions'),提交这个方法
            ),
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
