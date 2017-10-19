<template>
    <div>
        <el-menu  default-active="home" class="el-menu-demo" mode="horizontal" style="margin-bottom: 20px" :router="true">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <el-menu-item index="home" :route="{name: 'auction.index'}">Grim Dawn Trade</el-menu-item>
                        <el-menu-item index="post" :route="{name: 'auction.new'}">Post Item</el-menu-item>
                        <el-menu-item index="my-items" :route="{name: 'auction.owner'}">My Auctions</el-menu-item>

                        <div class="pull-right">
                            <a href="/auth/login" v-if="isLoggedIn() === false">
                                <el-menu-item index="login">
                                    <span slot="title">Login</span>
                                </el-menu-item>
                            </a>
                            <a href="/auth/register"  v-if="isLoggedIn() === false">
                                <el-menu-item index="login">
                                    <span slot="title">Register</span>
                                </el-menu-item>
                            </a>
                            <a href="/auth/logout"  v-if="isLoggedIn() === true">
                                <el-menu-item index="login">
                                    <span slot="title">Logout</span>
                                </el-menu-item>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </el-menu>
    </div>
</template>

<script>
    export default {
        data() {
            return {};
        },
        methods: {},
        mounted() {

        },
    };
</script>
