<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System    		     //
//                    Copyright (c) 2004 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//                   							     //
//                  Authors :						     //
//				solo (www.wolfpackclan.com)                  //
//                  MyModule v1.x						     //
//  ------------------------------------------------------------------------ //

// General settings
include_once('header.php');

$xoopsOption['template_main'] = 'mymodule.index.html';
include_once(XOOPS_ROOT_PATH . '/header.php');

$options = array(   'UrwIsActive'    => 1,
                    'UrwExt'         => 'html',
                    'UrwSeparator'   => 0,
                    'UrwModuleName'  => 'new_name',
                    'UrwMaxKeyWSize' => 0,
                    'UrwMaxKeyW'     => 0,
                    'op_1'           => '',
                    'op_2'           => '',
                    'op_3'           => '',
                    'op_4'           => ''
                );

foreach( $options as $k=>$v ) {
         $options[$k] = $$k = isset($_REQUEST[$k])   ? $_REQUEST[$k]   : $v;
  }

$separators = array( 0 => array('name'=>' - Minus Sign', 'sign'=>'-'),
                     1 => array('name'=>', Coma',        'sign'=>','),
                     2 => array('name'=>'| Pipe',        'sign'=>'|'),
                     4 => array('name'=>'_ Underscore',  'sign'=>'_')
                     );

         $urw->UrwIsActive(   $options['UrwIsActive']);
         $urw->UrwExt(        $options['UrwExt']);
         $urw->UrwSeparator(  $separators[$options['UrwSeparator']]['sign']);
         $urw->UrwModuleName( $options['UrwModuleName']);
         $urw->UrwMaxKeyWSize($options['UrwMaxKeyWSize']);
         $urw->UrwMaxKeyW(    $options['UrwMaxKeyW']);
$xoopsTpl->assign('options',  $options);


$operators = explode('|', $xoopsModuleConfig['urw_ops'][0] );
$operators = explode(',', $operators[1] );
$link = array();
foreach( $operators as $val ) {
  list( $t, $i ) = explode(':', $val);
$ops[$i]           = $sample[$i]['id']  = isset($_REQUEST[$i]) ? $_REQUEST[$i] : ( isset( $options[$i] ) ? $options[$i] : null );
$sample[$i]['tp']  = $t;
isset( $ops[$i] ) && $ops[$i]!='' ? $link[$i]          = $i . '=' . $ops[$i] : '';
}





                                                 $caption     = 'Caption';
                                                 $description = isset($_REQUEST['seo'])   ? $_REQUEST['seo']   : 'This is not a description';
                                                 $url         = 'modules/mymodule/index.php?' . implode( '&', $link );
                                                 $surl        = 'index.php?' . implode( '&', $link );
               $xoopsTpl->assign('url',          $url);
               $xoopsTpl->assign('surl',         $surl);
               $xoopsTpl->assign('ops',          $ops);
               $xoopsTpl->assign('sample',       $sample);
               $xoopsTpl->assign('separators',   $separators);
               $xoopsTpl->assign('module',       $xoopsModule->getVar('dirname') );
               $xoopsTpl->assign('mid',          $xoopsModule->mid() );

## 3 methodes to send datas to smarty:
# Methode 1.
# Send rewrited link at php level
                                                 $link =  '<a href="' . $urw->XoUrlRewrite( $description, $url) . '" title="' . $description . '">' . $caption . '</a>';
               $xoopsTpl->assign('link',         $link);

# Methode 2.
# Send clas to smarty for conversion in the smarty
               $xoopsTpl->assign('urw',          $urw );            ## Send class to smarty
               $xoopsTpl->assign('caption',      $caption);
               $xoopsTpl->assign('description',  $description);
               


# Methode 3.
# Mixed methode
                                                 $link = $urw->XoUrlRewrite( $description, $url );
                                                 $link = str_replace( XOOPS_URL . '/', '', $link );
               $xoopsTpl->assign('urw_link',     $link);


include_once(XOOPS_ROOT_PATH . '/footer.php');
?>