<?php
/**
 * To Do
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
 * @package         todo
 * @since           1.0.0
 * @author          Solo71
 * @version         $Id$
 */

// Common values
 	$com_val_array =  array(

  	                         'submited'   => 'Datas successfully submited!',
  	                         'updated'    => 'Datas successfully updated!',
  	                         'deleted'    => 'Datas successfully deleted!',

                                 );



// Render defines
        $item_val_array = array_merge( $com_val_array );

 	foreach ($item_val_array as $item_lg=>$item_val) {
                 define( strtoupper('_AD_TODO_'.$item_lg), $item_val );
	}
	



?>

