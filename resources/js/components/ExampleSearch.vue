<template>
  <div class="container search-container">
    <div class="seachbook_content">
      <p class="searchbook_title">登録されている本へのコメント検索</p>
      <div class="row row_search">
        <div class="col-5 showbook_form">
          <p class="showbook_select">ジャンル</p>
            <select class="custom-select form_margin">
              <option selected></option>
              <option value="1">one</option>
              <option value="2">twe</option>
              <option value="3">three</option>
            </select>
          </div>
        <div class="form-group showbook_form col-5">
          <label for="formsearch" class="showbook_select">タイトル</label>
          <input type="text" class="form-control form_margin_rigth" id="ormsearch" value="">
        </div>
      </div>
      <div class="section1 text-center">
      <button type="button" class="btn btn-primary w-50 button_margin">検索 ></button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  mane: "ExampleSearch",
  data() {
    return {

    }
  },
  mounted() {
    //
  }
}
</script>

<style scoped>

#showbook_search {
  margin: 0 10px 0px 10px;
}

.searchbook_title {
  text-align: center;
  font-size: 24px;
  color: rgb(78, 78, 78);
  background: linear-gradient(70deg, #fedab3 0%, #fedab3 8.5%, #fff7e4 8.5%, #fff7e4 25.1%,  #fedab3 25.1%, #fedab3 74.9%, #b0e1fa 74.9%, #b0e1fa 91.5%, #fedab3 91.5%, #fedab3 100%);
}

.showbook_form {
  margin-top: 10px;
}

.showbook_select {
  margin-bottom: 0.5em;
  font-size: 18px;
  margin-left: 20px;
}

.seachbook_content {
  border: rgb(192, 192, 192) 1px solid;
}

.row_search {
  justify-content: space-around
}

.button_margin {
  margin-bottom: 20px;
}

.seachbook_content {
  margin-bottom: 50px;
  background-color: #ffffff;
}

</style>