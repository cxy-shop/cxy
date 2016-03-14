/**
 * Created by zhbitcxy on 16/2/17.
 * $.ajax异步请求全局拦截器
 */
$(function () {
    //var loading = null;
    //$.ajaxSetup({
    //    global: true,
    //    dataType : 'json'
    //});
    $(document)
        .ajaxComplete(function (event, xhr, settings) {
            //排除html片段和数据列表
            if (xhr.responseJSON !== undefined){
                var obj = $.parseJSON(xhr.responseText);
                //统一处理错误显示
                if (undefined !== obj.success && 0 === obj.success){
                    layer.msg(obj.msg, {
                        offset: 0,
                        shift: 1
                    });
                }
            }
        })
        .ajaxError(function () {
            layer.msg('系统错误!',{
                offset: 0,
                shift: 1
            });
        });
        //.ajaxStart(function () {
        //    loading = layer.load(0);
        //})



});