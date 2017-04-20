<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <?php require  $adminPublicLinkView;?>
    <title>添加<?php echo $tableCName;?>_<?php echo SITE_NAME;?></title>
    <style type="text/css">
        .logo-img ui li{
            list-style: none;
            float:left;
        }
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
          }.tips_choice .tips_zt {
               background: url({:C("HOST_IMG")}/public/default/images/admin/barndsico.png) no-repeat 0px -408px;
        height: 7px;
        left: 25px;
        position: absolute;
        top: -6px;
        width: 11px;
        }
    </style>
</head>

<body class=" ">
<?php require  $adminPublicHeaderView;?>
<div id="main">
    <div class="wrapper">
        <?php require  $adminPublicMenuView;?>
        <section id="content" class="hh-min-width">
            <div class="breadcrumbs-wrapper">
                <div class="container">
                    <div class="row no-margin">
                        <div class="col s12">
                            <h5 class="breadcrumbs-title">添加<?php echo $tableCName;?>-<?php echo SITE_NAME;?></h5>
                            <ol class="breadcrumb">
                                <li><a href="<?php echo HTTP_DOMAIN; ?>/adminmain">主页</a>
                                </li>
                                <li><a href="<?php echo HTTP_DOMAIN; ?>/<?php echo $_GET['last_url'];?>"><?php echo $tableCName;?>列表</a>
                                </li>
                                <li class="active">添加<?php echo $tableCName;?></li>
                            </ol>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-heading">
                            <h4>添加商品属性</h4>
                            <ul class="actions">
                                <li>
                                    <a class="waves-effect waves-block waves-light collapse-btn card-a" href="javascript:void(0);">
                                        <i class="mdi-hardware-keyboard-arrow-down"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form id="validate_form">
                            <div class="card-content">
                                <div class="row hh-add-edit">
                                    <dl class="col s12 m6">
                                        <dt><b>商品属性名称</b></dt>
                                        <dd>
                                            <div class="col s10 m8"><input placeholder="商品属性名称" id="goodsattr_name" name="goodsattr_name" class="validate[required,minSize[2],maxSize[20]]" type="text"></div>
                                        </dd>
                                    </dl>
                                    <dl class="col s12 m6">
                                        <dt><b>商品属性值</b></dt>
                                        <dd>
                                            <div class="col s12 m8"><input placeholder="多个值以'|'隔开" id="goodsattr_value" name="goodsattr_value" class="validate[required,minSize[2],maxSize[200]]" type="text"></div>
                                        </dd>
                                    </dl>
                                    <dl class="col s12">
                                        <dt><b>选择商品类别</b></dt>
                                        <dd>

                                            <div class="detailed" >
                                                <div class="sort_list">
                                                    <div class="wp_category_list">
                                                        <div class="category_list" id="class_div_1">
                                                            <ul>
                                                                <?php foreach ($topCategory as $tc){?>
                                                                    <li id="<?php echo $tc['id']; ?>|1"  class="btn_category_class"><a href="javascript:void(0)" class=""><span ><?php echo $tc['goodscate_name']; ?></span></a></li>
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
                                            <input type="hidden" name="category_id" id="category_id" value="" />
                                        </dd>
                                    </dl>
                                    <dl class="col s12 m6">
                                        <dt><b>排序</b></dt>
                                        <dd>
                                            <div class="col s12 m8"><input id="goodsattr_sort" name="goodsattr_sort" placeholder="越大的数字排得越前" class="validate[required,custom[number],min[0],max[9999999999]]" type="text"></div>
                                        </dd>
                                    </dl>

                                    <dl class="col s12">
                                        <dd class="text-left">
                                            <input type="reset" name="reset" style="display: none;" />
                                            <a class="waves-effect waves-light btn pink lighten-2" id="validation_btn" href="javascript:void(0);">
                                                <i class="fa fa-spinner fa-spin" style="display: none;"></i>提交</a>
                                            <a class="waves-effect waves-light btn blue-grey lighten-2" href="<?php echo HTTP_DOMAIN."/admin_tolistgoodsatt";?>">取消</a>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>
    </div>
</div>
<?php require  $adminPublicFooterView;?>
<script type="text/javascript" src="<?php echo JS_HOST;?>/js/select_category.js"></script>
<script type="text/javascript">
    var url_getbyparentid = '<?php echo HTTP_DOMAIN."/admin_getparentidbrand";?>';
    var url_getbrandbycateid = '<?php echo HTTP_DOMAIN."/admin_getbrandbycatelist";?>';
    $('.btn_category_class').on('click', function () {
        getCategoryByPid($(this), '.btn_category_class', url_getbyparentid, 2, url_getbrandbycateid);
    });
    $(function () {
        $('#validate_form').validationEngine();
        $('#validation_btn').on('click', submitAdd);
        function submitAdd()
        {
            if ($('#category_id').val() == '')
            {
                swal('提示', "表单验证不通过！", 'error');
            } else {
                if ($('#validate_form').validationEngine('validate')) {
                    var param = $('#validate_form').serialize();

                    $('#validation_btn').children('i').css('display', 'block');
                    $('#validation_btn').unbind('click');
                    $.ajax({
                        url: "<?php echo HTTP_DOMAIN."/admin_doaddgoodsatt";?>" ,
                        dataType: 'json',
                        type: 'post',
                        data:param,
                        success: function (data) {
                            if (data.status == 1)
                            {
                                swal({
                                    title: "提示",
                                    text: data.msg,
                                    type: "info",
                                    showCancelButton: false
                                }, function() {
                                    location.href="<?php echo HTTP_DOMAIN; ?>/<?php echo $_GET['last_url'];?>";
                                });
                            } else
                            {
                                swal('提示', data.msg, 'error');
                            }
                            $('#validation_btn').children('i').css('display', 'none');
                            $('#validation_btn').on('click', submitAdd);
                        }
                    });

                } else {
                    swal("错误", "表单验证不通过!", "error");
                }
            }
        }
        var $print_link = $('#print-link');
        $print_link.unbind('click');
        $print_link.on('click', function (e) {
            e.stopPropagation();
        });
    });
</script>
<script type="text/javascript" src="<?php echo JS_HOST;?>/js/admin/common/reset_enterkeyevent_onlist.js"></script>
</body>

</html>
