<div class="preview" id={{ $preview_id }}>
  <div class="d-inline-block mr-1 mt-4 ml-3">
    <img class="img-thumbnail" src={{ $item_img }} title={{ $item_name }} style="height:100px;" />
    <div class="small text-muted text-center">{{ $item_name }}</div>
  </div>
</div>
<input type="hidden" type="text" name="item_url" value="{{ $item_url }}">