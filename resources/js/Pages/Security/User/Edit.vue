<template>
    <app-layout>
        <div class="widget-top-fixed border-bottom">
            <a href="javascript:;"><i class="fa fa-save"></i>{{$t('security.save')}}</a>
            <a href="javascript:;"><i class="fa fa-save"></i>{{$t('security.save_close')}}</a>
            <a href="javascript:;"><i class="fa fa-times-circle"></i>{{$t('security.cancel')}}</a>
            <a href="javascript:;"><i class="fa fa-trash-o color-F56C6C"></i>{{$t('security.delete')}}</a>
        </div>
        <div class="content-header mt-30px">
            <h1 class="page-title m-0">{{$t('security.edit_user')}}</h1>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-0">
                    <div class="card-body clearfix">
                        <div class="col-lg-12 col-sm-12 col-md-12 p-0 pb-10px clearfix">
                            <el-button size="mini" plain>{{$t('security.copy')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.csv')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.excel')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.pdf')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.print')}}</el-button>
                            <el-button size="mini" plain>{{$t('security.column_visibility')}}</el-button>

                        </div>

                        <vue-simplebar>
                            <div class="col-lg-12 col-sm-12 col-md-12 min-w-1000 p-0">
                                sdfsdf
                            </div>
                        </vue-simplebar>

                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '../../../Layouts/AppLayout'
    export default {
        name: "Edit",
        components: {
            AppLayout
        },
    }
</script>

<style scoped>

</style>
