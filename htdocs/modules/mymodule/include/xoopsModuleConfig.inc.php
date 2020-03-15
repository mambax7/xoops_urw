<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Xoops UrwRewriting
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl.html GNU public license
 * @package         class
 * @subpackage      FusionCharts
 * @since           1.0.0
 * @author          Benoît Puissant <benoit@comptoir-des-medias.com>
 * @version         $Id: TabsDisplay.php 3173 2011-07-11 07:00:00Z Solo71 $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

$xoopsModuleConfig['urw_ops'] = array(
                                                 'index|id:UrwIsActive,
                                                        tx:UrwExt,
                                                        id:UrwSeparator,
                                                        id:UrwMaxKeyWSize,
                                                        id:UrwMaxKeyW,
                                                        id:op_1,
                                                        id:op_2,
                                                        tx:op_3,
                                                        tx:op_4',

                                                 'item| id:id,
                                                        tx:op'
                                                 );
?>