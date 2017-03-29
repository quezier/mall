/**
 * @param object obj 被点击的对象
 * @param string 被应用本方法的所有按钮的选择器名称，通常是class
 * @param string url_getbyparentid 查询属于同一父级分类的分类
 * @param int is_brand 是否继续查询品牌 1:是 2:否
 * @param string url_getbrandbycateid 通过分类查询品牌的url
 * @param int is_attr 是否继续查询属性 1:是 2:否
 * @param string url_getgoodsattrbycateid 通过分类查询属性的url
 * @returns 
 */
var arrayName = [];//分类名称，数组
var arrayCateId = [];//分类编号，数组
var arrname = $('#c_name').val();//数据库存储的分类名称
if (arrname != null && arrname != "")
{
    arrayName = arrname.split(',');
}
var arrid = $('#c_id').val();//数据库存储的分类编号
if (arrid != null && arrid != "")
{
    arrayCateId = arrid.split(',');
}


function getCategoryByPid(obj, all_btn_class, url_getbyparentid, is_brand, url_getbrandbycateid)
{
    $('.goodsattr').remove();
    $('.btn_category_class').unbind('click');
    var attr_id = obj.attr('id');
    var tmp_id_arr = attr_id.split("|");
    var pid = tmp_id_arr[0];
    var category_class = tmp_id_arr[1];
    if (category_class == 1)
    {
        $('#class_div_2').empty();
        $('#class_div_3').empty();
        $('#class_div_4').empty();
    } else if (category_class == 2)
    {
        $('#class_div_3').empty();
        $('#class_div_4').empty();
    } else if (category_class == 3)
    {
        $('#class_div_4').empty();
    }

    var current_category_name = obj.find('a span').html();
    obj.siblings('li').find('a span').removeClass('tips_choiced');
    obj.find('a span').addClass('tips_choiced');
    $.ajax({
        url: url_getbyparentid + '?pid=' + pid,
        dataType: 'json',
        type: 'get',
        success: function (data) {
            $('#brand_id').empty();
            $('#brand_id').append('<option value="">请选择品牌</option>');
            $('#brand_series_id').empty();
            $('#brand_series_id').append('<option value="">请选择品牌</option>');
            //分类改变时，清空品牌及系列
            $('#select2-brand_id-container').text("请选择品牌");
            $('#select2-brand_id-container').attr('title', "请选择品牌");
            $('#select2-brand_series_id-container').text("请选择品牌");
            $('#select2-brand_series_id-container').attr('title', "请选择品牌");
            if (data.status == 1)
            {

                if (data.result.length > 0)
                {
                    var next_category_class = category_class * 1 + 1;
                    var categories = data.result;
                    var html_sub_category = '<ul>';
                    $.each(categories, function (i, v) {
                        html_sub_category += '<li id="' + v.id + '|' + next_category_class + '"  class="btn_category_class"><a href="javascript:void(0)" class=""><span >' + v.goodscate_name + '</span></a></li>';
                    });
                    html_sub_category += "</ul>";
                    $('#class_div_' + next_category_class).empty();
                    $('#class_div_' + next_category_class).append(html_sub_category);
                } else
                {
                    $('#category_id').val(pid);
                    if (is_brand === 1)
                    {
                        $.ajax({
                            url: url_getbrandbycateid + '?cate_id=' + pid,
                            async: false,
                            type: 'get',
                            dataType: 'json',
                            success: function (data) {
                                if (data.result.length > 0)
                                {
                                    $.each(data.result, function (i, v) {
                                        $('#brand_id').append('<option value="' + v.id + '">' + v.brand_name + '</option>');
                                    });
                                }
                            },
                            error: function (XMLHttpRequest, textStatus, errorThrown) {
                                swal('提示', '请求错误', 'error');
                            }
                        });
                    }
                    //检查数组是否已存在

                    var index_1 = $.inArray(pid, arrayCateId);
                    if (index_1 < 0)
                    {
                        arrayCateId.push(pid);
                    }

                    //检查数组是否已存在
                    var index =  $.inArray(current_category_name, arrayName);
                    if (index < 0)
                    {
                        arrayName.push(current_category_name);
                    }

                }
                $(all_btn_class).on('click', function () {
                    getCategoryByPid($(this), all_btn_class, url_getbyparentid, is_brand, url_getbrandbycateid);
                });
                $('#commoditydd').html(current_category_name);
                //添加编辑品牌时分类名称和编号
                $('#commoditydd1').empty();
                $('#category_id1').empty();
                for (var k = 0; k < arrayName.length; k++)
                {
                    if (k == 7 || k == 14 || k == 21)
                    {
                        $('#commoditydd1').append('<br/>');
                    }
                    $('#commoditydd1').append('<span>' + arrayName[k] + '</span>&nbsp;&nbsp;<a href="javascript:void(0);"  onclick="delName(' + k + ')"><span> × </span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
                    $('#category_id1').val(arrayCateId.join(','));
                }

            } else
            {
                swal('提示', data.msg, 'error');
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            swal('提示', '请求错误', 'error');
        }
    });

}

//页面删除分类后，重新加载数据
function delName(i)
{
    for (var k = 0; k < arrayName.length; k++)
    {
        if (k == i)
        {
            arrayName.splice(k, 1); //数组删除元素
            arrayCateId.splice(k, 1);
        }
    }
    $('#commoditydd1').empty();
    $('#category_id1').empty();
    for (var k = 0; k < arrayName.length; k++)
    {
        if (k == 7 || k == 14 || k == 21)
        {
            $('#commoditydd1').append('<br/>');
        }
        $('#commoditydd1').append('<span>' + arrayName[k] + '</span>&nbsp;&nbsp;<a href="javascript:void(0);"  onclick="delName(' + k + ')"><span> × </span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
        $('#category_id1').val(arrayCateId.join(','));
    }
}

