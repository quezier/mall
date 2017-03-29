<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <?php require  $adminPublicLinkView;?>
    <title>分配权限_<?php echo SITE_NAME;?></title>
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
                            <h5 class="breadcrumbs-title">分配权限-<?php echo SITE_NAME;?></h5>
                            <ol class="breadcrumb">
                                <li><a href="<?php echo 'http://'.HTTP_HOST.'/adminmain';?>">主页</a>
                                </li>
                                <li class="active">分配权限</li>
                            </ol>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-heading">
                            <h4>分配权限</h4>
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
                                        <dt><b>选择角色</b></dt>
                                        <dd>
                                            <div class="col s12 m6">
                                                <select id="sel_role" class="select2-selection--single select2-search--dropdown" >
                                                    <option value="-1" selected="selected">请选择一个角色</option>
                                                    <?php foreach ($roles as $key => $role){?>
                                                        <option value="<?php echo $role['id'];?>"><?php echo $role['role_name'];?></option>
                                                    <?php }?>
                                                </select>
                                                <i id="ico_loading" class="fa fa-spinner fa-spin" style="display: none;"></i>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                                <div class="row">
                                    <dl class="col s12">
                                        <dd>
                                            <ul id="treePrivilege" class="ztree"></ul>
                                        </dd>
                                    </dl>
                                    <dl class="col s12" id="dl_btns" style="display: none;">
                                        <dd class="text-left">
                                            <input type="reset" name="reset" style="display: none;" />
                                            <a class="waves-effect waves-light btn pink lighten-2" id="validation_btn" href="javascript:void(0);">
                                                <i class="fa fa-spinner fa-spin" id="ico_loading" style="display: none;"></i>
                                                提交</a>
                                            <a class="waves-effect waves-light btn blue-grey lighten-2" href="<?php echo 'http://'.HTTP_HOST.DIR_SP.'admin_todistprivilege';?>">取消</a>
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
<script type="text/javascript">
    $(function () {
        $('#sel_role').select2();
        $('#sel_role').val(-1);
        var role_id;
        var treeObj;
        $('#validation_btn').on('click',funcClick);
        function funcClick()
        {
            $('#ico_loading').show();
            $('#validation_btn').unbind('click');
            var checkedNodes=treeObj.getCheckedNodes(true);
            if(checkedNodes.length>0)
            {
                var privileges="";
                $.each(checkedNodes,function(i,v){
                    privileges=privileges+v.id+"_";
                });
                privileges=privileges.substring(0,privileges.length-1);
                //alert('没有被选中的权限');
                $.ajax({
                    url:"http://<?php echo HTTP_HOST;?>/admin_dodisprivilege",
                    dataType:'json',
                    type:'get',
                    data:{'privileges':privileges,'role_id':role_id},
                    success:function(data){
                        var type;
                        if(data.status==1)
                        {
                            type="success";
                        }
                        else
                        {
                            type="error";
                        }
                        $('#ico_loading').hide();
                        $('#validation_btn').on('click',funcClick);

                        swal({
                            title: "提示",
                            text: data.msg,
                            type: "info",
                            showCancelButton: false
                        }, function () {
                            location.href = "<?php echo HTTP_DOMAIN; ?>/admin_todistprivilege";
                        });
                    },
                    error:function(xhr,text,error){
                        $('#ico_loading').hide();
                        $('#validation_btn').on('click',funcClick);
                        swal({
                            title: "提示",
                            text: "请求失败",
                            type: "info",
                            showCancelButton: false
                        }, function () {
                            location.href = "<?php echo HTTP_DOMAIN; ?>/admin_todistprivilege";
                        });
                    }
                });
            }
            else
            {
                swal('提示','不能完全取消权限，否则请禁用该角色','error');
                $('#ico_loading').hide();
                $('#validation_btn').on('click',funcClick);
            }
        }
        //每次加载节点触发的方法
        function onAsyncSuccess(event, treeId, treeNode, msg) {
            //递归展开子节点
            if(treeNode != undefined){
                expandNodes(treeNode.children, treeId);
            }
        }

        //递归展开子节点
        function expandNodes(nodes, treeId) {
            if (!nodes) return;
            var zTree = $.fn.zTree.getZTreeObj(treeId);
            for (var i=0, l=nodes.length; i<l; i++) {
                zTree.expandNode(nodes[i], true, false, false);
                if (nodes[i].isParent && nodes[i].zAsync) {
                    expandNodes(nodes[i].children, treeId);
                }
            }
        }
        $('#sel_role').change(function(){
            role_id=$(this).val();

            if(role_id!=-1)
            {
                $('#dl_btns').show();
                //$('#treePrivilege').show();
                var setting = {
                    check: {enable: true},
                    async: {
                        enable: true,
                        url:"<?php echo 'http://'.HTTP_HOST.'/admin_getprivilege';?>",
                        autoParam:["id"],
                        otherParam: { "role_id":role_id},
                        type: "get"
                    },
                    check: {
                        enable: true,
                        autoCheckTrigger: true
                    },
                    data:{
                        simpleData:{
                            enable: true
                        }
                    },
                    callback : {
                        onAsyncSuccess : onAsyncSuccess
                    }
                };
                treeObj=$.fn.zTree.init($("#treePrivilege"), setting);
                //延迟展开根节点
                setTimeout(function(){
                    var nodes = treeObj.getNodes();
                    if(nodes.length >0){
                        for (var i=0, l=nodes.length; i<l; i++) {
                            treeObj.expandNode(treeObj.getNodes()[i], true, false, false);
                        }
                    }
                },1000);
            }
            else if(role_id==-1)
            {
                $('#dl_btns').hide();
                $("#treePrivilege").empty();
            }
        });

        var $print_link = $('#print-link');
        $print_link.unbind('click');
        $print_link.on('click', function (e) {
            e.stopPropagation();
        });
    });
</script>
</body>

</html>
