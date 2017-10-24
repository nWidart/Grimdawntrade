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
                        <el-form-item label="Hardcore">
                            <el-select v-model="search.hardcore" placeholder="Select" @change="searchAuctions">
                                <el-option
                                        v-for="bool in booleanValues"
                                        :key="bool.value"
                                        :label="bool.name"
                                        :value="bool.value">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Mythical">
                            <el-select v-model="search.mythical" placeholder="Select" clearable filterable @change="searchAuctions">
                                <el-option
                                        v-for="bool in booleanValues"
                                        :key="bool.value"
                                        :label="bool.name"
                                        :value="bool.value">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Type">
                            <el-select v-model="search.type_id" placeholder="Select" clearable filterable @change="searchAuctions">
                                <el-option
                                        v-for="type in types"
                                        :key="type.id"
                                        :label="type.name"
                                        :value="type.id">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="Rarity">
                            <el-select v-model="search.rarity_id" placeholder="Select" clearable filterable @change="searchAuctions">
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
                    <h3>Auctions of {{ currentUser.display_name }} <span class="label label-primary">{{ auctions.length }}</span></h3>
                    <el-table
                            :data="auctions"
                            style="width: 100%"
                            :default-expand-all="true"
                            v-loading.body="tableIsLoading">
                        <el-table-column type="expand">
                            <template slot-scope="props">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Type</strong>: {{ props.row.item.type ? props.row.item.type.name : '' }}</p>
                                        <p><strong>Rarity</strong>: {{ props.row.item.rarity ? props.row.item.rarity.name : '' }}</p>
                                        <p><strong>Hardcore</strong>: {{ props.row.is_hardcore ? 'Yes' : 'No' }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Mythical</strong>: {{ props.row.item.is_mythical ? 'Yes' : 'No' }}</p>
                                        <p><strong>Level requirement</strong>: {{ props.row.item.level }}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <div v-if="props.row.prices.length > 0">
                                            <strong>Wanted items:</strong>
                                            <span v-for="(item, idx) in props.row.prices" :key="idx">
                                                <span :style="`color: ${getColor(item.rarity)}`">{{ item.name }}</span>,
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Name"
                                prop="item.name">
                            <template slot-scope="scope">
                                <span :style="`color: ${getColor(scope.row.item.rarity)}`">{{ scope.row.item.name }}</span>
                            </template>
                        </el-table-column>
                        <el-table-column
                                label="Time"
                                width="150"
                                prop="time_ago">
                        </el-table-column>
                        <el-table-column prop="actions" label="Actions" width="130">
                            <template slot-scope="auction">
                                <el-button size="small"
                                           @click="goToSteamProfile(scope)"
                                           v-if="auction.row.user.steam_profile_link !== null">
                                    Steam Profile
                                </el-button>
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
                currentUser: {},
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
                const { userId } = this.$route.params;
                axios.get(route('api.item.list.auctions.search', _.merge(this.search, { user: userId })))
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
            fetchUserAuctions() {
                this.tableIsLoading = true;
                const { userId } = this.$route.params;
                axios.get(route('api.item.list.auctions.index', { user: userId }))
                    .then((response) => {
                        this.tableIsLoading = false;
                        this.auctions = response.data.data;
                    });
            },
            findUser() {
                const { userId } = this.$route.params;
                axios.get(route('p.api.find-user', { user: userId }))
                    .then((response) => {
                        this.currentUser = response.data.data;
                    });
            },
            goToSteamProfile(scope) {
                window.open(scope.row.user.steam_profile_link, '_blank');
            },
            getColor(rarity) {
                if (rarity !== null) {
                    return rarity.color;
                }
                return '#000';
            },
        },
        mounted() {
            this.fetchTypes();
            this.fetchRarities();
            this.fetchUserAuctions();
            this.findUser();
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
