/**
 * @name common
 * @info 描述：
 * @author Hellbao <1036157505@qq.com>
 * @datetime 2019-4-4 14:54:24
 */


//全局变量---------------------------------------------------------------------------------------

//函数--------------------------------------------------------------------------------------------
//列表全选
function setAllChecked(obj) {
    if (obj.checked == true) {//选中
        $($('input[name="rowChecked"]')).each(function () {
            $(this).prop('checked', true);
        });
    } else {//取消选中
        $($('input[name="rowChecked"]')).each(function () {
            $(this).prop('checked', false);
        });
    }
}
//清空表单数据
function clearForm(form) {
    // 迭代input清空
    $(':input', form).each(function () {
        var type = this.type;
        var tag = this.tagName.toLowerCase(); // normalize case
        if (type == 'text' || type == 'password' || tag == 'textarea' || type == 'hidden')
            this.value = "";
        // 跌代多选checkboxes
        else if (type == 'checkbox')
            this.checked = false;
        // select 迭代下拉框
        else if (tag == 'select')
            this.selectedIndex = -1;
        //单选按钮
        else if (tag == 'radio') {
            //操作
        }
    });
}