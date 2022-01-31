<template>
  <div class="container">
    <div class="card">
      <div class="card-header bookcardtitle">{{ bookone.item_name }}</div>
        <div class="row no-gutters">
          <div class="col-md-5">
            <img class="card-img-top" :src="bookone.item_img" alt="Card image cap">
            <div class="card-img-overlay qr-img">
            <vue-qrcode v-if="bookone.url" :value="bookone.url" :options="option" tag="img"></vue-qrcode>
            </div>
          </div>

          <div class="col-md-7 ">
            <div class="comment-title">感想一覧</div>
            <perfect-scrollbar>
              <div class="card-body">
                <div 
                  v-for="book in ArrayLook" 
                  :key="book.id" 
                  class="card-text" 
                >
                  {{ book.users[0].name }}&ensp;{{ book.created_at }}
                  <div 
                    v-for="comment in book.comment"
                    :key="comment.id"
                  >
                    &emsp;{{ comment }}
                  </div><br/>
                </div>
              </div>
            </perfect-scrollbar>
          </div>
        </div>
        <div class="card-footer bookcardtitle">感想を入力</div>
        <div id="editor"></div>
    </div>
    <div class="text-center">
      <button 
        @click="CommentSave" 
        type="button" 
        class="btn btn-primary button_margin"
      >
      入力
      </button>
    </div>
  </div>
</template>

<script>

import EditorJS from '@editorjs/editorjs';
import VueQrcode from "@chenfengyuan/vue-qrcode";

export default {
  name:"ExampleDetailResult",
  props: {
    bookone: {
      type: Object,
      required: true,
      default: 0
    }
  },
  components: {
    VueQrcode
  },
  
  data() {
    return {
      text: null,
      option: {
        errorCorrectionLevel: "M",
        maskPattern: 0,
        margin: 3,
        scale: 2,
        width: 60,
        color: {
          dark: "#000000FF",
          light: "#FFFFFFFF"
        }
      }
    };
  },
  beforeUpdate() {

  },

  computed: {
    ArrayLook(){
      const commentlist = this.$store.getters[ 'commentsave/GetComment' ]
      if ( !commentlist  ) {
        return this.bookone.comments;
      } else {
        return commentlist.data.comments;
      }
    }
  },

　mounted() {
    this.doEditor()
  },

  methods: {
    // Editor.js関連
    doEditor() {
      window.editor = new EditorJS({
        holder: 'editor',
        minHeight: 50,
        // VERBOSE	#すべてのメッセージを表示（デフォルト）
        // INFO	#情報とデバッグメッセージを表示する
        // WARN	#警告メッセージのみを表示
        // ERROR	#エラーメッセージのみを表示
        logLevel: 'ERROR',

        tools: {
          header: {
            class: Header,
            // config: {
            //   placeholder: "この本の感想を教えてください",
            //   level: [2, 3, 4],
            //   defaultLever: 3,
            // }
          },
          list: List,
          checklist: Checklist,
          quote: Quote,
          code: CodeTool,

          // plus10percent: {
          //   class: ChangeFontSize,
          // },
          // plus20percent: {
          //   class: ChangeFontSize,
          //   config: {
          //       cssClass: "plus20pc",
          //       buttonText: "20%"
          //     }
          //   },
        },
        // data: {
        //   blocks: [{
        //     type: "header",
        //     data: {
        //       text: "",
        //       level: 3,
        //     },
        //   }]
        // },
      })
    },

    // Editer.jsのテキストをdata[text]に移す
    CommentSave(){
      const vc = this
      editor.save().then( function( outputData ) {
        vc.text = outputData;
        const data = [{
          'bookid': vc.bookone.id 
          }, vc.text.blocks ]
        vc.$store.dispatch( 'commentsave/VuexAction_CommentSave', data )
        }).catch(function(error){
        console.log('Saving failed: ', error)
      });
      editor.blocks.clear()
    }
  },
}
</script>

<style scoped>

.bookcardtitle {
  text-align: center;
  font-size: 24px;
  color: rgb(78, 78, 78);
  background: linear-gradient(70deg, #fedab3 0%, #fedab3 8.5%, #fff7e4 8.5%, #fff7e4 25.1%,  #fedab3 25.1%, #fedab3 74.9%, #b0e1fa 74.9%, #b0e1fa 91.5%, #fedab3 91.5%, #fedab3 100%);
}

.button_margin {
  margin: 20px 0 20px 0;
  align-content: center;
}

.ps {
  height: 450px;
  /* border: 2px solid rgb(102, 102, 102); */
}

.qr-img {
  margin-top: 100%;
  margin-left: 65%;
}

.comment-title {
   border-bottom: 2px solid rgb(150, 150, 150);

}

</style>