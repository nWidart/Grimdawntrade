import AuctionForm from './components/AuctionForm.vue';
import AuctionList from './components/AuctionList.vue';

export default [
    {
        path: '/auctions',
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
];
