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
<!-- Docs master nav -->
<?php require  $adminPublicHeaderView;?>
<!-- Page content of course! -->
<div id="main">
    <div class="wrapper">
        <?php require  $adminPublicMenuView;?>
        <section id="content" class="hh-min-width">
            <div class="breadcrumbs-wrapper">
                <div class="container">
                    <div class="breadcrumbs-wrapper">
                        <div class="container">
                            <div class="row no-margin">
                                <div class="col s12">
                                    <h5 class="breadcrumbs-title">编辑<?php echo $tableCName;?>-<?php echo SITE_NAME;?></h5>
                                    <ol class="breadcrumb">
                                        <li><a href="<?php echo HTTP_DOMAIN; ?>/adminmain">主页</a>
                                        </li>
                                        <li><a href="<?php echo HTTP_DOMAIN; ?>/<?php echo $_GET['last_url'];?>"><?php echo $tableCName;?>列表</a>
                                        </li>
                                        <li class="active">编辑<?php echo $tableCName;?></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-heading">
                            <h4>编辑商品品牌</h4>
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
                                        <dt><b>品牌名称</b></dt>
                                        <dd>
                                            <div class="col s10 m8">
                                                <input id="brand_name" name="brand_name" class="validate[required,minSize[2],maxSize[20]]" value="<?php echo $tableObject['brand_name'];?>" type="text"></div>
                                        </dd>
                                    </dl>
                                    <dl class="col s12 m6">
                                        <dt><b>品牌拼音</b></dt>
                                        <dd>
                                            <div class="col s10 m8"><input id="brand_pinyin" value="<?php echo $tableObject['brand_pinyin'];?>" name="brand_pinyin" class="validate[required,minSize[2],maxSize[20]]" type="text"></div>
                                        </dd>
                                    </dl>
                                    <dl class="col s12 m6">
                                        <dt><b>品牌英文</b></dt>
                                        <dd>
                                            <div class="col s10 m8"><input id="brand_en" value="<?php echo $tableObject['brand_en'];?>" name="brand_en" class="validate[required,minSize[2],maxSize[20]]" type="text"></div>
                                        </dd>
                                    </dl>
                                    <dl class="col s12 m6">
                                        <dt><b>品牌网址</b></dt>
                                        <dd>
                                            <div class="col s10 m8"><input id="brand_url" value="<?php echo $tableObject['brand_url'];?>" name="brand_url" class="validate[required,minSize[2],maxSize[20]]" type="text"></div>
                                        </dd>
                                    </dl>
                                    <dl class="col s12 m6">
                                        <dt><b>品牌描述</b></dt>
                                        <dd>
                                            <div class="col s10 m8"><input id="brand_desc" value="<?php echo $tableObject['brand_desc'];?>" name="brand_desc" class="validate[required,minSize[2],maxSize[20]]" type="text"></div>
                                        </dd>
                                    </dl>
                                    <dl class="col s12 m6">
                                        <dt><b>排序</b></dt>
                                        <dd>
                                            <div class="col s12 m8"><input id="brand_sort_order" value="<?php echo $tableObject['brand_sort_order'];?>" name="brand_sort_order" class="validate[required,custom[number],min[0],max[9999999999]]" type="text"></div>
                                        </dd>
                                    </dl>
                                    <dl class="col s12">
                                        <dt><b>是否显示</b></dt>
                                        <dd>
                                            <input class="with-gap validate[required]" value="1" <?php if($tableObject['brand_is_show']==1){?>checked=checked <?php } ?> id="yes"  type="radio" name="brand_is_show"  >
                                            <label for="yes">是</label>
                                            <input class="with-gap validate[required]" value="2" <?php if($tableObject['brand_is_show']==2){?>checked=checked <?php } ?> id="no" type="radio" name="brand_is_show" >
                                            <label for="no">否</label>
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
                                                    <dd id="commoditydd1"></dd>
                                                </dl>
                                            </div>
                                            <input type="hidden" name="category_id1" id="category_id1" value="" />
                                        </dd>
                                    </dl>
                                    <dl class="col s12 m6">
                                        <dt><b>品牌logo</b></dt>
                                        <dd>

                                            <div class="dz-wrapper clearfix">
                                                <div class="dz-notice">
                                                    <p>图片格式只能为.jpg,.jpeg,.png</p>
                                                </div>
                                                <div id="photo-list1" class="dz-photo-list dropzone"></div>
                                                <div id="myDropzone" class="dropzone">
                                                    <div class="dz-default dz-message">
                                                        <div class="dz-btn-wrap">
                                                            <a class="dz-btn" href="javascript:;" title="">
                                                                <i class="mdi-content-add"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </dd>
                                        <div class="col s4">
                                            <div class="dz-wrapper clearfix">
                                                <img src="" id="mainthumb"   name="mainthumb" style="width: 200px; height:200px;display: none;">
                                            </div>
                                        </div>
                                    </dl>
                                    <input type="hidden" name="brand_logo" id="brand_logo" value="<?php echo $tableObject['brand_logo'];?>" />
                                    <dl class="col s12">
                                        <dd class="text-left">
                                            <input type="reset" name="reset" style="display: none;" />
                                            <a class="waves-effect waves-light btn pink lighten-2" id="validation_btn" href="javascript:void(0);">
                                                <i class="fa fa-spinner fa-spin" style="display: none;"></i>提交</a>
                                            <a class="waves-effect waves-light btn blue-grey lighten-2" href="<?php echo HTTP_DOMAIN."/admin_tolistbrand";?>">取消</a>
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
<script>
    $(document).ready(function () {
        var arrname = $('#c_name').val();
        if (arrname != null && arrname != "")
        {
            var arrayName = arrname.split(',');
            for (var k = 0; k < arrayName.length; k++)
            {
                $('#commoditydd1').append('<span>' + arrayName[k] + '</span>&nbsp;&nbsp;<a href="javascript:void(0);"  onclick="delName(' + k + ')"><span> × </span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
            }
        }
        var arrid = $('#c_id').val();
        if (arrid != null && arrid != "")
        {
            $('#category_id1').val(arrid);
        }

    });

</script>
<script type="text/javascript">
    var url_getbyparentid = '<?php echo HTTP_DOMAIN."/admin_getparentidbrand";?>';
    var url_getbrandbycateid = '<?php echo HTTP_DOMAIN."/admin_getbrandbycatelist";?>';
    $('.btn_category_class').on('click', function () {
        getCategoryByPid($(this), '.btn_category_class', url_getbyparentid, 2, url_getbrandbycateid);
    });

    $(function () {

        $('#validate_form').validationEngine();
        $('#validation_btn').on('click', submitAdd);
        $('#sel_role').select2();
        $('#sel_role').val(-1);
        //若品牌图片为空，则隐藏img
        if ($('#brand_logo').val() == '' || $('#brand_logo').val() == null) {
            $('#mainthumb').attr('style', 'display:none');
        }
        function submitAdd()
        {
            if ($('#category_id').val() == '')
            {
                swal('提示', "表单验证不通过！", 'error');
            } else {
                if ($('#validate_form').validationEngine('validate')) {
                    var param=$('#validate_form').serializeObject();
                    $('#validation_btn').children('i').css('display', 'block');
                    $('#validation_btn').unbind('click');
                    $.ajax({
                        url: "<?php echo HTTP_DOMAIN."/admin_doaddbrand";?>" ,
                        dataType: 'json',
                        type: 'post',
                        data:param,
                        success: function (data) {
                            if(data.status==1)
                            {
                                swal({
                                    title: "提示",
                                    text: data.msg,
                                    type: "info",
                                    showCancelButton: false
                                }, function() {
                                    location.href="<?php echo HTTP_DOMAIN; ?>/<?php echo $_GET['last_url'];?>";
                                });
                            }
                            else
                            {
                                swal(data.msg);
                            }
                            $('#validation_btn').children('i').css('display', 'none');
                            $('#validation_btn').on('click', submitAdd);
                        }, error: function (xhr, text, error) {
                            $('#ico_loading').hide();
                            $('#validation_btn').on('click', submitAdd);
                            swal('提示', '请求失败', 'error');
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

    $('#myDropzone').dropzone({
        url: "<?php echo $option['server'];?>",
        previewsContainer: $('#photo-list1')[0],
        maxFiles: 1,
        maxFilesize:2,
        addRemoveLinks: true,
        acceptedFiles: "<?php echo $option['mime_types'];?>",
        sending: function(file, xhr, formData) {
            formData.append("is_add", 1);
        },
        maxfilesreached: function() {
            $('#myDropzone').addClass('hide');
        },
        reset: function() {
            $('#myDropzone').removeClass('hide');
        },
        error: function(file, errorMessage) {

            this.removeFile(file);
            swal("错误!", errorMessage, "error");
        },
        removedfile: function(a) {
            $('#myDropzone').removeClass('hide');
            if (a.status == 'success') {
                $("#Cover").val('');
            }
            $.ajax({
                url:"<?php echo $option['del_server'];?>",
                dataType:"json",
                type:'POST',
                success:function (data) {
                    swal(data);
                }
            });
            var b;
            return a.previewElement && null != (b = a.previewElement) && b.parentNode.removeChild(a.previewElement),
                this._updateMaxFilesReachedClass()
        },
        success: function(obj, Response) {
            Response = $.parseJSON(Response);
            if (Response.status != 1) {
                swal("错误!", Response.msg, "error");
            } else {
                obj.previewElement.id = Response.result;
                swal(Response.msg);
                $("#Cover").val(Response.msg);
                $("#mainthumb").attr('src','<?php echo HTTP_DOMAIN.'/images/uploads_thumb/' ?>'+Response.result);
                $("#brand_logo").val(Response.result);
            }
        }
    });

</script>
<script type="text/javascript" src="<?php echo JS_HOST;?>/js/admin/common/reset_enterkeyevent_onlist.js"></script>
</body>

</html>
