<?php

/**
 * zadk_001模块微站定义
 *
 * @author Hellbao
 * @url
 */
defined('IN_IA') or exit('Access Denied');

class Zadk_001ModuleSite extends WeModuleSite {

    public function doMobileIndex() {
        //这个操作被定义用来呈现 功能封面
    }

    public function doWebBackimg() {
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
        include $this->template('backimg');
    }

    public function doWebAddimg() {
        global $_GPC, $_W;
        include $this->template('addimg');
    }

    public function doWebMoodmessage() {
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
        include $this->template('moodmessage');
    }

    public function doWebSavemoodmessage() {
        global $_GPC, $_W;
        $return = $this->saveData('moodmessage', $_GPC['data']);
        echo json_encode($return);
    }

    public function doWebGetmoodmessage() {
        global $_GPC, $_W;
        $return = $this->getData('moodmessage', $_GPC['moodmessage_id']);
        echo json_encode($return);
    }

    public function doWebUser() {
        //这个操作被定义用来呈现 管理中心导航菜单
    }

    public function doWebSignrecord() {
        //这个操作被定义用来呈现 管理中心导航菜单
    }

//    --------------------------------------------------------------------------
    public function saveData($table, $formData) {
        global $_GPC, $_W;
        parse_str($formData, $Array);
        if (empty($Array['id'])) {
            unset($Array['id']);

            $result = pdo_insert($_GPC['m'] . '_' . $table, $Array);
            if (!empty($result)) {
                $return['status'] = 'ok';
                $return['data'] = pdo_insertid();
            } else {
                $return['status'] = 'waring';
                $return['data'] = '添加失败！waring:' . $result;
            }
        } else {
            $result = pdo_update($_GPC['m'] . '_' . $table, $Array, array('id' => $Array['id']));
            if (!empty($result)) {
                $return['status'] = 'ok';
                $return['data'] = $result;
            } else {
                $return['status'] = 'waring';
                $return['data'] = '更新失败！waring:' . $result;
            }
        }
        return $return;
    }

    public function getData($table, $id) {
        global $_GPC, $_W;
        $result = pdo_get($_GPC['m'] . '_' . $table, array('id' => $id), array('*'));
        if (isset($result)) {
            $returnData['status'] = 'ok';
            $returnData['data'] = $result;
        } else {
            $returnData['status'] = 'error';
            $returnData['data'] = '失败：' . $result;
        }
        return $returnData;
    }

}
