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
 * Xoops TabsDisplay Class
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         http://www.fsf.org/copyleft/gpl. GNU public license
 * @package         class
 * @since           1.0.0
 * @author          Benoît Puissant <benoit@comptoir-des-medias.com>
 * @version         $Id: TabsDisplay.php 3173 2011-07-11 07:00:00Z Solo71 $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

class ModuleUrw {

####################################
##  Functions                     ##
####################################

function UrwThisModule( $newName=null ) {

  Global $xoopsModuleConfig, $xoopsModule;

         $config_handler =& xoops_gethandler('config');
         $xoopsConfigUrw = $config_handler->getConfigsByCat(8, 0);

  $module = $xoopsModule->getVar('dirname');

  $this->UrwNewModuleName = $xoopsModuleConfig['urw_module'] ? $xoopsModuleConfig['urw_module'] : $module;
  $this->UrwSeparator     = $xoopsConfigUrw['UrwSeparator']  ? $xoopsConfigUrw['UrwSeparator'] : '|';


  $rule[] = ' Options +FollowSymlinks
              RewriteEngine on
              RewriteBase /' . pathinfo( XOOPS_URL,  PATHINFO_DIRNAME );
  $rule[] = '';
  $rule[] = '##############################';
  $rule[] = '### Start module rewriting: [' . $module . '] ###';
  $rule[] = '';

  foreach( $xoopsModuleConfig['urw_ops'] as $datas ) {

                 ModuleUrw::ConvertUrwOperators( $datas );
                 
                 $this->UrwNewPage = isset( $xoopsModuleConfig['urw_' . $this->UrwPage] ) ?
                 $xoopsModuleConfig['urw_' . $this->UrwPage]
                                           : $this->UrwPage;

  $rule[] = '  ## Module: [' . $module . '] - Page: ' . $this->UrwPage . '.php';
  $rule[] = '       RewriteRule ^' . $this->UrwNewModuleName . '\/' . $this->UrwNewPage . '\/' . $this->UrwOperators . '\/.*$  modules/' . $module . '/' . $this->UrwPage . '.php?' . $this->PhpOperators . ' [L]';
  $rule[] = '       RewriteRule ^' . $this->UrwNewModuleName . '\/' . $this->UrwNewPage . '\/.*$ modules/' . $module . '/' . $this->UrwPage . '.php [L]';
  $rule[] = '';
  }
  $rule[] = '    # Module: [' . $module . '] - Main index';
  $rule[] = '       RewriteRule ^' . $this->UrwNewModuleName . '.*$  modules/' . $module . '/ [L]';
  $rule[] = '';
  $rule[] = '### End module rewriting: [' . $module . '] ###';
  $rule[] = '##############################';

  $this->UrwRules = implode('
', $rule);
} //function

function FullUrwThisModule( $newName=null ) {

  Global $xoopsModuleConfig, $xoopsModule;

         $config_handler =& xoops_gethandler('config');
         $xoopsConfigUrw = $config_handler->getConfigsByCat(8, 0);

  $module = $xoopsModule->getVar('dirname');

  $this->UrwNewModuleName = $xoopsModuleConfig['urw_module'] ? $xoopsModuleConfig['urw_module'] : $module;
  $separator              = array( '-', ',', '|', '_' );


  $rule[] = ' Options +FollowSymlinks
              RewriteEngine on
              RewriteBase /';
  $rule[] = '';
  $rule[] = '##############################';
  $rule[] = '### Start module rewriting: [' . $module . '] ###';
  $rule[] = '';

  foreach( $xoopsModuleConfig['urw_ops'] as $datas ) {
           $i=0;
    foreach( $separator as $this->UrwSeparator ) {

                 ModuleUrw::ConvertUrwOperators( $datas );
                 $this->UrwNewPage = isset( $xoopsModuleConfig['urw_' . $this->UrwPage] ) ?
                                            $xoopsModuleConfig['urw_' . $this->UrwPage]
                                                                      : $this->UrwPage;

      $i++ ? '' : $rule[] = '  ## Module: [' . $module . '] - Page: ' . $this->UrwPage . '.php';
      $rule[] = '  ## Separator : ( ' . $this->UrwSeparator . ' )';
      $rule[] = '       RewriteRule ^' . $this->UrwNewModuleName . '\/' . $this->UrwNewPage . '\/' . $this->UrwOperators . '\/.*$  modules/' . $module . '/' . $this->UrwPage . '.php?' . $this->PhpOperators . ' [L]';
    }
      $rule[] = '       RewriteRule ^' . $this->UrwNewModuleName . '\/' . $this->UrwNewPage . '\/.*$ modules/' . $module . '/' . $this->UrwPage . '.php [L]';
      $rule[] = '';
  }
  $rule[] = '    # Module: [' . $module . '] - Main index';
  $rule[] = '       RewriteRule ^' . $this->UrwNewModuleName . '.*$  modules/' . $module . '/ [L]';
  $rule[] = '';
  $rule[] = '### End module rewriting: [' . $module . '] ###';
  $rule[] = '##############################';

  $this->UrwRules = implode('
', $rule);
} //function



function ConvertUrwOperators( $op_list ) {

           Global $xoopsModule;
   
             list( $page, $operators ) = explode('|', $op_list );
                   $operators = explode(',', $operators);

             foreach( $operators as $op ) {
                list( $type, $op )          = explode(':', $op );
                      $operators_array[trim( $op )] = trim( $type );
             }
                       ksort( $operators_array );

         $urw = null;
         $php = null;
         $i=1;

         foreach( $operators_array as $name=>$type ) {
         $urw[$name] = $type == 'id' ? '(|[0-9]+)' : '(|[aA-zZ0-9]+)';
         $php[$name] = $name . '=$' . $i++;
         }

         $this->UrwPage      = $page;
         $this->UrwOperators = implode('\\' . $this->UrwSeparator, $urw);
         $this->PhpOperators = implode('&',  $php);
} //function


########################################
##               FORMS                ##
########################################
function UrwRenderForm() {


include_once( XOOPS_ROOT_PATH . '/class/xoopsformloader.php');
          $form = new XoopsSimpleForm( '', 'UrwForm', '' );
          $form->setExtra('enctype="multipart/form-data"');

 //         $form->addElement( new XoopsFormText( _MI_TODO_NEWNAME . ':', 'name', 10, 5, $this->UrwNewModuleName) );
 //         $form->addElement( new XoopsFormButton( '' , '', _SUBMIT, 'submit') );
          $form_urw = new XoopsFormTextArea('.htaccess', 'urw', $this->UrwRules, 50, 50);
          $form_urw->setExtra('onClick="document.UrwForm.urw.select(); document.UrwForm.urw.focus();"');
          $form->addElement( $form_urw );

//           $form_tray->addElement( new XoopsFormHidden( 'op' , 'clone') );
//

   Return '<div style="text-align: center;">' . $form->render() . '</div>';

} //function

function UrwNewModuleName( $newName ) {
         $this->UrwNewModuleName = $newName;
} //function

}        // Class

?>