<template>

    <div class="toggle-wrap">
        <div v-if="toggle_type == 1" class="toggle-btn" id="_1st-toggle-btn">
            <input type="checkbox" v-model="checked" @click="toggle_theme">
            <span></span>
        </div>

        <div v-else-if="toggle_type == 2" class="toggle-btn" id="_2nd-toggle-btn">
            <input type="checkbox">
            <span></span>
        </div>

        <div v-else class="toggle-btn" id="_3rd-toggle-btn">
            <input type="checkbox">
            <span></span>
        </div>
    </div>
</template>

<script>
export default {
    name: "toggle",
    props: {
        toggle_type:{
            type: Number
        }
    },
    data() {
        return{
            checked: false,
        }
    },
    methods:{
        toggle_theme(){
            let body = document.querySelector('#app')
          if (!this.checked){
              console.log(document)
              body.style.background = 'black'
          } else {
              body.style.background = 'white'
          }
        },
    }
}
</script>

<style scoped>
.toggle-wrap{
}
.toggle-btn {
    position: relative;
    width: 70px;
    height: 35px;
    margin: 0 auto;
    border-radius: 40px;
    background: linear-gradient(90deg, #e0c3fc 0%, #8ec5fc 100%);
}

input[type="checkbox"] {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    bottom: 0px;
    margin: 0px;
    cursor: pointer;
    opacity: 0;
    z-index: 2;
}

/* First toggle btn */

#_1st-toggle-btn span {
    position: absolute;
    top: 0px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    overflow: hidden;
    opacity: 1;
    border-radius: 40px;
    transition: 0.2s ease background-color, 0.2s ease opacity;
    display: flex;
    align-items: center;
}

#_1st-toggle-btn span:before,
#_1st-toggle-btn span:after {
    content: "";
    position: absolute;
    width: 27px;
    height: 27px;
    border-radius: 50%;
    transition: 0.5s ease transform, 0.2s ease background-color;
}

#_1st-toggle-btn span:before {
    background-color: #fff;
    transform: translate(-58px, 0px);
    z-index: 1;
}

#_1st-toggle-btn span:after {
    background-color: #fff;
    transform: translate(8px, 0px);
    z-index: 0;
}

#_1st-toggle-btn input[type="checkbox"]:checked + span {
    background-color: #000;
}

#_1st-toggle-btn input[type="checkbox"]:active + span {
    opacity: 0.5;
}

#_1st-toggle-btn input[type="checkbox"]:checked + span:before {
    background-color: #000;
    transform: translate(22px, -5px);
}

#_1st-toggle-btn input[type="checkbox"]:checked + span:after {
    background-color: #fff979;
    transform: translate(35px, 0px);
}

/* First toggle btn completed */

/* Second toggle btn */

#_2nd-toggle-btn {
    margin: 60px auto 76px auto;
}

#_2nd-toggle-btn span {
    position: absolute;
    top: 0px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    border: 8px solid #b3b3b3;
    border-color: #b3b3b3;
    overflow: hidden;
    background-color: #fff;
    border-radius: 40px;
    transition: 0.8s ease border-color;
}

#_2nd-toggle-btn span:before {
    content: "";
    position: absolute;
    top: -8px;
    width: 58px;
    height: 58px;
    border-width: 8px;
    border-style: solid;
    border-color: #b3b3b3;
    margin-left: 0px;
    border-radius: 50%;
    transform: translate(-8px, 0px);
    transition: 0.4s ease border-radius, 0.4s ease transform, 0.6s ease width,
    0.6s ease margin-left, 0.8s ease border-color;
}

#_2nd-toggle-btn input[type="checkbox"]:active + span:before {
    width: 80px;
    border-radius: 40px;
}

#_2nd-toggle-btn input[type="checkbox"]:checked:active + span:before {
    margin-left: -22px;
}

#_2nd-toggle-btn input[type="checkbox"]:checked + span {
    border-color: #000;
}

#_2nd-toggle-btn input[type="checkbox"]:checked + span:before {
    border-color: #000;
    transform: translate(63px, 0px);
}

/* Second toggle btn completed */

/* Third toggle btn */

#_3rd-toggle-btn span {
    display: block;
    width: 145px;
    height: 38px;
    background-color: #c7c7c7;
    border-radius: 20px;
    transition: 0.5s ease background-color;
}

#_3rd-toggle-btn span:before {
    content: "";
    position: absolute;
    top: -16px;
    width: 70px;
    height: 70px;
    background-color: #fff;
    border-radius: 50%;
    box-shadow: 2px 6px 25px #d7d7d7;
    transform: translate(0px, 0px);
    transition: 0.6s ease transform, 0.6s box-shadow;
}

#_3rd-toggle-btn span:after {
    content: "";
    position: absolute;
    top: 50%;
    right: 0px;
    left: 35px;
    width: 0px;
    height: 24px;
    margin-top: -36px;
    margin-left: -6px;
    border: 6px solid #000;
    border-radius: 20px;
    transform: translate(0px, 0px);
    transition: 0.4s ease width, 0.4s ease border-radius, 0.62s ease transform;
}

#_3rd-toggle-btn input[type="checkbox"]:checked + span:before {
    box-shadow: 7px 6px 25px #e6e6e6;
    transform: translate(75px, 0px);
}

#_3rd-toggle-btn input[type="checkbox"]:checked + span:after {
    width: 24px;
    border-radius: 50%;
    transform: translate(64px, 0px);
}

#_3rd-toggle-btn input[type="checkbox"]:checked + span {
    background-color: #000;
}

/* Third toggle btn completed */

</style>
