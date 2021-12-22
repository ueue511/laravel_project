<template>
  <div class="homebefore_container">
    <p class="fronttitle"></p>
    <div class="homebefore_front">
      <h3 class="text-center homebefore_title">Stacked with Booksとは？</h3>
      <p class="text-center home-before-group">数万種類の中から出会った一冊の本で、感じたことを「自分の言葉」で綴るサイトです</p>
      <div class="card-deck center home_box">
        <div class="card col-sm-4 card_video">
          <video class="homebefore_video" src="/images/stackedwithbooks.mp4" ref="scrollTarget" muted　></video>
          <div class="card-body text-center">
            自分の好きな本を検索
          </div>
        </div>
        <div class="card col-sm-4 card_video">
          <video class="homebefore_video" src="/images/stackedwithbooks_2.mp4" ref="scrollTarget2" muted　></video>
          <div class="card-body text-center">
            感じたことを「自分の言葉」で綴る
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  import { reactive, onMounted, ref } from 'vue';
    export default {
      name: "ExampleHomeBefore",
      data() {
        return {
          observer: null,
          play: null
        }
      },

      //-----
      mounted() {
        const scrollTarget = this.$refs.scrollTarget

        const obsOptions = {
          root: null, //rootプロパティ, nullでブラウザーのビューポートを使用することができます。
          threshold: [0.2, 1.0], //しきい値。0.1は10%の意味です。
        };

        this.observer = new IntersectionObserver(this.OnMouseVideo, obsOptions);
        this.observer.observe(scrollTarget);
    },

      //-----

      computed: {

      },
      methods: {
        OnMouseVideo(entries, observer) {
          const scrollTarget = this.$refs.scrollTarget
          const scrollTarget2 = this.$refs.scrollTarget2
          entries.forEach(entry => {
            if ( entry.intersectionRatio === 1 ) {
              scrollTarget.play()
              scrollTarget2.play()
            } else if(!entry.isIntersecting) {
              scrollTarget.pause()
              scrollTarget2.pause()
            }
          })
        }
      }
    }
    </script>

<style scoped>

.homebefore_front {
  margin-top: 70px;
}

.homebefore_title {
  color: rgb(255, 169, 11, 1);
  text-shadow: 1px 1px 0 #014276;
}

.home_box {
  margin-bottom: 100px;
}

.center {
  justify-content: center;
}
.home-before-group {
  font-size: 1em;
  margin: 30px 0 40px 0;
}

.fronttitle {
  height: 24px;
  color: rgb(78, 78, 78);
  text-align: center;
  background: linear-gradient(70deg, #fedab3 0%, #fedab3 8.5%, #fff7e4 8.5%, #fff7e4 25.1%,  #fedab3 25.1%, #fedab3 74.9%, #b0e1fa 74.9%, #b0e1fa 91.5%, #fedab3 91.5%, #fedab3 100%);
}

.homebefore_video {
  height: 250px;
}

@media screen and ( max-width: 959px ) {
  .homebefore_front {
    margin-top: 50px;
  }

  .homebefore_video {
    height: 150px;
  }
}

@media screen and ( max-width: 669px ) {
  .home-before-group {
    width: 70%;
    margin: auto;
    margin-bottom: 30px
  }
}

@media screen and ( max-width: 575px ) {
  .card_video {
    width: 70%;
    margin: auto;
    margin-bottom: 30px;
  }
}
</style>