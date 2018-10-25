<?php
namespace backend\Entity;
use common\models\Analyze;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/26
 * Time: 14:06
 */
class BsendEntity
{
    //总条数对象
    protected $count;

    //获取短信方案发送人 根据等级 计数出总共人数
    public function get_edai_usersystab_count($where, $type)
    {
        $this->count=Analyze::find();
//        $this->count = (new \yii\db\Query());
        $count = $this->count->select('count("u.uid") as count')
            ->from(['u' => 'edai_usersystab'])
            //用户实名信息表
            ->leftJoin('edai_memberinfotb as m', 'm.miuid = u.unumbers')
            ->where(['u.teshuhao' => 1])
            ->andWhere("u.userphone not in (select phone FROM edai_new_duanxinlogs WHERE `type`={$type})")
        ;
        //调用钩子函数加入条件查询
        $this->where($where);
        $count = $count->createCommand()->queryOne();

        return $count;
    }
    //钩子函数
    private function where($where)
    {
        foreach ($where as $v) {
            $this->count->andWhere($v);
        }
    }
}