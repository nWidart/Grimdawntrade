<template>
    <div>
        <div class="box">
            <div class="box-inner">
                <el-form ref="form" :model="profile" label-width="200px"  v-loading.body="loading">
                    <h3 style="margin-top:0;">
                        Update your profile
                    </h3>

                    <el-form-item label="Display name">
                        <el-input v-model="profile.display_name"></el-input>
                    </el-form-item>
                    <el-form-item label="Steam Profile Link">
                        <el-input v-model="profile.steam_profile_link"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button type="primary" @click="onSubmit">Update</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Form from 'form-backend-validation';

    export default {
        data() {
            return {
                profile: {},
                loading: false,
                form: new Form(),
            };
        },
        methods: {
            onSubmit() {
                this.form = new Form(this.profile);
                this.loading = true;

                this.form.post(route('p.api.account.profile.update'))
                    .then((response) => {
                        this.loading = false;
                        this.$message({
                            type: 'success',
                            message: response.message,
                        });
                    })
                    .catch((error) => {
                        console.log(error);
                        this.loading = false;
                        this.$notify.error({
                            title: 'Error',
                            message: 'There are some errors in the form.',
                        });
                    });
            },
            fetchProfile() {
                this.loading = true;
                axios.get(route('p.api.account.profile.find-current-user'))
                    .then((response) => {
                        this.loading = false;
                        this.profile = response.data.data;
                    });
            },
        },
        mounted() {
            this.fetchProfile();
        },
    };
</script>
