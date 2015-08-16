<?php

/**
 * @author blog.anchen8.net
 * @copyright 2015
 */
//echo("funch");
function ask_uploadimg($inputname,$uploadfolder)
{
    echo $inputname;
    //全局变量
    //$arrType=array('image/jpg','image/gif','image/png','image/bmp','image/pjpeg');
    $max_size = '5000000000'; // 最大文件限制（单位：byte）
    $upfile = $uploadfolder; //图片目录路径
    if (!isset($_FILES[$inputname])) {
        //检查$_FILES['upfile']是否存在，只有它存在的时候才进行对上传的文件的处理
        //echo "1232131";
        return null;
    }

    $file = $_FILES[$inputname];
    if ($_FILES[$inputname]["error"] > 0) {
        echo "Error: " . $_FILES[$inputname]["error"] . "<br />";
        return null;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') { //判断提交方式是否为POST
        if (!is_uploaded_file($file['tmp_name'])) { //判断上传文件是否存在
            echo "<font color='#FF0000'>文件不存在！</font>";
            return null;
        }

        if ($file['size'] > $max_size) { //判断文件大小是否大于500000字节
            echo "<font color='#FF0000'>上传文件太大！</font>";
            return null;
        }

        $arr = array(
            1 => "gif",
            2 => "jpeg",
            3 => "png",
            4 => "jpg");
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        
        //echo 'fname = '. $file['tmp_name'] .' ,ext = '.$extension.'$file[name] = '.$file['name'];
        if (!in_array($extension, $arr)) { //后缀是图片
            echo "<font color='#FF0000'>上传文件格式不对！</font>";
            return null;
        }

        if (!file_exists($upfile)) { // 判断存放文件目录是否存在
            mkdir($upfile, 0777, true);
        }
        $imageSize = getimagesize($file['tmp_name']);
        $img = $imageSize[0] . '*' . $imageSize[1];
        $fname = $file['name'];
        $ftype = explode('.', $fname);
        $picName = $upfile . "/ask" . time().'.'.$extension;

        if (file_exists($picName)) {
            echo "<font color='#FF0000'>同文件名已存在！</font>";
            return null;
        }
        if (!move_uploaded_file($file['tmp_name'], $picName)) {
            echo "<font color='#FF0000'>移动文件出错！</font>";
            return null;
        } 
        /*else {
            echo "<font color='#FF0000'>图片文件上传成功！</font><br/>";
            echo "<font color='#0000FF'>图片大小：$img</font><br/>";
            echo "图片预览：<br><div>
    <img src=\"" . $picName . "\" width=".$width. "height=".$height."></div>";
        }*/
        return $picName;
    }
}

?>