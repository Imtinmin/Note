<?php if(!defined("RUN_MODE")) die();?>
<?php
/**
 * The control file of visual module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Hao Sun <sunhao@cnezsoft.com>
 * @package     visual
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class visual extends control
{
    /**
     * Visual index
     *
     * @access public
     * @return void
     */
    public function index($referer = '')
    {
        $template = $this->config->template->{$this->app->clientDevice}->name;
        $this->loadModel('block')->loadTemplateLang($template);;

        $this->view->referer = helper::safe64decode($referer);
        $this->view->title   = $this->lang->visual->common;
        $this->view->blocks  = $this->lang->block->{$template};

        if($referer == '') $this->view->referer = getWebRoot();
        $this->display();
    }

    /**
     * Eidt logo
     *
     * @access public
     * @return void
     */
    public function editLogo()
    {
        $this->app->loadLang('ui');
        $template = $this->config->template->{$this->app->clientDevice}->name;
        $theme    = $this->config->template->{$this->app->clientDevice}->theme;
        $logoSetting = isset($this->config->site->logo) ? json_decode($this->config->site->logo) : new stdclass();;

        $logo = '';
        if(isset($logoSetting->$template->themes->all))    $logo = $logoSetting->$template->themes->all;
        if(isset($logoSetting->$template->themes->$theme)) $logo = $logoSetting->$template->themes->$theme;
        if($logo) $logo->extension = $this->loadModel('file')->getExtension($logo->pathname);

        $this->view->title = $this->lang->ui->setLogo;
        $this->view->logo  = $logo;
        $this->display();
    }

    /**
     * Eidt slogan
     *
     * @access public
     * @return void
     */
    public function editslogan()
    {
        $this->display();
    }

    /**
     * Fix a block in a region.
     *
     * @access public
     * @return void
     */
    public function fixBlock($page, $region, $blockID, $object = '')
    {
        $template = $this->config->template->{$this->app->clientDevice}->name;
        $theme    = $this->config->template->{$this->app->clientDevice}->theme;
        $layout   = $this->loadModel('block')->getLayout($template, $theme, $page, $region, $object);

        $blocks   = json_decode($layout->blocks);
        foreach($blocks as $block)
        {
            if($block->id == $blockID) $this->view->block = $block;
        }

        if($_POST)
        {
            $block = fixer::input('post')
                ->setDefault('titleless', 0)
                ->setDefault('borderless', 0)
                ->add('id', $blockID)
                ->get();

            $this->block->fixBlock($layout, $block);
            $this->send(array('result' => 'success'));
        }

        $this->view->layout = $layout;
        $this->display();
    }

    /**
     * Remove block from a region.
     * 
     * @access public
     * @return void
     */
    public function removeBlock($blockID, $page, $region, $object = '')
    {
        $template = $this->config->template->{$this->app->clientDevice}->name;
        $theme    = $this->config->template->{$this->app->clientDevice}->theme;

        $result = $this->loadModel('block')->removeBlock($template, $theme, $page, $region, $object, $blockID);
        $this->send($result);
    }

    /**
     * Append a block to region.
     * 
     * @access public
     * @return void
     */
    public function appendBlock($page, $region, $parent = 0, $allowregionblock = false, $object = '')
    {
        $blockModel = $this->loadModel('block');

        $template = $this->config->template->{$this->app->clientDevice}->name;
        $theme    = $this->config->template->{$this->app->clientDevice}->theme;

        if($_POST)
        {
            $block  = $this->post->block;
            $result = $blockModel->appendBlock($template, $theme, $page, $region, $object, $parent, $block);
            $this->send($result);
        }

        $blockModel->loadTemplateLang($template);

        $this->view->blocks   = $blockModel->getList($template);
        $this->view->page     = $page;
        $this->view->region   = $region;

        $this->view->page             = $page;
        $this->view->parent           = $parent;
        $this->view->allowregionblock = $allowregionblock;
        $this->view->typeList         = $this->lang->block->{$template}->typeList;
        $this->display();
    }

    /**
     * Sort blocks.
     * 
     * @param  string    $page 
     * @param  string    $region 
     * @param  int       $parent 
     * @access public
     * @return void
     */
    public function sortBlocks($page, $region, $parent = 0, $object = '')
    {
        $template = $this->config->template->{$this->app->clientDevice}->name;
        $theme    = $this->config->template->{$this->app->clientDevice}->theme;

        if($_POST)
        {
            $return = $this->loadModel('block')->sortBlocks($template, $theme, $page, $region, $object, $parent, $this->post->orders);
            if($return) $this->send(array('result' => 'success', 'message' => $this->lang->saveSuccess));
            $this->send(array('result' => 'fail', 'message' => dao::getError()));
        }
    }
}
