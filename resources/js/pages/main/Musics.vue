<template>
    <horizontalMenu :headers="blocks"></horizontalMenu>
    <toggleContent :blocks="blocks"></toggleContent>
    {{ $store.state.player.track_index }}
    <div class="grid2">
        <div v-for="(track,index) in track_list" class="content-row-header" @click="$store.commit('player/current_track', index)">
            <div class="link-cont">
                <div class="content-author">
                    <span class="avatar">
                        <img src="/img/album-poster.jpg" alt="" class="treks-poster">
                        <button class="fa fa-play"></button>
                    </span>
                    <div style="width: 100%;">
                        <slot name="other-info-0">
                        </slot>
                        <a class="author-name">{{ track.name }}</a>
                        <a href="qewqw" class="other-info">
                            {{ track.artist }}
                        </a>
                    </div>
                </div>
                <flickr>
                    <template v-slot:more-btns>
                        <button class="moreBtn fa fa-indent"></button>
                        <button class="moreBtn fa fa-plus-square-o"></button>
                    </template>
                </flickr>
                <span class="trek-duration">
                4:34
            </span>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Musics",
    data(){
        return{
            flickrVisibility: false,
            blocks: {
                musics:'Моя муызка',
                explore: 'Обзор'
            },
            track_list: [
                {
                    name: "Moonlight",
                    artist: "Beethoven",
                    image: "Image URL",
                    path: "https://upload.wikimedia.org/wikipedia/commons/e/eb/Beethoven_Moonlight_1st_movement.ogg"
                },
                {
                    name: "Symphony no.40",
                    artist: "Amadeus Mozart",
                    image: "Image URL",
                    path: "https://upload.wikimedia.org/wikipedia/commons/9/99/Wolfgang_Amadeus_Mozart_-_Symphony_40_g-moll_-_1._Molto_allegro.ogg"
                },
                {
                    name: "Claire De Lune",
                    artist: "Claude Debussy",
                    image: "Image URL",
                    path: "https://upload.wikimedia.org/wikipedia/commons/b/be/Clair_de_lune_%28Claude_Debussy%29_Suite_bergamasque.ogg",
                },
            ],

        }
    },

}
import Flickr from "../../components/UI/flickr";
</script>

<style lang="scss" scoped>

    .trek-duration{
        font-size: 14px;
        padding-right: 10px;
        color: #aaa;
        display: block;
    }
    progress{
    }
    .link-cont{
        transition: 0.1s;
        .moreActionsBtn{
            display: none;
        }
        &:hover{
            .moreActionsBtn{
                display: block;
            }
            .trek-duration{
                display: none;
            }
            .fa-play{
                background-color: rgba(0,0,0,0.5);
                color: white;
            }
        }
    }
    .avatar{
        border-radius: 7px;
        overflow: hidden;
        width: 45px;
        min-width: 45px;
        height: 45px;
        img{
            border-radius: 0;
        }
        position: relative;
        .fa-play{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            color: transparent;
            text-align: center;
            line-height: 45px;
            transition: 0.1s;
        }
    }
</style>
