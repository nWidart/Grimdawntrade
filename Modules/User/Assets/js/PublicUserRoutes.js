import PublicProfile from './components/PublicProfile.vue';


const locales = window.AsgardCMS.locales;

export default [
    {
        path: '/account/profile',
        name: 'public.user.account',
        component: PublicProfile,
    },
];
