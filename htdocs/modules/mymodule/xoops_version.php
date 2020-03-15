<?php
/**
 * myModule
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code 
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         mymodule
 * @since           1.0.0
 * @author          Solo71
 * @version         $Id$
 */

    Global $xoopsModule;

$modversion['name']        = _MI_MYMODULE_NAME;
$modversion['version']     = 1.0;
$modversion['description'] = _MI_MYMODULE_DSC;
$modversion['credits']     = 'Solo';
$modversion['author']      = 'Solo';
$modversion['help']        = '';
$modversion['license']     = 'GPL see LICENSE';
$modversion['official']    = 0;
$modversion['image']       = 'images/mymodule.slogo.png';
$modversion['dirname']     = 'mymodule';

// Admin
// Admin things
$modversion['system_menu']                  = 1;
$modversion['hasAdmin']                     = 1;
$modversion['adminindex']                   = 'admin/urw.php';
$modversion['adminmenu']                    = 'admin/menu.php';

# Main
$i=0;
$modversion['hasMain'] = 1;
    $modversion['sub'][$i]['name'] = _MI_COLOCATION_INDEX;
    $modversion['sub'][$i++]['url'] = "index.php";
    $modversion['sub'][$i]['name'] = _MI_COLOCATION_ITEM;
    $modversion['sub'][$i++]['url'] = "item.php";

#### Templates
$i=0;
## User Side
$modversion['templates'][$i]['file']          = 'mymodule.index.html';
$modversion['templates'][$i++]['description'] = 'Main Page';
$modversion['templates'][$i]['file']          = 'tpl/mymodule.table.html';
$modversion['templates'][$i++]['description'] = 'Sample Page';

## Admin Side
$modversion['templates'][$i]['file']          = 'mymodule.admin.html';
$modversion['templates'][$i++]['description'] = 'Default Admin Content';

#### Settings

#### Urw
$modversion['hasUrw']                      = 1;

#### URW ###
$i=0;
$modversion['config'][$i]['name']        = 'urw_isactive';            # current module urw activation
$modversion['config'][$i]['title']       = '_MI_MYMODULE_URW';
$modversion['config'][$i]['description'] = '_MI_MYMODULE_URWDSC';
$modversion['config'][$i]['help']        = '_MI_MYMODULE_URWHLP';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i++]['default']   = '1';

$modversion['config'][$i]['name']        = 'urw_module';              # current module name rewrite
$modversion['config'][$i]['title']       = '_MI_MYMODULE_MODULE';
$modversion['config'][$i]['description'] = '_MI_MYMODULE_MODULEDSC';
$modversion['config'][$i]['help']        = '_MI_MYMODULE_MODULEHLP';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'input';
$modversion['config'][$i++]['default']   = 'task_manager';  

$modversion['config'][$i]['name']        = 'urw_index';               # Optional : index.php rewrited name.
$modversion['config'][$i]['title']       = '_MI_MYMODULE_INDEX';
$modversion['config'][$i]['description'] = '_MI_MYMODULE_INDEXDSC';
$modversion['config'][$i]['help']        = '_MI_MYMODULE_INDEXHLP';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'input';
$modversion['config'][$i++]['default']   = 'tasks';

$modversion['config'][$i]['name']        = 'urw_item';                # Optional : item.php rewrited name.
$modversion['config'][$i]['title']       = '_MI_MYMODULE_ITEM';
$modversion['config'][$i]['description'] = '_MI_MYMODULE_ITEMDSC';
$modversion['config'][$i]['help']        = '_MI_MYMODULE_ITEMHLP';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'input';
$modversion['config'][$i++]['default']   = 'task';

/*

## Note: due to limitation to the xoops config system, those settings can't be used. 
         Idealy, we could create a "hidden" formtype with those datas. But this is core business.

$modversion['config'][$i]['name']        = 'urw_op';                  # List of the available operators per page.
 $modversion['config'][$i]['title']       = 'Operators';
 $modversion['config'][$i]['description'] = 'Operators';
# $modversion['config'][$i]['help']        = '_MI_MYMODULE_INDEXHLP';
$modversion['config'][$i]['formtype']    = 'textarea';
$modversion['config'][$i]['valuetype']   = 'array';
## Restricted to 9 operators by page - Apache limitation
$modversion['config'][$i++]['default']   = array(
                                                 'index|id:cat_id,
                                                        id:status,
                                                        id:priority,
                                                        id:duration,
                                                        id:uid,
                                                        id:users_uid,
                                                        id:start,
                                                        tx:keyw',

                                                 'item| id:id,
                                                        tx:op'
                                                 );

*/
#### URW ###
?>