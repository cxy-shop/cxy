## 简介
 cxy的自营电商系统

## css模块化
视图分级后这里通过加前缀的方式来模块化css,防止命名冲突,污染样式
顶级(一级) - t
二级开始从a开始,跳过k(k是kendoui前缀)

## 安全性
* website/Static, Upload 目录及其子目录其他人需要有读写权限,不能有执行权限
* website/Public 目录及其子目录其他人需要有读权限,不能有写和执行权限
* Application Thinkphp Upload目录及其子目录 所有者和所在组都是php,其他人没有任何权限

## 新增常量
* __WEBSITE_PATH__ 表示系统入口目录的本地路径
* __STATIC_PATH__ 表示系统存放静态文件目录的本地路径
* __UPLOAD_TMP_PATH__ 表示上传文件临时存储的本地路径
* __BACKUP_PATH__ 表示删除文件时备份文件的本地路径