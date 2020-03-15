<?php
/**
 * Todo
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
 * @package         tarifs
 * @since           1.0.0
 * @author          Solo71
 * @version         $Id$
 */



require_once( '../../../include/cp_header.php' );
include_once( '../../../class/urw/Module.urw.php' );
include_once( '../include/xoopsModuleConfig.inc.php' );

       $xoopsOption['template_main'] = 'mymodule.admin.html';

/*
        $op     = isset($_REQUEST['op'])   ? $_REQUEST['op']   : 'form';
        $name   = isset($_REQUEST['name']) ? $_REQUEST['name'] : 'mymodule';
*/

        # $urwForm->UrwThisModule( $name );

        xoops_cp_header();
        $urwForm = new ModuleUrw;
        $urwForm->FullUrwThisModule();
        $xoopsTpl->assign( 'items',   $urwForm->UrwRenderForm() );
/*

switch ( $op ) {

        default:
        case 'form':
            $xoopsTpl->assign( 'items',   $urwForm->UrwRenderForm() );
        break;

        case 'apply':

                                          $urwForm->UrwCopyHtaccess();
            $xoopsTpl->append( 'items',   $urwForm->UrwRenderForm() );

        break;
}
*/
        xoops_cp_footer();
?>