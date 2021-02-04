<template>
    <div class="csfe-flex csfe-min-height-100vh">
        <div class="csfe-flex-item login_bg"></div>
        <div class="csfe-flex-item login_box">
            <div class="login-from">
                <div class="login-logo csfe-flex">
                    <img :src="$global.loginLogo" alt="">
                </div>
                <div class="mt-4">
                    <el-form label-position="top" :model="loginForm" ref="loginForm">
                        <div class="position-relative">
                            <i class="login-icon font-24 el-icon-user-solid"></i>
                            <el-form-item class="pl-40 login-input" prop="email" :rules="isRequired">
                                <el-col :span="24">
                                    <el-input v-model="loginForm.email" :placeholder="$t('login.email')" class="col-12 p-0"></el-input>
                                </el-col>
                            </el-form-item>
                        </div>
                        <div class="position-relative">
                            <i class="login-icon font-24 el-icon-lock"></i>
                            <el-form-item class="pl-40 login-input" prop="password" :rules="isRequired">
                                <el-col :span="24">
                                    <el-input v-model="loginForm.password" :placeholder="$t('login.password')" type="password" class="col-12 p-0"></el-input>
                                </el-col>
                            </el-form-item>
                        </div>
                    </el-form>
                    <el-button @click="getLogin" type="primary" class="w-100 login-btn mt-3" :icon="loading?'el-icon-loading':''">Login</el-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loginForm:{
                    email:'',
                    password:''
                },
                isRequired: [{required: true, message: this.$t('routine.required'), trigger: 'blur'}],
                loading:false,
            }
        },

        methods: {
            getLogin(){
                let that = this;
                that.loading = true;
                that.$refs['loginForm'].validate((valid) => {
                    if (valid) {
                        that.$ajax.post('/logins', this.loginForm).then(res => {
                            if (res.data.status != 1) {
                                this.$refs['loginForm'].fields[res.data.state].validateMessage = this.$t('login.'+res.data.message)
                                this.$refs['loginForm'].fields[res.data.state].validateState = 'error'
                            }else {
                                window.location.href = '';
                            }
                            that.loading = false
                        })

                    } else {
                        window.location.href = '/home';
                        return false;
                    }
                });

            }
        }
    }
</script>

<style scoped>
    .login-from{ padding: 20px;}
    .login-logo img{ width: 136px; margin: 0 20px; display: inline-block;}
    .login-logo:after,.login-logo:before{ content: ''; width: 80px; height: 1px; background-color: #9e9e9e; display: inline-block;}
    .login-icon{ position: absolute; left: 0; top: 50%; margin-top: -12px;}
</style>
