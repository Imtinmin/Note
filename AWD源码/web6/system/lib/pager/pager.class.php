<?php
/**
 * ZenTaoPHP的分页类。
 * The pager class file of ZenTaoPHP framework.
 *
 * The author disclaims copyright to this source code.  In place of
 * a legal notice, here is a blessing:
 * 
 *  May you do good and not evil.
 *  May you find forgiveness for yourself and forgive others.
 *  May you share freely, never taking more than you give.
 */

helper::import(dirname(dirname(__FILE__)) . '/base/pager/pager.class.php');
/**
 * pager类.
 * Pager class.
 * 
 * @package framework
 */
class pager extends basePager
{
    /**
     * 创建每页显示记录数的select标签。
     * Create the select object of record perpage.
     * 
     * @access public
     * @return string
     */
    public function createRecPerPageJS()
    {
        /* 
         * 替换recTotal, recPerPage, pageID为特殊的字符串，然后用js代码替换掉。
         * Replace the recTotal, recPerPage, pageID to special string, and then replace them with values by JS.
         **/
        $params = $this->params;
        foreach($params as $key => $value)
        {
            if(strtolower($key) == 'rectotal')   $params[$key] = '_recTotal_';
            if(strtolower($key) == 'recperpage') $params[$key] = '_recPerPage_';
            if(strtolower($key) == 'pageid')     $params[$key] = '_pageID_';
        }
        $vars = '';
        foreach($params as $key => $value) $vars .= "$key=$value&";
        $vars = rtrim($vars, '&');

        $js  = <<<EOT
        <script language='Javascript'>
        vars = '$vars';
        pageCookie = '$this->pageCookie';
        function submitPage(mode, perPage)
        {
            pageTotal  = parseInt(document.getElementById('_pageTotal').value);
            pageID     = document.getElementById('_pageID').value;
            recPerPage = document.getElementById('_recPerPage').getAttribute('data-value');
            recTotal   = document.getElementById('_recTotal').value;
            if(mode == 'changePageID')
            {
                if(pageID > pageTotal) pageID = pageTotal;
                if(pageID < 1) pageID = 1;
            }
            else if(mode == 'changeRecPerPage')
            {
                recPerPage = perPage;
                pageID = 1;
            }
            $.cookie(pageCookie, recPerPage, {expires:config.cookieLife, path:config.cookiePath});

            vars = vars.replace('_recTotal_', recTotal)
            vars = vars.replace('_recPerPage_', recPerPage)
            vars = vars.replace('_pageID_', pageID);
            location.href=createLink('$this->moduleName', '$this->methodName', vars);
        }
        </script>
EOT;
        return $js;
    }
}
