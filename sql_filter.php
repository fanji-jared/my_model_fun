<?php
/*
<?php
//初始加载项
require "./funs/sql_filter.php";

require "./funs/mysqli_fun.php";

require "./config.php";
//储存数据库连接的参数

if($is_install){
    if(sql_install("./tk_fanji.sql","localhost",$username,$password,"tk_fanji")){
        echo "<script>console.log('数据库安装成功！');</script>";
    }else{
        echo "<script>console.log('数据库安装失败！');</script>";
    }
}
?>
*/
//主函数
function filter($str){
    $farr = array(
        "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
        "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
        "/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dump/is");

    $str = preg_replace($farr,'',$str);

    return sql_filter($str);
}
#内置sql硬核过滤函数
function sql_filter($str){
    
    if (empty($str)) return false;

    $str = htmlspecialchars($str);

    $str = str_replace( '/', "", $str);

    $str = str_replace( '"', "", $str);

    $str = str_replace( '(', "", $str);

    $str = str_replace( ')', "", $str);

    $str = str_replace( 'CR', "", $str);

    $str = str_replace( 'ASCII', "", $str);

    $str = str_replace( 'ASCII 0x0d', "", $str);

    $str = str_replace( 'LF', "", $str);

    $str = str_replace( 'ASCII 0x0a', "", $str);

    $str = str_replace( ',', "", $str);

    $str = str_replace( '%', "", $str);

    $str = str_replace( ';', "", $str);

    $str = str_replace( 'eval', "", $str);

    $str = str_replace( 'open', "", $str);

    $str = str_replace( 'sysopen', "", $str);

    $str = str_replace( 'system', "", $str);

    $str = str_replace( '$', "", $str);

    $str = str_replace( "'", "", $str);

    $str = str_replace( "'", "", $str);

    $str = str_replace( 'ASCII 0x08', "", $str);

    $str = str_replace( '"', "", $str);

    $str = str_replace( '"', "", $str);

    $str = str_replace("", "", $str);

    $str = str_replace("&gt", "", $str);

    $str = str_replace("&lt", "", $str);

    $str = str_replace("<SCRIPT>", "", $str);

    $str = str_replace("</SCRIPT>", "", $str);

    $str = str_replace("<script>", "", $str);

    $str = str_replace("</script>", "", $str);

    $str = str_replace("select","",$str);

    $str = str_replace("join","",$str);

    $str = str_replace("union","",$str);

    $str = str_replace("where","",$str);

    $str = str_replace("insert","",$str);

    $str = str_replace("delete","",$str);

    $str = str_replace("update","",$str);

    $str = str_replace("like","",$str);

    $str = str_replace("drop","",$str);

    $str = str_replace("DROP","",$str);

    $str = str_replace("create","",$str);

    $str = str_replace("modify","",$str);

    $str = str_replace("rename","",$str);

    $str = str_replace("alter","",$str);

    $str = str_replace("cas","",$str);

    $str = str_replace("&","",$str);

    $str = str_replace(">","",$str);

    $str = str_replace("<","",$str);

    $str = str_replace(" ",chr(32),$str);

    $str = str_replace(" ",chr(9),$str);

    $str = str_replace("    ",chr(9),$str);

    $str = str_replace("&",chr(34),$str);

    $str = str_replace("'",chr(39),$str);

    $str = str_replace("<br />",chr(13),$str);

    $str = str_replace("''","'",$str);

    $str = str_replace("css","'",$str);

    $str = str_replace("CSS","'",$str);

    $str = str_replace("<!--","",$str);

    $str = str_replace("convert","",$str);

    $str = str_replace("md5","",$str);

    $str = str_replace("passwd","",$str);

    $str = str_replace("password","",$str);

    $str = str_replace("../","",$str);

    $str = str_replace("./","",$str);

    $str = str_replace("Array","",$str);

    $str = str_replace("or 1='1'","",$str);

    $str = str_replace(";set|set&set;","",$str);

    $str = str_replace("`set|set&set`","",$str);

    $str = str_replace("--","",$str);

    $str = str_replace("OR","",$str);

    $str = str_replace('"',"",$str);

    $str = str_replace("*","",$str);

    $str = str_replace("-","",$str);

    $str = str_replace("+","",$str);

    $str = str_replace("/","",$str);

    $str = str_replace("=","",$str);

    $str = str_replace("'/","",$str);

    $str = str_replace("-- ","",$str);

    $str = str_replace(" -- ","",$str);

    $str = str_replace(" --","",$str);

    $str = str_replace("(","",$str);

    $str = str_replace(")","",$str);

    $str = str_replace("{","",$str);

    $str = str_replace("}","",$str);

    $str = str_replace("-1","",$str);

    $str = str_replace("1","",$str);

    $str = str_replace(".","",$str);

    $str = str_replace("response","",$str);

    $str = str_replace("write","",$str);

    $str = str_replace("|","",$str);

    $str = str_replace("`","",$str);

    $str = str_replace(";","",$str);

    $str = str_replace("etc","",$str);

    $str = str_replace("root","",$str);

    $str = str_replace("//","",$str);

    $str = str_replace("!=","",$str);

    $str = str_replace("$","",$str);

    $str = str_replace("&","",$str);

    $str = str_replace("&&","",$str);

    $str = str_replace("==","",$str);

    $str = str_replace("#","",$str);

    $str = str_replace("@","",$str);

    $str = str_replace("mailto:","",$str);

    $str = str_replace("CHAR","",$str);

    $str = str_replace("char","",$str);
    return $str;
}
//安装sql数据库
function sql_install($file,$name,$root,$pwd,$database){
//将表导入数据库
$_sql = file($file);//写自己的.sql文件

//第一个参数为域名，第二个为用户名，第三个为密码，第四个为数据库名字
$_mysqli = new mysqli($name,$root,$pwd,$database);
if (mysqli_connect_errno()){
    exit('连接数据库出错' . PHP_EOL);
} else {
    // Temporary variable, used to store current query
    $tempLine = '';

    //执行sql语句
    foreach ($_sql as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $tempLine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            $query_res = $_mysqli->query($tempLine . ';');
            if (!$query_res) {
                
                echo "↓=================================导入sql语句失败=================================" . PHP_EOL;
                
                echo ($tempLine) . PHP_EOL;
                echo '错误:' . $_mysqli->error . PHP_EOL;
                echo "↑=================================导入sql语句失败=================================" . PHP_EOL;
                echo "-----------------------------------------------------------------------------------" . PHP_EOL;
                
                return false;
            }
            // Reset temp variable to empty
            $tempLine = '';
        }
    }

    echo "导入数据库执行完成" . PHP_EOL;
    
    return true;
}
$_mysqli->close();
$_mysqli = null;

}
?>