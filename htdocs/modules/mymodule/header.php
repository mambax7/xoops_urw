<?php
//  ------------------------------------------------------------------------ 	//
//                XOOPS - PHP Content Management System    				//
//                    Copyright (c) 2004 XOOPS.org                       	//
//                       <http://www.xoops.org/>                              //
//                   										//
//                  Authors :									//
//						- solo (www.wolfpackclan.com)         	//
//                  MYMODULE v1.0								//
//  ------------------------------------------------------------------------ 	//

include_once( '../../mainfile.php' );


#### URW ###

#### URW Module settings

/*  List all module pages operators 
    Exemple below:
    index = index.php -> page name
            id = operator type (id, tx: texte) 
            item_id = operator name

            Imortant!!! : There is a restriction to 9 operators by page due to Apache limitation
                          Order has no importance.
*/

include_once( 'include/xoopsModuleConfig.inc.php' );

/* 
$xoopsModuleConfig['urw_ops'] = array(
                                                 'index|id:id_1,
                                                        id:op_2,
                                                        id:operator_3,
                                                        id:operator_4,
                                                        id:operator_5,
                                                        id:operator_6,
                                                        id:operator_7,
                                                        tx:operator_8,
                                                        tx:operator_9',

                                                 'item| id:id,
                                                        tx:op'
                                                 );
*/
#### URW Class inclusion
include_once( XOOPS_ROOT_PATH . '/class/xoopsurw.php' );

    $urw  = &XoopsUrlRewrite::getInstance();
    
            $urw->UrwIsActive(  $xoopsModuleConfig['urw_isactive']    );        // urw is active or not on the module
            $urw->UrwOperators( $xoopsModuleConfig['urw_ops']         );        // Available operators for each and every rewrited page.php (see settings above)
             $urw->UrwExt(       'html'                              );         // current module extension * Optional: can be bypassed by website setting
             $urw->UrwSeparator( '|'                                 );         // operators separators     * Optional: can be bypassed by website setting
        
            $urw->UrwModule(    $xoopsModule->getVar('dirname')       );        // Current Module dirname
            $urw->UrwModuleName( $xoopsModuleConfig['urw_module']  );        // Replacement name for the module ex :       mymodule => my_url_rewrited_module
            $urw->UrwPagesNames( array(                                         // Replacement name for the module files ex : index    => my_index_page and item => my_item_page. * Can be defined in the modules
                                'index' => $xoopsModuleConfig['urw_index'],
                                'item'  => $xoopsModuleConfig['urw_item'] 
                                )
                      );
#### URW Module settings ###

?>
