<?php
include_once("setup.php");
//-------------------設定區-----------------------//
@$op=$_REQUEST['op'];
$user_id=empty($_REQUEST['user_id'])?"":intval($_REQUEST['user_id']);
//---------------流程控制區----------------------//
switch($op){  
    case "modify_user":
    modify_user($user_id);
    header("location:{$_SERVER['PHP_SELF']}");
    break;

    case "modify_form":
    $content=bootstrap(add_user_form($user_id));
    break;
    
    case "delete_user":
    delete_user($user_id);
    header("location:{$_SERVER['PHP_SELF']}");
    break; 
    case "add_user":
    add_user();
    header("location:{$_SERVER['PHP_SELF']}");
    break; 
    case "add_user_form":
    $content=bootstrap(add_user_form());
    break; 
    default:
    $content=bootstrap(user_list());
}

//------------------輸出區----------------------//
echo $content;
//----------------------函數區-------------------------//
function modify_user($user_id=""){
    global $link;
    $sql="update `user` set 
        user_name='{$_POST['user_name']}',
        user_sex='{$_POST['user_sex']}',
        user_adress='{$_POST['user_adress']}',
        user_mail='{$_POST['user_mail']}',
        user_phone='{$_POST['user_phone']}',
        user_tel='{$_POST['user_tel']}',
        user_birth='{$_POST['user_birth']}',
        user_pro='{$_POST['user_pro']}',
        user_intro='{$_POST['user_intro']}' 
        where user_id='{$user_id}'
        ";
    mysqli_query($link,$sql) or die_content(mysqli_error($link)."修改資料失敗");
}

function delete_user($user_id=""){
    global $link;
    $sql="delete from `user` where user_id='{$user_id}'";
    mysqli_query($link,$sql) or die_content(mysqli_error($link)."刪除資料失敗");
}

function add_user(){
    global $link;
    $sql="insert into `user` (
        `user_name`, `user_sex`, 
        `user_adress`, `user_mail`, 
        `user_phone`, `user_tel`, 
        `user_birth`, `user_pro`, `user_intro`) 
        values (
        '{$_POST['user_name']}','{$_POST['user_sex']}',
        '{$_POST['user_adress']}','{$_POST['user_mail']}',
        '{$_POST['user_phone']}','{$_POST['user_tel']}',
        '{$_POST['user_birth']}','{$_POST['user_pro']}','{$_POST['user_intro']}'
        )";
      mysqli_query($link,$sql) or die_content(mysqli_error($link)."新增資料失敗");   
}

function add_user_form($user_id=""){
    global $link;
    //先判斷是修改還是要新增資料，依據狀況不同產生不同的資料
    if(empty($user_id)){
        //新增表單的資料
        $title="新增客戶資料表單";
        $user_name=$user_sex=$user_adress=$user_mail=$user_phone=$user_tel=$user_birth=$user_pro=$user_intro="";
        $op="
        <input type='hidden' name='op' value='add_user'>
        <button type='submit' class='btn'>送出新增</button>
        ";
    }else{
        //修改表單的資料
        $title="修改客戶資料表單";
        //取得個人的資料
        $sql="select * from `user` where user_id='{$user_id}'";
        $result=mysqli_query($link,$sql) or die_content(mysqli_error($link)."檢索資料失敗");
        $data = mysqli_fetch_assoc($result);
        foreach($data as $i=>$v){
            $$i=$v;
        }
        //經過上面的處理已經取得單筆客戶的資料，並以欄位名稱為變數名稱
        $op="
        <input type='hidden' name='op' value='modify_user'>
        <input type='hidden' name='user_id' value='{$user_id}'>
        <button type='submit' class='btn'>送出修改</button>
        ";
    }
    
    $main="
    <form class='form-horizontal' method='post' action='{$_SERVER['PHP_SELF']}'>
    <fieldset>
    <legend>{$title}</legend>
    <div class='control-group'>
    <label class='control-label' >輸入姓名</label>
    <div class='controls'>
    <input type='text' name='user_name' value='{$user_name}' placeholder='輸入姓名'>
    </div>
    </div>
    <div class='control-group'>
    <label class='control-label' >選擇性別</label>
    <div class='controls'>
    ".get_radio($user_sex)."
    </div>
    </div>
    <div class='control-group'>
    <label class='control-label' >輸入地址</label>
    <div class='controls'>
    <input type='text' name='user_adress' value='{$user_adress}' placeholder='輸入地址' class='span4'>
    </div>
    </div>
    <div class='control-group'>
    <label class='control-label' >輸入電子郵件</label>
    <div class='controls'>
    <input type='text' name='user_mail' value='{$user_mail}' placeholder='輸入電子郵件' class='span4'>
    </div>
    </div>
    <div class='control-group'>
    <label class='control-label' >輸入手機</label>
    <div class='controls'>
    <input type='text' name='user_phone' value='{$user_phone}' placeholder='輸入手機'>
    </div>
    </div>
    <div class='control-group'>
    <label class='control-label' >輸入電話</label>
    <div class='controls'>
    <input type='text' name='user_tel' value='{$user_tel}' placeholder='格式如：08-8887777'>
    </div>
    </div>
    <div class='control-group'>
    <label class='control-label' >輸入生日</label>
    <div class='controls'>
    <input type='text' name='user_birth' value='{$user_birth}' placeholder='格式如2013-02-01'>
    </div>
    </div>
    <div class='control-group'>
    <label class='control-label' >輸入職業與職位</label>
    <div class='controls'>
    <input type='text' name='user_pro' value='{$user_pro}' placeholder='輸入職業與職位'>
    </div>
    </div>
    <div class='control-group'>
    <label class='control-label' >輸入客戶簡介</label>
    <div class='controls'>
    <textarea name='user_intro' placeholder='輸入客戶簡介'  class='span4'>{$user_intro}</textarea>
    </div>
    </div>
    {$op}
    </fieldset>
    </form>
    ";
    return $main;
}

function get_radio($sex=""){
    $main="";
    $sex_arr=array("男","女");
    foreach($sex_arr as $v){
        if(empty($sex))$sex="男";
        $check=($sex==$v)?"checked":"";
        $main.="<input type='radio' name='user_sex' {$check} value='{$v}'>{$v}";    
    }
    return $main;

} 
function user_list(){
    global $link;
    $main="
    <script>
    $(function(){
        $('.btn-danger').click(function(){
            confirm('確認刪除該筆資料');
        });
    });
    </script>
    <table class='table table-hover table-condensed table-bordered table-striped'>
    <caption><h3>客戶資料列表</h3></caption>
    <thead>
    <tr>
    <th>姓名</th>
    <th>性別</th>
    <th>地址</th>
    <th>電子郵件</th>
    <th>手機</th>
    <th>電話</th>
    <th>生日</th>
    <th>職業與職位</th>
    <th>客戶簡介</th>
    <th>功能鍵</th>
    </tr>
    </thead>
    <tbody>
    ";
    $sql="select * from `user`";
    $result=mysqli_query($link,$sql) or die_content(mysqli_error($link)."檢索資料失敗");
    while($data = mysqli_fetch_assoc($result)){
        foreach($data as $i=>$v){
            $$i=$v;
        }
        $main.="
        <tr>
        <td>{$user_name}</td>
        <td>{$user_sex}</td>
        <td>{$user_adress}</td>
        <td>{$user_mail}</td>
        <td>{$user_phone}</td>
        <td>{$user_tel}</td>
        <td>{$user_birth}</td>
        <td>{$user_pro}</td>
        <td>{$user_intro}</td>
        <td>
        <a class='btn btn-warning' href='{$_SERVER['PHP_SELF']}?op=modify_form&user_id={$user_id}'>修改</a>
        <a class='btn btn-danger' href='{$_SERVER['PHP_SELF']}?op=delete_user&user_id={$user_id}'>刪除</a>
        </td>
        </tr>
        ";
    }
    $main.="
    </tbody>
    </table>"; 
    return $main;
}
?>