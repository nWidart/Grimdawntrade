import AuctionForm from './components/AuctionForm.vue';
import AuctionList from './components/AuctionList.vue';
import MyAuctionsList from './components/MyAuctionsList.vue';
import UserAuctionsList from './components/UserAuctionsList.vue';

export default [
    {
        path: '/',
        name: 'auction.index',
        component: AuctionList,
    },
    {
        path: '/auction/new',
        name: 'auction.new',
        component: AuctionForm,
        beforeEnter: (to, from, next) => {
            if (window.AsgardCMS.logged_in === false) {
                window.location = '/auth/login';
                return;
            }
            next();
        },
    },
    {
        path: '/my/auctions',
        name: 'auction.owner',
        component: MyAuctionsList,
        beforeEnter: (to, from, next) => {
            if (window.AsgardCMS.logged_in === false) {
                window.location = '/auth/login';
                return;
            }
            next();
        },
    },
    {
        path: '/auctions/list/:userId',
        name: 'auction.list.index',
        component: UserAuctionsList,
    },
];
