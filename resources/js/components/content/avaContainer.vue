<template>
    <div class="avas-container">
        <swiper :slidesPerView="'auto'"
                :spaceBetween="5"
                :freeMode="true"
                :slidesPerGroup="3"
                :navigation="true"
                class="mySwiper">
            <swiper-slide v-for="u in 15">
                <a href="">
                    <contentAuthor class="ava-container" avatar-size="55"></contentAuthor >
                </a>
            </swiper-slide>
        </swiper>
    </div>
</template>

<script>

import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';

import "swiper/css/free-mode"
import "swiper/css/pagination"
import "swiper/css/navigation"

import SwiperCore, {FreeMode, Navigation} from 'swiper';
SwiperCore.use([FreeMode, Navigation]);

export default {
    components:{Swiper, SwiperSlide,},
    name: "avaContainer",
    mounted() {
    }
}
</script>

<style scoped>

.avas-container{
    padding: 10px 0;
}
.swiper .swiper-wrapper .swiper-slide{
    width: 80px;
}
</style>
