<template>
    <div class="" id="player" v-show="visibility">
        <div class="buttons">
            <button class="gradient-btn prev-track fa fa-step-backward" @click="prevTrack">
            </button>
            <button :class="[playPause_btn ? 'fa-play-circle': 'fa-pause-circle']" class="gradient-btn playpause-track fa" @click="playpauseTrack">
            </button>
            <button class="gradient-btn next-track fa fa-step-forward" @click="nextTrack">
            </button>
        </div>

        <div class="content-row-header">
            <div class="content-author">
            <span class="avatar">
                <img src="https://static.displate.com/280x392/displate/2020-04-05/41588121d73ab3d00a97ff3a3a6f5c9c_ab155753dbb406868e521202592b124b.jpg" alt="" class="treks-poster">
            </span>
                <div style="width: 100%;">
                    <slot name="other-info-0">
                    </slot>
                    <div class="flex-btw">
                        <a class="author-name">{{ track_name }} </a>
                        <input type="range" min="1" max="100"
                               v-model="volume_slider"
                               class="volume_slider"
                               @input="setVolume">
                    </div>
                    <div class="flex-btw" style="margin: 5px 0;">
                        <a href="qewqw" class="other-info">
                            {{ track_artist }}
                        </a>
                        <div class="other-info">
                            {{ isPlaying ? curr_time: total_duration}}
                        </div>
                    </div>
                    <div class="slider-progressbar">
                        <div class="seek_slider_cont">
                            <input ref="seek_slider" step="any" type="range" min="0" max="100" v-model="seek_slider" class="seek_slider" @change="seekTo" @input="seekTo">
                            <progress id="progress" class="plyr__progress__buffer" min="0" max="100" :value="progress" ></progress>
                            <div id="progress_bar" :style="'width:' + progress + '%'"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="trackList">
            <div v-for="(track, index) in track_list">
                <button @click="changeTrack(index)"> {{ track.name }} | {{ index }} </button>
            </div>
        </div>
    </div>
    <button @click="visibility = true" class="gradient-btn fa fa-music" v-show="!visibility">
    </button>
</template>

<script>
export default {
    name: "Player",
    props: {
    },
    data(){
        return{
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
            curr_track: document.createElement('audio'),
            now_playing: '',
            track_name: '',
            track_artist: '',

            playPause_btn: true,

            seek_slider: 0,
            volume_slider: 70,
            curr_time: '',
            total_duration: '',
            progress: 0,

            // Specify globally used values
            track_index: 0,
            isPlaying: false,
            updateTimer: undefined,
            visibility: false,
        }
    },
    methods: {
        loadTrack(track_index) {
            // Clear the previous seek timer
            clearInterval(this.updateTimer)
            this.resetValues()

            // Load a new track
            this.curr_track.src = this.track_list[track_index].path
            this.curr_track.load()

            // Update details of the track
            this.track_name = this.track_list[track_index].name
            this.track_artist = this.track_list[track_index].artist
            this.now_playing = "PLAYING " + (track_index + 1) + " OF " + this.track_list.length

            // Set an interval of 1000 milliseconds
            // for updating the seek slider
            this.updateTimer = setInterval(this.seekUpdate, 1000);

            // Move to the next track if the current finishes playing
            // using the 'ended' event
            this.curr_track.addEventListener("ended", this.nextTrack);

            // Apply a random background color
        },


        // Function to reset all values to their default
        resetValues() {
            this.curr_time = "00:00"
            this.total_duration = "00:00"
            this.seek_slider = 0
        },
        playpauseTrack() {
            // Switch between playing and pausing
            // depending on the current state
            if (!this.isPlaying) this.playTrack();
            else this.pauseTrack();
        },

        playTrack() {
            // Play the loaded track
            this.curr_track.play();
            this.isPlaying = true;

            // Replace icon with the pause icon
            this.playPause_btn = false;
        },

        pauseTrack() {
            // Pause the loaded track
            this.curr_track.pause();
            this.isPlaying = false;

            // Replace icon with the play icon
            this.playPause_btn = true;
        },

        nextTrack() {
            this.$refs.seek_slider.style.background = 'linear-gradient(to right, #8ec5fc 0%, transparent 0%)'
            this.resetValues()
            // Go back to the first track if the
            // current one is the last in the track list
            if (this.track_index < this.track_list.length - 1) this.track_index += 1;
            else this.track_index = 0;

            // Load and play the new track
            this.loadTrack(this.track_index);
            this.playTrack();
        },
        prevTrack() {
            this.$refs.seek_slider.style.background = 'linear-gradient(to right, #8ec5fc 0%, transparent 0%)'
            // Go back to the last track if the
            // current one is the first in the track list
            if (this.track_index > 0) this.track_index -= 1;
            else this.track_index = this.track_list.length - 1;

            // Load and play the new track
            this.loadTrack(this.track_index);
            this.playTrack();
        },
        changeTrack(nv){
            this.$refs.seek_slider.style.background = 'linear-gradient(to right, #8ec5fc 0%, transparent 0%)'
            this.resetValues()
            // Go back to the first track if the
            // current one is the last in the track list
            this.track_index = nv
            // Load and play the new track
            this.loadTrack(this.track_index);
            this.playTrack();
        },
        seekTo() {
            if (!this.curr_track.duration) return
            // Calculate the seek position by the
            // percentage of the seek slider
            // and get the relative duration to the track
            let seekPosition = this.curr_track.currentTime * (100 / this.curr_track.duration);
            this.$refs.seek_slider.style.background = 'linear-gradient(to right, #8ec5fc ' + seekPosition.toFixed() + '%, transparent 0%)'
            let seekto = this.curr_track.duration * (this.seek_slider / 100);
            // Set the current track position to the calculated seek position
            this.curr_track.currentTime = seekto;
        },

        setVolume(e) {
            // Set the volume according to the
            // percentage of the volume slider set
            //this.volume_slider = e.target.value
            this.curr_track.volume = this.volume_slider / 100;
        },

        seekUpdate() {
            let seekPosition = 0;
            // Check if the current track duration is a legible number
            if (!isNaN(this.curr_track.duration) && this.isPlaying /*&& !this.curr_track.paused*/) {
                this.bufferProgressUpdate()
                seekPosition = this.curr_track.currentTime * (100 / this.curr_track.duration);
                this.seek_slider = seekPosition;
                this.$refs.seek_slider.style.background = 'linear-gradient(to right, #8ec5fc ' + seekPosition.toFixed() + '%, transparent 0%)'
                // Calculate the time left and the total duration
                let currentMinutes = Math.floor(this.curr_track.currentTime / 60);
                let currentSeconds = Math.floor(this.curr_track.currentTime - currentMinutes * 60);
                let durationMinutes = Math.floor(this.curr_track.duration / 60);
                let durationSeconds = Math.floor(this.curr_track.duration - durationMinutes * 60);

                // Add a zero to the single digit time values
                if (currentSeconds < 10) { currentSeconds = "0" + currentSeconds; }
                if (durationSeconds < 10) { durationSeconds = "0" + durationSeconds; }
                if (currentMinutes < 10) { currentMinutes = "0" + currentMinutes; }
                if (durationMinutes < 10) { durationMinutes = "0" + durationMinutes; }

                // Display the updated duration
                this.curr_time = currentMinutes + ":" + currentSeconds;
                this.total_duration = durationMinutes + ":" + durationSeconds;
            }
        },

        bufferProgressUpdate() {
            let buffered = this.curr_track.buffered;
            let loaded;

            if (buffered.length) {
                loaded = 100 * buffered.end(0) / this.curr_track.duration;
                this.progress = loaded.toFixed();
            }
        }
    },
    watch: {
        '$store.state.player.track_index': function(nv) {
            this.changeTrack(nv)
        }
    },
    mounted() {
        // Load the first track in the tracklist
        this.loadTrack(this.track_index);
    },
}
</script>

<style lang="scss" scoped>
.trackList{
    position: absolute;
    top: 80px;
    width: 400px;
    right: 0;
    background-color: rgba(230,0,70,0.56);
    padding: 10px;
    overflow: hidden;
}
#player{
    position: relative;
    .gradient-btn{
    }
    .other-info{
        color: #666;
        font-size: 14px;
    }
    .avatar img{
        border-radius: 5px;
    }
    display: flex;
    justify-content: center;
    align-items: center;
    .buttons{
        button{
            cursor: pointer;
        }
        .next-track{
        }
    }
}

.slider-progressbar{
    .seek_slider_cont{
        background-color: #f5f5f5;
        position: relative;
        width: 300px;
        height: 5px;
        #progress_bar{
            height: 5px;
            background-color: lighten(#8ec5fc, 17);
            position: absolute;
            z-index: 1;
        }
        &:hover{
            .seek_slider::-webkit-slider-thumb{
                opacity: 1;
            }
        }
        progress{display: none;}
        .seek_slider {
            position: absolute;
            cursor: pointer;
            background-color: transparent;
            z-index: 2;
            -webkit-appearance: none;
            width: 100%;
            height: 5px;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
            border: none;
        }
        .seek_slider:hover {
            opacity: 1;
        }
        .seek_slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            border-radius: 50%;
            transition: 0.2s;
            appearance: none;
            width: 7px;
            height: 7px;
            margin-right: 13px;
            position: relative;
            left: -3px;
            opacity: 0;
            background: #8ec5fc;
            cursor: pointer;
        }
        .seek_slider::-moz-range-thumb {
            width: 10px;
            height: 10px;
            cursor: pointer;
        }
    }

}
</style>
