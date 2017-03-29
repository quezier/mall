<style>
    .detailed{
        padding: 20px;
        margin-top: 12px;
        border: 1px #d9e2e9 dashed;
        background-color: #f5f9ff;
        min-height: 300px;}

    .detailed ul {
        float: left;
        border: 1px solid #f9ab36;
        background: white;
        padding: 0 1px;
        margin: 0 4px;
        width: 180px;
        height: 288px;
        border-bottom: 1px solid #f9ab36;
        overflow-x: hidden;
        overflow-y: auto;
        padding-top: 10px;
    }.detailed ul li {
         cursor: pointer;
         line-height: 21px;
         list-style: none outside none;
         overflow: hidden;
         white-space: nowrap;
         text-overflow: ellipsis;
         -o-text-overflow: ellipsis;
     }.detailed li a {
          padding-left: 15px;
          display: block;
          line-height: 21px;
          color: #000;
          font-weight: normal;
          font-size:12px;
      }
    .detailed li a:visited{}
    .detailed li a:hover,.detailed li a:active{color:#F4CB48;}
    .tips_choice {
        color: #404040;
        margin: 12px 0px;
        position: relative;
        font-size: 12px;
    }
    .tips_choiced{font-weight: bold;color:#f00;}
    .tips_choice .hover_tips_cont {
        background-color: #FFFAEA;
        border: 1px solid #F4CB48;
        overflow: hidden;
        padding: 8px;
        text-align: left;
        zoom: 1;
    }.tips_choice dt {
         float: left;
     }.tips_choice dd {
          float: left;
          font-family: sans-serif;
          font-weight: 700;
      }
</style>
<div class="detailed" >
    <div class="sort_list">
        <div class="wp_category_list">
            <div class="category_list" id="class_div_1">
                <ul>
                    <?php foreach ($top_gc as $gcKey => $gcVal){?>
                        <li id="<?php echo $gcVal['id'];?>|1"  class="btn_category_class"><a href="javascript:void(0)" class=""><span ><?php echo $gcVal['goodscate_name'];?></span></a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
    <div class="sort_list">
        <div class="wp_category_list blank">
            <div class="category_list" id="class_div_2">
            </div>
        </div>
    </div>
    <div class="sort_list">
        <div class="wp_category_list blank">
            <div class="category_list" id="class_div_3">
            </div>
        </div>
    </div>
    <div class="sort_list">
        <div class="wp_category_list blank">
            <div class="category_list" id="class_div_4">
            </div>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>

<div style="display: block; clear:both;" class="tips_choice">
    <span class="tips_zt"></span>
    <dl class="hover_tips_cont" style="height:46px;">
        <dt id="commodityspan" style="display: none;">
            <span style="color:#F00;">请选择商品类别</span>
        </dt>
        <dt class="current_sort" style="width:160px;padding:0px;height:30px;line-height: 30px;" id="commoditydt">您当前选择的商品类别是：</dt>
        <dd id="commoditydd"></dd>
    </dl>
</div>
<input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id;?>" />
