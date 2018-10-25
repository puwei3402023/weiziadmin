<?php
/**
 * Created by PhpStorm.
 * User: 伟
 * Date: 2016/11/8
 * Time: 11:39
 */

namespace frontend\component;


use frontend\logic\ChannelLogic;

class Excel
{

    /**
     * 导出excel
     * @param array $data 导出数据
     * @param string $name 导出文件名字
     */
    public function export_data($data = array(),$name='下载文件')
    {
        error_reporting(E_ALL); //开启错误
        set_time_limit(0); //脚本不超时
//        date_default_timezone_set('Europe/London'); //设置时间
        /** Include path **/
//        set_include_path(FCPATH . APPPATH . '/libraries/Classes/');//设置环境变量
        // Create new PHPExcel object
//        Include 'PHPExcel.php';
        $objPHPExcel = new \PHPExcel();
        // Set document properties

        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2003 XLS Test Document")
            ->setSubject("Office 2003 XLS Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2003 openxml php")
            ->setCategory("Test result file");
        // Add some data

        $objPHPExcel->setActiveSheetIndex(0);
        $letter = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
        if ($data) {
            $i = 1;
            foreach ($data as $key => $value) {
//                $newobj = $objPHPExcel->setActiveSheetIndex(0);
                $j = 0;
                foreach ($value as $k => $val) {
                    //  dump($val);
                    $index = $letter[$j] . "$i";
                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($index, $val);
                    $j++;
                }
                $i++;
            }
        }

        $date = date('Y-m-d', time());
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($date);
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $name . '.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * 渠道专用导出功能
     * @param $count
     * @param $name
     */
    public function csv($count,$title='',$name='渠道查询'){
        $userinfo=session::get('USER_INFO');
        $name=$userinfo['real_name'].$name.date('Y-m-d H:i:s');
        header ( "Content-type:application/vnd.ms-excel" );
        header ( "Content-Disposition:filename=" . iconv ( "UTF-8", "GBK", $name ) . ".csv" );
        $fp = fopen('php://output', 'a');

        $get_info_data=session::get('CHANNEL_GET_DATA');
        $lgoic=new ChannelLogic();

        foreach ($title as $i => $v) {
            $column_name[$i] = iconv('utf-8', 'gbk', $v);
        }
// 输出Excel列名信息
// 将数据通过fputcsv写到文件句柄
        fputcsv($fp, $column_name);
// 计数器
// 每隔$limit行，刷新一下输出buffer，不要太大，也不要太小
        $limits = 0;
// 逐行取出数据，不浪费内存
        while ($count>0){
           $count-=1000;
            $user=$lgoic->index_download($get_info_data,$limits);
            foreach ($user as $vv){
                foreach ($vv as $l=>$v){
                    $row[$l] = iconv('utf-8', 'gbk', $v);
                }
                fputcsv($fp, $row);
            }
            unset($user);
            ob_flush();
            flush();
            $limits+=1000;
        }
        exit;
    }
}