<?php
namespace app\admin\controller;

class Carousel extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $param = input();
        $param['page'] = intval($param['page']) <1 ? 1 : $param['page'];
        $param['limit'] = intval($param['limit']) <1 ? $this->_pagesize : $param['limit'];
        $where=[];

        if(!empty($param['wd'])){
            $param['wd'] = htmlspecialchars(urldecode($param['wd']));
            $where['carousel_name'] = ['like','%'.$param['wd'].'%'];
        }

        $order='carousel_id desc';
        $res = model('Carousel')->listData($where,$order,$param['page'],$param['limit']);

        $this->assign('list',$res['list']);
        $this->assign('total',$res['total']);
        $this->assign('page',$res['page']);
        $this->assign('limit',$res['limit']);

        $param['page'] = '{page}';
        $param['limit'] = '{limit}';
        $this->assign('param',$param);
        $this->assign('title','轮播管理');
        return $this->fetch('admin@carousel/index');
    }

    public function info()
    {
        if (Request()->isPost()) {
            $param = input();
            $res = model('Carousel')->saveData($param);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }

        $id = input('id');
        $where=[];
        $where['carousel_id'] = ['eq',$id];
        $res = model('Carousel')->infoData($where);


        $this->assign('info',$res['info']);
        $this->assign('title','轮播编辑');
        return $this->fetch('admin@carousel/info');
    }

    public function del()
    {
        $param = input();
        $ids = $param['ids'];

        if(!empty($ids)){
            $where=[];
            $where['carousel_id'] = ['in',$ids];
            $res = model('Carousel')->delData($where);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
            return $this->success($res['msg']);
        }
        return $this->error(lang('param_err'));
    }

    public function batch()
    {
        $param = input();
        $ids = $param['ids'];
        foreach ($ids as $k=>$id) {
            $data = [];
            $data['carousel_id'] = intval($id);
            $data['carousel_name'] = $param['carousel_name'][$k];
            $data['carousel_sort'] = $param['carousel_sort'][$k];
            $data['carousel_url'] = $param['carousel_url'][$k];
            $data['carousel_type'] = intval($param['carousel_type'][$k]);
            $data['carousel_logo'] = $param['carousel_logo'][$k];

            if (empty($data['carousel_name'])) {
                $data['carousel_name'] = lang('unknown');
            }
            $res = model('Carousel')->saveData($data);
            if($res['code']>1){
                return $this->error($res['msg']);
            }
        }
        $this->success($res['msg']);
    }

}
