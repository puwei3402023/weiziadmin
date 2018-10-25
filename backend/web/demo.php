<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/17
 * Time: 21:54
 */
$arr=[
   [ 'id'=>1,'pid'=>0,'name'=>'菜单0'],
   [ 'id'=>2,'pid'=>1,'name'=>'菜单1-0'],
   [ 'id'=>3,'pid'=>0,'name'=>'菜单1-0'],
   [ 'id'=>4,'pid'=>1,'name'=>'菜单1-1'],
   [ 'id'=>4,'pid'=>2,'name'=>'菜单2-0'],
];
$key='id';
$parentKey='pid';
$childKey='children';
$count=count($arr);
$tmpMap = [];
$r=[];
echo "<pre>";
for($i=0;$i<$count;++$i){
    $tmpMap[$arr[$i][$key]] = $arr[$i];
}
/**
 * if (tmpMap[sNodes[i][parentKey]] && sNodes[i][key] != sNodes[i][parentKey]) {
console.log(i)
console.log(tmpMap)
console.log(tmpMap[sNodes[i][parentKey]][childKey])
if (!tmpMap[sNodes[i][parentKey]][childKey])
tmpMap[sNodes[i][parentKey]][childKey] = [];
tmpMap[sNodes[i][parentKey]][childKey].push(sNodes[i]);
} else {
r.push(sNodes[i]);
}
 */
for($i=0;$i<$count;++$i){
    if (isset($tmpMap[$arr[$i][$parentKey]]) && $arr[$i][$key] != $arr[$i][$parentKey]) {
//        $tmpMap[$arr[$i][$parentKey]][].push(sNodes[i]);
//        array_push($r[$arr[$i][$parentKey][$i]],$arr[$i]);
    }else{
        array_push($r,$arr[$i]);
        unset($arr[$i]);
    }
}
foreach($arr as $key=>$v){
    foreach($arr as $k=>$vv){
        if($v['id']==$vv['pid']){
            $arr[$key][]=$vv;
        }
    }
}

$arr=[
    [ 'id'=>1,'pid'=>0,'name'=>'菜单0'],
    [ 'id'=>2,'pid'=>1,'name'=>'菜单1-0'],
    [ 'id'=>3,'pid'=>0,'name'=>'菜单1-01'],
    [ 'id'=>4,'pid'=>1,'name'=>'菜单1-1'],
    [ 'id'=>4,'pid'=>2,'name'=>'菜单2-0'],
];
 function GetTree($arr,$pid,$step){
    global $tree;
    foreach($arr as $key=>$val) {
        if($val['pid'] == $pid) {
            $flg = str_repeat('└―',$step);
            $val['name'] = $flg.$val['name'];
            $tree[] = $val;
            GetTree($arr , $val['id'] ,$step+1);
        }
    }
    return $tree;
}
$a=GetTree($arr, 0, 0);
var_dump($a);