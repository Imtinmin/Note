<?php
/**
 * Cms.php
 * Niushop商城系统 - 团队十年电商经验汇集巨献!
 * =========================================================
 * Copy right 2015-2025 山西牛酷信息科技有限公司, 保留所有权利。
 * ----------------------------------------------
 * 官方网址: http://www.niushop.com.cn
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和使用。
 * 任何企业和个人不允许对程序代码以任何形式任何目的再发布。
 * =========================================================
 * @author : niuteam
 * @date : 2015.1.17
 * @version : v1.0.0.0
 */
namespace app\shop\controller;

use data\service\Article as CmsService;
use data\service\Config;
use think\Log;

/**
 * 内容控制器
 * 创建人：李吉
 * 创建时间：2017-02-06 10:59:23
 */
class Cms extends BaseController
{



    public function _empty($name)
    {}

    /**
     * 文章分类列表
     */
    public function articleList()
    {
        $article = new CmsService();
        $class_id = isset($_GET['id']) ? $_GET['id'] : '';
        $pid = isset($_GET['class_id']) ? $_GET['class_id'] : '';
        $condition = [
            'nca.class_id' => $class_id
        ];
        $result = $article->getArticleList(1, 0, $condition, 'nca.create_time desc');
        $cmsList = $article->getArticleClass(1, 0, '', 'sort');
        
        $articleClass = $article->getArticleClassDetail($class_id);
        $name = $articleClass['name'];
        $this->assign("name", $name);
        
        $this->assign('cmsList', $cmsList['data']);
        $this->assign('result', $result['data']);
        $this->assign("pid", $pid);
        $this->assign('class_id', $class_id);
        return view($this->style . 'Cms/articleList');
    }

    /**
     * 根据文章id获取文章详情
     */
    public function articleClassInfo()
    {
        Log::write(microtime());
        $cms = new CmsService();
        // 文章ID
        $article_id = isset($_GET['article_id']) ? $_GET['article_id'] : '';
        $class_id = isset($_GET['id']) ? $_GET['id'] : '';
        $pid = isset($_GET['class_id']) ? $_GET['class_id'] : '';
        
        $info = null;
        Log::write(microtime());
        if (! empty($article_id)) {
            $info = $cms->getArticleDetail($article_id);
            $class_id = $info["class_id"];
            $articleClass = $cms->getArticleClassDetail($class_id);
            $pid = $articleClass['pid'];
        } else {
            $info["title"] = "帮助中心";
            $class_id = - 100;
            $info["content"] = "1、下完订单后在账户里看不见相关信息怎么办？<br/>
                                        您可能在{$this->shop_name}有多个账户，建议您核实一下当时下订单的具体账户，如有疑问您可致电客服400-99-00001，帮您核查。<br/>
             2、网站显示有赠品为何下单后没有收到赠品？<br/>
                                        赠品的配送是和您的收货地址有关的，若您在浏览商品时用的地址非最终的收货地址，有可能出现下单后没有赠品的情况；您所在的地址是否支持赠品配送，请以结算页面的购物明细为准，谢谢。";
        }
        Log::write(microtime());
        $content=htmlspecialchars_decode(html_entity_decode($info["content"]));
        $info["content"]=$content;
        $cmsList = $cms->getArticleClass(1, 0, '', 'sort');
        $this->assign('cmsList', $cmsList['data']);
        $this->assign('info', $info);
        $this->assign("article_id", $article_id);
        $this->assign('class_id', $class_id);
        $this->assign('pid', $pid);
        Log::write(microtime());
        return view($this->style . 'Cms/articleClassInfo');
    }
}