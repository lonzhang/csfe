<template>
    <div class="col-lg-12 col-sm-12 col-md-12 mt-15px">
        <el-pagination
            class="text-right"
            @size-change="handleSizeChange"
            @current-change="handleCurrentChange"
            :current-page="currentPage"
            :page-size="pSize"
            layout="slot, prev, pager, next"
            :total="pTotal">
            <span class="float-left">Total {{pTotal}} Records</span>
        </el-pagination>
    </div>
</template>

<script>
    export default {
        name: "Pagination",
        data(){
            return {
                cPage:this.currentPage,
                pSize:this.pageSize,
                pTotal:this.total,
            }
        },
        props: {
            pageSize:{
                type: Number,
                default: 20
            },
            currentPage:{
                type: Number,
                default: 1
            },
            total:{
                type: Number,
                default: 0
            }
        },
        methods:{
            handleSizeChange(val){
                this.$emit('ChangeSize',val)
            },
            handleCurrentChange(val){
                this.$emit('ChangeCurrent',val)
            }
        },
        watch:{
            total (newTotal,oldTotal) {
                console.log(newTotal, oldTotal)
                this.pTotal = newTotal
            }
        }
    }
</script>

<style scoped>

</style>
