<template>
    <div>
        <div class="box">
            <div class="box-inner">
                <el-form ref="form" :model="item" label-width="200px"  v-loading.body="loading">
                    <h3 style="margin-top:0;">
                        Post new auction
                    </h3>
                    <el-form-item label="Item Name"
                                  :class="{'el-form-item is-error': form.errors.has('name') }">
                        <el-select
                                v-model="item.name"
                                filterable
                                remote
                                allow-create
                                placeholder="Start typing item name"
                                :remote-method="searchItems"
                                @change="selectItem"
                                :loading="itemsLoading">
                            <el-option
                                    v-for="item in items"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                            </el-option>
                        </el-select>
                        <div class="el-form-item__error" v-if="form.errors.has('name')"
                             v-text="form.errors.first('name')"></div>
                    </el-form-item>
                    <el-form-item label="Item minimum level">
                        <el-input v-model="item.level" type="number"></el-input>
                    </el-form-item>
                    <el-form-item label="Mythical">
                        <el-checkbox v-model="item.is_mythical">Mythical</el-checkbox>
                    </el-form-item>
                    <el-form-item label="Type">
                        <el-select v-model="item.type_id" placeholder="Select">
                            <el-option
                                    v-for="type in types"
                                    :key="type.id"
                                    :label="type.name"
                                    :value="type.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="Rartiry">
                        <el-select v-model="item.rarity_id" placeholder="Select">
                            <el-option
                                    v-for="rarity in rarities"
                                    :key="rarity.id"
                                    :label="rarity.name"
                                    :value="rarity.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit">Create</el-button>
                        <el-button>Cancel</el-button>
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
                item: {
                    name: '',
                    type_id: '',
                    rarity_id: '',
                    is_mythical: 0,
                    level: '',
                },
                form: new Form(),
                types: [],
                rarities: [],
                items: [],
                itemsLoading: false,
                loading: false,
                foundItem: false,
            };
        },
        methods: {
            onSubmit() {
                this.form = new Form(this.item);
                this.loading = true;

                this.form.post(route('api.item.auction.store'))
                    .then((response) => {
                        this.loading = false;
                        this.$message({
                            type: 'success',
                            message: response.message,
                        });
                        this.$router.push({ name: 'auction.index' });
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
            selectItem(item) {
                if (Number.isInteger(item) === true) {
                    this.findItem(item);
                }
            },
            findItem(id) {
                this.loading = true;
                axios.get(route('api.item.item.find', { item: id }))
                    .then((response) => {
                        this.loading = false;
                        this.item = response.data.data;
                    });
            },
            searchItems(query) {
                this.itemsLoading = true;
                axios.get(route('api.item.item.search', { query }))
                    .then((response) => {
                        this.itemsLoading = false;
                        this.items = response.data.data;
                    });
            },
            fetchTypes() {
                axios.get(route('api.item.type.index'))
                    .then((response) => {
                        this.types = response.data.data;
                    });
            },
            fetchRarities() {
                axios.get(route('api.item.rarity.index'))
                    .then((response) => {
                        this.rarities = response.data.data;
                    });
            },
        },
        mounted() {
            this.fetchTypes();
            this.fetchRarities();
        },
    };
</script>
<style>
    .el-select {
        width: 100%;
    }
</style>
