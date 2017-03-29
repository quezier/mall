<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <?php require  $adminPublicLinkView;?>
    <link rel="stylesheet" href="<?php echo HTTP_DOMAIN;?>/css/sku.css">
    <title>添加商品_<?php echo SITE_NAME;?></title>
</head>

<body class=" ">
<!-- Docs master nav -->
<?php require  $adminPublicHeaderView;?>
<!-- Page content of course! -->
<div id="main">
    <div class="wrapper">
        <?php require  $adminPublicMenuView;?>
        <section id="content" class="hh-min-width">
            <div class="breadcrumbs-wrapper">
                <div class="container">
                    <div class="row no-margin">
                        <div class="col s12">
                            <h5 class="breadcrumbs-title">添加商品-<?php echo SITE_NAME;?></h5>
                            <ol class="breadcrumb">
                                <li><a href="<?php echo HTTP_DOMAIN.'/adminmain';?>">主页</a>
                                </li>
                                <li><a href="<?php echo HTTP_DOMAIN.'/admin_tolistgoods';?>">商品列表</a>
                                </li>
                                <li class="active">添加商品</li>
                            </ol>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-heading">
                        <h4>添加商品</h4>
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

                                <dl class="col s12">
                                    <dt><b>分类选择</b></dt>
                                    <dd>
                                        <?php require_once \Core\PubFunc::sysConfig('public_view_folder').'select_category.php';?>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>品牌</b></dt>
                                    <dd>
                                        <div class="col s12 m8">
                                            <div class="hh-select">
                                                <select class="sel_brand" id="brand_id" name="brand_id">
                                                    <option value="-1">请选择品牌</option>
                                                </select>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6" id='dl_brand_series'>
                                    <dt><b>系列</b></dt>
                                    <dd>
                                        <div class="col s12 m8">
                                            <div class="hh-select">
                                                <select class="sel_brand_series_id" id="brand_series_id" name="brand_series_id" >
                                                    <option value="">请选择系列</option>
                                                </select>
                                            </div>
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6" id="dl_product_name">
                                    <dt><b>商品名</b></dt>
                                    <dd>
                                        <div class="col s10 m8"><input id="goods_name" name="goods_name" class="validate[required,minSize[2],maxSize[200]]" type="text"></div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>名称样式</b></dt>
                                    <dd>
                                        <div class="col s12 m8"><input id="goods_css" name="goods_css" class="validate[required,minSize[2],maxSize[200]]" type="text"></div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>市场价(元)</b></dt>
                                    <dd>
                                        <div class="col s12 m8">
                                            <input id="goods_market_price" value="1" name="goods_market_price" class="validate[required,custom[number],min[1],max[999999999.99]]" type="text">
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>零售价(元)</b></dt>
                                    <dd>
                                        <div class="col s12 m8">
                                            <input id="goods_shop_price" value="1" name="goods_shop_price" class="validate[required,custom[number],min[1],max[999999999.99]]" type="text">
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>促销价(元)</b></dt>
                                    <dd>
                                        <div class="col s12 m8">
                                            <input id="goods_promote_price" value="1" name="goods_promote_price" class="validate[required,custom[number],min[1],max[999999999.99]]" type="text">
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>重量</b></dt>
                                    <dd>
                                        <div class="col s12 m8">
                                            <input id="goods_weight" value="1" name="goods_weight" class="validate[required,custom[number],min[1],max[999999999.99]]" type="text">
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>库存</b></dt>
                                    <dd>
                                        <div class="col s12 m8">
                                            <input id="goods_number" value="1" name="goods_number" class="validate[required,custom[number],min[1],max[9999999999]]" type="text">
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>库存警告值</b></dt>
                                    <dd>
                                        <div class="col s12 m8">
                                            <input id="goods_warn_number" value="20" name="goods_warn_number" class="validate[required,custom[number],min[1],max[9999999999]]" type="text">
                                        </div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>搜索关键词</b></dt>
                                    <dd>
                                        <div class="col s12 m8"><input placeholder="多个关键词以'|'隔开" id="goods_key" name="goods_key" class="validate[required,minSize[2],maxSize[200]]" type="text"></div>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>简单描述</b></dt>
                                    <dd>
                                        <div class="col s12 m8"><input id="goods_brief" name="goods_brief" class="validate[required,minSize[2],maxSize[200]]" type="text"></div>
                                    </dd>
                                </dl>
                                <!--
                                <dl class="col s12 m12">
                                    <dt><b>所属项目</b></dt>
                                    <dd>
                                        <div class="col s12 m8">
                                            <div class="hh-select">
                                                <volist name='goods_project' id="ap" key="k">
                                                    <input id="{$k}" attrname="goodsproject_checkbox" type="checkbox" value="{$k}" >
                                                    <label for="{$k}">{$ap}</label>
                                                </volist>
                                            </div>
                                        </div>
                                    </dd>
                                    <input id="goods_project_id" name="goods_project_id" value="" type="hidden">
                                </dl>-->
                                <dl class="col s12 m6">
                                    <dt><b>是否实物</b></dt>
                                    <dd>
                                        <input class="with-gap validate[required]" checked="checked" value="1" id="goods_is_real_1" type="radio" name="goods_is_real">
                                        <label for="goods_is_real_1">是</label>
                                        <input class="with-gap validate[required]" value="2" id="goods_is_real_2" type="radio" name="goods_is_real">
                                        <label for="goods_is_real_2">否</label>
                                    </dd>
                                </dl>

                                <dl class="col s12 m6">
                                    <dt><b>是否礼物</b></dt>
                                    <dd>
                                        <input class="with-gap validate[required]"  value="1" id="goods_is_gift_1" type="radio" name="goods_is_gift">
                                        <label for="goods_is_gift_1">是</label>
                                        <input class="with-gap validate[required]" checked="checked" value="2" id="goods_is_gift_2" type="radio" name="goods_is_gift">
                                        <label for="goods_is_gift_2">否</label>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>是否推荐</b></dt>
                                    <dd>
                                        <input class="with-gap validate[required]"  value="1" id="goods_is_best_1" type="radio" name="goods_is_best">
                                        <label for="goods_is_best_1">是</label>
                                        <input class="with-gap validate[required]" checked="checked" value="2" id="goods_is_best_2" type="radio" name="goods_is_best">
                                        <label for="goods_is_best_2">否</label>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>是否新品</b></dt>
                                    <dd>
                                        <input class="with-gap validate[required]" checked="checked"  value="1" id="goods_is_new_1" type="radio" name="goods_is_new">
                                        <label for="goods_is_new_1">是</label>
                                        <input class="with-gap validate[required]"  value="2" id="goods_is_new_2" type="radio" name="goods_is_new">
                                        <label for="goods_is_new_2">否</label>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>是否热销</b></dt>
                                    <dd>
                                        <input class="with-gap validate[required]"   value="1" id="goods_is_hot_1" type="radio" name="goods_is_hot">
                                        <label for="goods_is_hot_1">是</label>
                                        <input class="with-gap validate[required]" checked="checked"  value="2" id="goods_is_hot_2" type="radio" name="goods_is_hot">
                                        <label for="goods_is_hot_2">否</label>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>是否特价</b></dt>
                                    <dd>
                                        <input class="with-gap validate[required]"   value="1" id="goods_is_promote_1" type="radio" name="goods_is_promote">
                                        <label for="goods_is_promote_1">是</label>
                                        <input class="with-gap validate[required]" checked="checked"  value="2" id="goods_is_promote_2" type="radio" name="goods_is_promote">
                                        <label for="goods_is_promote_2">否</label>
                                    </dd>
                                </dl>
                                <dl class="col s12 m6">
                                    <dt><b>排序</b></dt>
                                    <dd>
                                        <div class="col s12 m8"><input id="goods_sort" placeholder="越大的数字排得越前" value="0" name="goods_sort" class="validate[minSize[0],maxSize[999999999999]]" type="text"></div>
                                    </dd>
                                </dl>
                                <dl class="col s12">
                                    <dd class="text-left">
                                        <input type="reset" name="reset" style="display: none;" />
                                        <a class="waves-effect waves-light btn pink lighten-2" id="validation_btn" href="javascript:void(0);">
                                            <i class="fa fa-spinner fa-spin" style="display: none;"></i>
                                            提交</a>
                                        <a class="waves-effect waves-light btn blue-grey lighten-2" href="{:U('/admin/product/toprodectlist')}">取消</a>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <input type="hidden" name="g_va" id="g_va" value=""/>
                    </form>
                </div>
            </div>
    </div>

    </section>
    </div>
</div>
<?php require  $adminPublicFooterView;?>
<script type="text/javascript" src="<?php echo JS_HOST;?>/js/select_category.js"></script>
<script type="text/javascript" src="<?php echo JS_HOST;?>/js/sku.js"></script>

<script type="text/javascript">
    function getAttrs() {
        var attr_objs = [];
        $.each($('#process tbody tr'), function (index_tr, obj_tr) {
            var attr_obj = {};
            $.each($('#process thead th'), function (i, o) {

                if ($(obj_tr).find('td').eq(i).find('input').length > 0)
                {
                    attr_obj[$(o).html()] = $(obj_tr).find('td').eq(i).find('input').eq(0).val();
                } else
                {
                    attr_obj[$(o).html()] = $(obj_tr).find('td').eq(i).html();
                }
            });
            attr_objs.push(attr_obj);
        });
        return attr_objs;
    }


    var url_getbyparentid = "<?php echo HTTP_DOMAIN."/admin_dogetgoodscatbypid";?>";
    var url_getbrandbycateid = "<?php echo HTTP_DOMAIN."/admin_dogetgoodsbrandbycateid";?>";
    var url_getgoodsattrbycateid = "<?php echo HTTP_DOMAIN."/admin_dogetgoodsattbycatid";?>";
    $('.btn_category_class').on('click', function () {
        getCategoryByPid($(this), '.btn_category_class', url_getbyparentid, 1, url_getbrandbycateid);
    });
    $(function () {

        $(".sel_brand").select2();
        $(".sel_brand_series_id").select2();
        $('#validate_form').validationEngine();
        $('#validation_btn').on('click', addSubmit);
        $('#brand_id').change(function () {
            var brand_id = $(this).val();
            $('#brand_series_id').empty();
            $('#brand_series_id').append('<option value="">请选择品牌</option>');
            $('#select2-brand_series_id-container').text("请选择品牌");
            $('#select2-brand_series_id-container').attr('title', "请选择品牌");
            $('.goodsattr').remove();
            $('.goodsattrinfo').remove();
            if (brand_id)
            {
                $.ajax({
                    url: '<?php echo HTTP_DOMAIN."/admin_dogetbrandserbybrandid";?>?brand_id=' + brand_id,
                    async: false,
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        if (data.result.length > 0)
                        {
                            $.each(data.result, function (i, v) {
                                $('#brand_series_id').append('<option value="' + v.id + '">' + v.brandser_name + '</option>');
                            });
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        swal('提示', '请求错误', 'error');
                    }
                });
            }
        });
        //var goodsattrnum=[];
        $('#brand_series_id').change(function () {
            $('.goodsattr').remove();
            $('.goodsattrinfo').remove();
            if ($('#brand_series_id').val())
            {
                $.ajax({
                    url: url_getgoodsattrbycateid + '?cate_id=' + $('#category_id').val(),
                    type: 'get',
                    dataType: 'json',
                    success: function (data) {
                        if (data.result.length > 0)
                        {
                            $.each(data.result, function (i, v) {

                                //goodsattrnum[v.goodsattr_name]='';

                                var attr_html = '';
                                attr_html += '<dl class="col s12 m12 goodsattr">'
                                    + '<dt><b class="Father_Title">' + v.goodsattr_name + '</b></dt>'
                                    + '<dd>';
                                var value_html = '';
                                $.each(v.values, function (it, vt) {
                                    value_html += '<input  class="filled-in sku_chk Father_Item' + i + '" value="' + vt + '"   id="checkbox-' + i + it + '" type="checkbox" attrname="goodsattr_checkbox" attrva="' + v.goodsattr_name + '"><label for="checkbox-' + i + it + '">' + vt + '</label>';
                                });
                                attr_html += value_html;
                                attr_html += '</dd></dl>';
                                $('#dl_product_name').before(attr_html);
                            });
                            var sku_html = '<dl class="col s12 m12 goodsattrinfo">'
                                + '<dt><b class="">属性信息</b></dt>'
                                + '<dd id="createTable"></dd></dl>';
                            $('#dl_product_name').before(sku_html);
                            sku_handler();
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        swal('提示', '请求错误', 'error');
                    }
                });
            }
        });
        var numbers = [];
        function addSubmit()
        {

            var attr_objs_v = [];
            $.each($('#process tbody tr'), function (index_tr, obj_tr) {
                var attr_obj_v = {};
                $.each($('#process thead th'), function (i, o) {

                    if ($(obj_tr).find('td').eq(i).find('input').length > 0)
                    {
                        if ($(o).html() != "价格" && $(o).html() != "库存")
                        {
                            attr_obj_v[$(o).html()] = $(obj_tr).find('td').eq(i).find('input').eq(0).val();
                        }

                    } else
                    {
                        if ($(o).html() != "价格" && $(o).html() != "库存") {
                            attr_obj_v[$(o).html()] = $(obj_tr).find('td').eq(i).html();
                        }
                    }
                });
                attr_objs_v.push(attr_obj_v);
            });
            $('#g_va').val($.toJSON(attr_objs_v));
            var skuTtile = $(".Father_Title.sku_title_checked");
            var arrayInfor = new Array(); //盛放每组选中的CheckBox值的对象
            var columnIndex = 0; //选择数量
            $.each(skuTtile, function (i, item) {
                var itemName = "Father_Item" + i;
                //选中的CHeckBox取值
                var order = new Array();
                $(item).parent().siblings('dd').children('input[type=checkbox]:checked').each(function () {
                    order.push($(this).val());
                });
                arrayInfor.push(order);
                if (order.join() == "") {
                    swal('提示', "表单验证不通过！", 'error');
                } else
                {
                    columnIndex++;
                }

            });
            if (columnIndex < 1)
            {
                swal("错误", "请选择商品属性!", "error");
            } else {

                //所属项目选中项
                $('input[attrname="goodsproject_checkbox"]').each(function () {
                    //判断所属项目是否选中
                    if ($(this).prop('checked') == true) {
                        numbers.push($(this).val());
                    }
                });
                $('#goods_project_id').val(numbers);
                if ($('#validate_form').validationEngine('validate')) {
                    $('#validation_btn').children('i').css('display', 'block');
                    $('#validation_btn').unbind('click');
                    var param = $('#validate_form').serialize();
                    var attrs = $.toJSON(getAttrs());
                    $.ajax({
                        url: "<?php echo HTTP_DOMAIN.'/admin_doaddgoods';?>?" + param + '&attrs=' + attrs,
                        dataType: 'json',
                        type: 'get',
                        success: function (data) {
                            if (data.status == 1)
                            {
                                swal({title: '提示', text: data.msg, type: 'success'}, function () {
                                    location.href = "<?php echo HTTP_DOMAIN.'/admin_tolistgoods';?>";
                                });
                                //$("input[type=reset]").trigger("click");

                            } else
                            {
                                swal('提示', data.msg, 'error');
                            }
                            $('#validation_btn').on('click', addSubmit);
                            $('#validation_btn').children('i').css('display', 'none');
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) {
                            swal('提示', '请求错误', 'error');
                            $('#validation_btn').on('click', addSubmit);
                            $('#validation_btn').children('i').css('display', 'none');
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
</body>

</html>
