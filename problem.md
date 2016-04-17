# thinkphp问题
1.tp 模版继承不能写 js和css代码
2.order 不能自动字段映射,拉取的数据也没有自动完成字段映射,字段映射功能不完善
3.tp使用了魔术方法和字段导致感应无效,这会不方便代码编写和阅读,性能也没直接写效率高
4.函数在IDE里面与类没有任何优势,类有强大的自动化支持
5.数据对象取出来后不会自动根据map转成相应驼峰式的写法,类似的where,order等方法里面要用数据库字段名,不能用映射名的缺陷,或者说这个是否需要关注是设计的问题
6.没有自动(值)转换功能
7.需要修复
NOTIC: [8] Undefined index: validate /Users/zhbitcxy/PhpstormProjects/cxy-shop/ThinkPHP/Library/Think/Model.class.php 第 1185 行.
NOTIC: [8] Undefined index: auto /Users/zhbitcxy/PhpstormProjects/cxy-shop/ThinkPHP/Library/Think/Model.class.php 第 1128 行.

# kendo问题
1.kendo  grid 删除记录的时候如何自定义提示窗口
2.kendo upload multiple html属性不能绑定问题 
    状态:没解决 ps:文档已经查阅,但是没有找到有表明支持这个属性的意图 
    替代方案:让autoUpload为true,这样只取最后一次上传的值,但是方案不完美,体现在删除上传文件的处理,当删除上一个上传图片也会把当前预览图抹除了
3.img 的属性src如何绑定?data-bind="src:<field>"无效
    状态:解决 使用src="#:<field>#"绑定,data-bind="value|checked|disable:<field>"用在表单元素上
4.grid编辑/新增弹出窗口无法使用第三方编辑器,就是第一次能初始化,但是下次弹出就无效了的bug
    状态:未解决
5.popup弹出窗编辑,多个记录不能正常工作问题
    状态:解决,给form模版加上name=id的input
6.由于tp没有对读取的数据进行字段名反映射,这里有2个方法解决
1.kendo model的每个字段配置field指定真实字段名
2.重载tp方法,对其进行字段反映射
这里采取了2的方案,因为这样可以增强数据库字段的屏蔽,虽然方案1效率更高

# public问题
1.kendoui-gird里面使用了check表单,其值必须为true,false才能有对应的行为,mysql可以自动完成转换成tinyint类型,
但是kendoui需要接受true,false值才能正常显示,导致要在后台代码里另外转换,给开发维护带来麻烦
    ps:已经找到出问题的地方,原因是因为true,false,tp框架自动把他们都转成了0
    解决方案,1后台转换(缺点:需要在编辑,新增,读取的时候都手动替换,麻烦),2.前台转换(同前面一样),3.修改数据库字段为枚举类型(最佳解决方案),但是还是需要在tp模型中设置自动转换,把true,false转成成字符串,默认情况的tp框架会转换成0
    
# 未完善功能
1.图片上传部分,获得的图片路径应该是显示在input里面,并且也要支持可以直接给定url设置上传图片的功能.