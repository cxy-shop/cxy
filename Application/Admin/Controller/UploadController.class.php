<?php
/**
 * Created by PhpStorm.
 * User: zhbitcxy
 * Date: 16/3/28
 * Time: 下午3:27
 */

namespace Admin\Controller;
/**
 * 图片,文件上传控制器
 * Class UploadController
 * @package Admin\Controller
 */
class UploadController extends BaseController
{
    /**
     * 上传文件处理
     */
    public function uploadImage()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 最大上传大小3m
        $upload->exts = ['jpg', 'gif', 'png', 'jpeg'];// 设置附件上传类型
        $upload->rootPath = './Static/tmp/'; // 设置附件上传根目录
        $upload->savePath = ''; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload();
        if (!$info) {
            // 上传错误提示错误信息
            $this->ajaxFail($upload->getError());
        } else {
            // 上传成功 获取上传文件信息
            $data = [];
            foreach ($info as $file) {
                $data[] = ['path' => $file['savepath'] . $file['savename']];
            }
            $this->ajaxSuccess('ok', $data);
        }
    }

    /**
     * 移除上传文件处理
     */
    public function removeUploadImage()
    {
        $fileName = I('fileNames');
        $filePath = __UPLOAD_TMP_PATH__ . $fileName;

        //这里可以不保证删除成功
        $this->safeUnlink($filePath);

        $this->ajaxSuccess();
    }

    /**
     * 移动文件到安全目录
     * @param $subDirName
     * @param $filePath
     * @return bool
     */
    public function moveImageToDir($subDirName, $filePath){
        //子目录名和路径不能为空,不然会修改tmp目录名
        if ( empty($subDirName) || empty($filePath) ){
            return false;
        }
        $oldFilePath = __UPLOAD_TMP_PATH__ . $filePath;
        $newFilePath = __STATIC_PATH__ . $subDirName . '/' . $filePath;
        $dirPath =__STATIC_PATH__  . $subDirName . '/' . dirname($filePath);
        //创建子目录
        if ( !is_dir(__STATIC_PATH__  . $subDirName) ){
            //TODO 这里得考虑创建权限问题
            mkdir(__STATIC_PATH__  . $subDirName);
        }
        //创建日期目录
        if( !is_dir( $dirPath ) )
        {
            //TODO 这里得考虑创建权限问题
            mkdir($dirPath);
        }
        if ( file_exists($oldFilePath) ) {
            rename($oldFilePath, $newFilePath);
            return true;
        }
        return false;
    }

    /**
     * 安全删除文件
     * @param $filePath
     * @return bool
     */
    public function safeUnlink($filePath){
        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }else{
            return false;
        }
    }
}