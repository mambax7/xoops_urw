<?php
// $Id$
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //


// Include header
include 'header.php';

$fields = array(
                 'conf_modid',
                 'conf_catid',
                 'conf_name',
                 'conf_title',
                 'conf_value',
                 'conf_desc',
                 'conf_formtype',
                 'conf_valuetype',
                 'conf_order'
                );
                
$row = 0;
$values = array(
                $row++ => "0, 8, 'isUrw',          '_MD_AM_URW_ISACTIVE',  0,   '_MD_AM_URW_ISACTIVEDSC',  'yesno',   'int',  0",
                $row++ => "0, 8, 'UrwSeparator',   '_MD_AM_URW_SEPARATOR', '-', '_MD_AM_URW_SEPARATORDSC', 'textbox', 'text', 1",
                $row++ => "0, 8, 'UrwExt',         '_MD_AM_URW_EXT',       '',  '_MD_AM_URW_EXTDSC',       'textbox', 'text', 2",
                $row++ => "0, 8, 'UrwMaxKeyW',     '_MD_AM_URW_MAX',       0,   '_MD_AM_URW_MAXDSC',       'int',     'int',  3",
                $row++ => "0, 8, 'UrwMaxKeyWSize', '_MD_AM_URW_MAXLENGHT', 0,   '_MD_AM_URW_MAXLENGHTDSC', 'textbox', 'text', 4",
                );


           foreach( $values as $i => $rows ) {
                         unset( $datas );
                                $datas = explode(", ", $rows);
                                $items[$i] = $datas[2];
                    for( $ii=0; $ii<count($fields); $ii++ ){
                    $update[$i][$ii] = $fields[$ii] . '=' . trim( $datas[$ii] );
                    }


           }

          foreach( $values as $i=>$insert ) {

           $sql  = ' SELECT conf_id ' ;
                   $sql .= ' FROM              '   . $xoopsDB->prefix( 'config' );
                   $sql .= ' WHERE conf_name = ' . $items[$i];
                   $list = $xoopsDB->queryF( $sql );

 if( $xoopsDB->fetchRow( $list ) ) {
                   $sql  = ' UPDATE '   . $xoopsDB->prefix( 'config' );
                   $sql .= ' SET ' . implode( ', ', $update[$i] );
                   $sql .= ' WHERE conf_name=' . $items[$i];
                   
                   $text[] = 'Config datas <span style="color:Green; font-weight:bold;">' . $items[$i] . '</span> updated!';

 } else {
                   $sql  = ' INSERT INTO   ' . $xoopsDB->prefix( 'config' );
                   $sql .= '        ( ' . implode( ', ', $fields ) . ' )';
                   $sql .= ' VALUES ( ' . implode( '), (', $values ) . ' )';

                   $text[] = 'New Config datas ' . $items[$i] . ' inserted!';
 }

         $xoopsDB->queryF( $sql );

}

                   $sql  = ' SELECT confcat_id ' ;
                   $sql .= ' FROM  '   . $xoopsDB->prefix( 'configcategory' );
                   $sql .= ' WHERE confcat_id=8 ';
                   $list = $xoopsDB->queryF( $sql );

 if( $xoopsDB->fetchRow( $list ) ) {
                   $sql  = ' UPDATE '   . $xoopsDB->prefix( 'configcategory' );
                   $sql .= ' SET   confcat_id=8,
                                   confcat_name="_MD_AM_URW",
                                   confcat_order=0';
                   $sql .= ' WHERE confcat_id=8 ';
                   
                   $text[] = 'Config category updated!';
 } else {
                   $sql  = ' INSERT INTO   ' . $xoopsDB->prefix( 'configcategory' );
                   $sql .= ' ( confcat_id, confcat_name, confcat_order )';
                   $sql .= ' VALUES ( 8, "_MD_AM_URW", 0 )';
                   
                   $text[] = 'New Config category inserted!';
 }

         $xoopsDB->queryF( $sql );


    xoops_cp_header();
    echo '<ul>';
    echo '<li>' . implode('</li><li>', $text) . '</li>';
    echo '</ul>';
    xoops_cp_footer();


?>