import {createRouter, createWebHistory} from "vue-router"

import Main  from "../pages/main/Main";
import Profile from "../pages/main/Profile";
import Friends from "../pages/main/Friends";
import Messenger from "../pages/main/Messenger";
import Videos from "../pages/main/Videos";
import Musics from "../pages/main/Musics";
import Groups from "../pages/main/Groups";
import Games from "../pages/main/Games";
import Photos from "../pages/main/Photos";
import Bookmarks from "../components/Bookmarks";
import Settings from "../pages/main/Settings";

import onlineFriend from "../pages/subPages/friends/onlineFriend";
import allFriends from "../pages/subPages/friends/allFriend";
import userPhotos from "../pages/subPages/user/userPhotos";
import userHistory from "../pages/subPages/user/userHistory";
import userPublications from "../pages/subPages/user/userPublications";
import userMarks from "../pages/subPages/user/userMarks";
import userMusics from "../pages/subPages/user/userMusics";
import unread from "../pages/subPages/messenger/unread";
import read from "../pages/subPages/messenger/read";
import room from "../pages/subPages/messenger/room";


import AllGroups from "../pages/subPages/groups/AllGroups";
import MyGroups from "../pages/subPages/groups/my-groups";

import RightMessenger from "../pages/rightSide/RightMessages";
import RightMain from "../pages/rightSide/RightMain";
import RightGroups from "../pages/rightSide/RightGroups";
import RightFriends from "../pages/rightSide/RightFriends";

import Register from "../pages/Register";
import Login from "../components/Login";
import incomingFriends from "../pages/subPages/friends/incomingFriends";
import outgoingFriends from "../pages/subPages/friends/outgoingFriends";
import general from "../pages/subPages/settings/general";
import security from "../pages/subPages/settings/security";
import privacy from "../pages/subPages/settings/privacy";
import notifications from "../pages/subPages/settings/notifications";
import blacklist from "../pages/subPages/settings/blacklist";
import help from "../pages/subPages/settings/help";


const route = [
    {
        path: '/register',
        component: Register,
        name: 'register',
        meta : {
            guard : 'guest'
        },
    },
    {
        path: '/bookmarks',
        component: Bookmarks,
        name: 'bookmarks',
    },
    {
        path: '/settings',
        component: Settings,
        name: 'settings',
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
        meta : {
            guard : 'guest'
        }
    },
    {
        path: '/',
        name: 'home',
        components: {
            default: Main,
            RightSide: RightMain,
        }
    },
    {
        path: '/user/:id',
        component: Profile,
        children: [
            {
                path: '',
                component: userPublications
            },
            {
                path: 'history',
                component: userHistory
            },
            {
                path: 'videos',
                component: userHistory
            },
            {
                path: 'photos',
                component: userPhotos
            },
            {
                path: 'marks',
                component: userMarks
            },
            {
                path: 'musics',
                component: userMusics
            }
        ]

    },
    {
        path: '/friends',
        components:{
            default: Friends,
            RightSide: RightFriends
        },
        children: [
            {
                path: '',
                component: allFriends
            },
            {
                path: 'online',
                component: onlineFriend
            },
            {
                path: 'outgoing',
                component: outgoingFriends
            },
            {
                path: 'incoming',
                component: incomingFriends
            }
        ]
    },
    {
        path: '/set',
        components:{
            default: Settings
        },
        children: [
            {
              path: '',
              component: general
            },
            {
                path: 'security',
                component: security
            },
            {
                path: 'privacy',
                component: privacy
            },
            {
                path: 'notifications',
                component: notifications
            },
            {
                path: 'blacklist',
                component: blacklist
            },
            {
                path: 'help',
                component: help
            }
        ]
    },
    {
        path: '/messenger',
        components: {
            default: Messenger,
            RightSide: RightMessenger,
        },
        children: [
            {
                path: '',
                component: read
            },
            {
                path: 'room/:id',
                component: room
            },
            {
                path: 'unread',
                component: unread
            },
        ]
    },
    {
        path: '/groups',
        components: {
            default: Groups,
            RightSide: RightGroups
        },
        children: [
            {
                path: '',
                component: AllGroups
            },
            {
                path: '/my-groups',
                component: MyGroups
            }
        ]
    },
    {
        path: '/games',
        component: Games
    },
    {
        path: '/videos',
        component: Videos
    },
    {
        path: '/musics',
        component: Musics
    },
    {
        path: '/profile',
        component: Profile,
        children: [
            {
              path: '',
              component: userPublications
            },
            {
                path: 'history',
                component: userHistory
            },
            {
                path: 'videos',
                component: userHistory
            },
            {
                path: 'photos',
                component: userPhotos
            },
            {
                path: 'marks',
                component: userMarks
            },
            {
                path: 'musics',
                component: userMusics
            }
        ]

    },
    {
        path: '/photos',
        component: Photos
    },

]

const router = createRouter({
    routes: route,
    history: createWebHistory(process.env.BASE_URl)
})

export default router
