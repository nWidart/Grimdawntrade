<template>
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <div class="box-inner">
                    <h3>Search</h3>
                    <el-form ref="form" :model="search" label-position="top" @keyup.enter.native="searchAuctions()">
                        <el-form-item label="Name">
                            <el-input v-model="search.name" @blur="searchAuctions()"></el-input>
                        </el-form-item>
                        <el-form-item label="Mythical">
                            <el-select v-model="search.mythical" placeholder="Select" @change="searchAuctions">
                                <el-option
                                        v-for="bool in booleanValues"
                                        :key="bool.value"
                                        :label="bool.name"
                                        :value="bool.value">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Type">
                            <el-select v-model="search.type_id" placeholder="Select" @change="searchAuctions">
                                <el-option
                                        v-for="type in types"
                                        :key="type.id"
                                        :label="type.name"
                                        :value="type.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Rartiry">
                            <el-select v-model="search.rarity_id" placeholder="Select" @change="searchAuctions">
                                <el-option
                                        v-for="rarity in rarities"
                                        :key="rarity.id"
                                        :label="rarity.name"
                                        :value="rarity.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <div class="block">
                            <el-form-item label="Level Requirement">
                                <el-slider
                                        v-model="search.level_range"
                                        range
                                        show-stops
                                        :max="100"
                                        :step="5"
                                        @change="searchAuctions">
                                </el-slider>
                            </el-form-item>

                        </div>
                    </el-form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="box-inner">
                    <h3>My Auctions</h3>
                    <el-table
                            :data="auctions"
                            style="width: 100%"
                            :default-expand-all="true"
                            v-loading.body="tableIsLoading">
                        <el-table-column type="expand">
                            <template slot-scope="props">
                                <p><strong>Type</strong>: {{ props.row.item.type.name }}</p>
                                <p><strong>Rarity</strong>: {{ props.row.item.rarity.name }}</p>
                                <p><strong>Mythical</strong>: {{ props.row.item.is_mythical ? 'Yes' : 'No' }}</p>
                                <p><strong>Level requirement</strong>: {{ props.row.item.level }}</p>
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Name"
                                prop="item.name">
                            <template slot-scope="scope">
                                <span :style="`color: ${scope.row.item.rarity.color}`">{{ scope.row.item.name }}</span>
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Time"
                                prop="time_ago">
                        </el-table-column>
                        <el-table-column prop="actions" label="Actions">
                            <template slot-scope="auction">
                                <el-button type="danger" size="small" @click="removeAuction(auction)">Remove</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
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
                form: new Form(),
                search: {
                    name: '',
                    type_id: '',
                    rarity_id: '',
                    mythical: '',
                },
                types: [],
                rarities: [],
                auctions: [],
                tableIsLoading: false,
                isLatest: true,
                booleanValues: [
                    {
                        value: null,
                        name: 'Any',
                    },
                    {
                        value: 1,
                        name: 'Yes',
                    },
                    {
                        value: 0,
                        name: 'No',
                    },
                ],
            };
        },
        methods: {
            searchAuctions() {
                this.tableIsLoading = true;
                axios.get(route('api.item.my.auctions.search', this.search))
                    .then((response) => {
                        this.tableIsLoading = false;
                        this.auctions = response.data.data;
                        this.isLatest = false;
                    });
            },
            fetchTypes() {
                axios.get(route('api.item.type.index'))
                    .then((response) => {
                        this.types = response.data.data;
                        this.types.unshift({ id: 'any', name: 'Any' });
                    });
            },
            fetchRarities() {
                axios.get(route('api.item.rarity.index'))
                    .then((response) => {
                        this.rarities = response.data.data;
                        this.rarities.unshift({ id: 'any', name: 'Any' });
                    });
            },
            fetchMyAuctions() {
                this.tableIsLoading = true;
                axios.get(route('api.item.my.auctions.index'))
                    .then((response) => {
                        this.tableIsLoading = false;
                        this.auctions = response.data.data;
                    });
            },
            removeAuction(auction) {
                this.$confirm('Are you sure?', 'Confirm', {
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    type: 'warning',
                    confirmButtonClass: 'el-button--danger',
                }).then(() => {
                    const vm = this;
                    axios.delete(route('api.item.my.auctions.delete', { auction: auction.row.id }))
                        .then((response) => {
                            if (response.data.errors === false) {
                                vm.$message({
                                    type: 'success',
                                    message: response.data.message,
                                });
                                this.fetchMyAuctions();
                            }
                        })
                        .catch((error) => {
                            vm.$message({
                                type: 'error',
                                message: error.data.message,
                            });
                        });
                });
            },
        },
        mounted() {
            this.fetchTypes();
            this.fetchRarities();
            this.fetchMyAuctions();
        },
    };
</script>
<style>
    h3 {
        margin-top: 0;
    }
    .el-select {
        width: 100%;
    }
</style>
