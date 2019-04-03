<?php
/**
 * zadk_001模块微站定义
 *
 * @author Hellbao
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class Zadk_001ModuleSite extends WeModuleSite
{

    public function doMobileIndex()
    {
        //这个操作被定义用来呈现 功能封面
    }

    public function doWebBackimg()
    {
        //这个操作被定义用来呈现 管理中心导航菜单
        $page = 1111;
        include $this->template('backimg');
    }

    public function doWebMoodmessage()
    {
        global $_GPC, $_W;

        $pindex = max(1, intval($_GPC['page']));
        $psize = 10;

        if (!empty($_GPC['content'])) {
            $moodList = pdo_fetchall('SELECT * FROM ' . tablename('zadk_001_moodmessage') . ' WHERE content LIKE :content order by `id` desc LIMIT ' . ($pindex - 1) * $psize . ',' . $psize, array(':content' => '%' . $_GPC['content'] . '%'));
            $total = pdo_fetchcolumn('SELECT count(1) as totle FROM ' . tablename('zadk_001_moodmessage') . ' WHERE content LIKE :content order by `id` desc ', array(':content' => '%' . $_GPC['content'] . '%'));
        } else {
            $moodList = pdo_fetchall('SELECT * FROM ' . tablename('zadk_001_moodmessage') . ' order by `id` desc LIMIT ' . ($pindex - 1) * $psize . ',' . $psize);
            $total = pdo_fetchcolumn('SELECT count(1) as totle FROM ' . tablename('zadk_001_moodmessage') . ' order by `id` desc ');
        }

        $pager = pagination($total, $pindex, $psize);
        $addRul=$this->createWebUrl('addmoodmessage');
        include $this->template('moodmessage');
    }

    public function doWebAddmoodmessage()
    {
        echo json_encode($_GPC);
    }

    public function doWebUser()
    {
        //这个操作被定义用来呈现 管理中心导航菜单
    }

    public function doWebSignrecord()
    {
        //这个操作被定义用来呈现 管理中心导航菜单
    }


}