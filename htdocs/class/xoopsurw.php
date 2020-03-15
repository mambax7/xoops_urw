<?php

class XoopsUrlRewrite {

      /**
     * Access the only instance of this class
     *
     * @return object
     * @static
     * @staticvar object
     */
    function &getInstance()
    {
        static $instance;
        if (!isset($instance)) {
            $instance = new XoopsUrlRewrite();
        }
        return $instance;
    }

####################################
## Rendering                      ##
####################################

    function XoUrlRewrite( $caption=null, $link=null )
      {
                                                    
                                                     $config_handler =& xoops_gethandler('config');
                                                     $xoopsConfigUrw = $config_handler->getConfigsByCat(8, 0);

                              if( ( isset( $this->UrwIsActive ) && !$this->UrwIsActive ) || !$xoopsConfigUrw['isUrw'] ) return $link;

                              isset( $this->UrwExt )         && $this->UrwExt===''    ? '' : $this->UrwExt         = $xoopsConfigUrw['UrwExt'];
                              isset( $this->UrwSeparator )   && $this->UrwSeparator   ? '' : $this->UrwSeparator   = $xoopsConfigUrw['UrwSeparator'];
                              isset( $this->UrwMaxKeyWSize ) && $this->UrwMaxKeyWSize ? '' : $this->UrwMaxKeyWSize = $xoopsConfigUrw['UrwMaxKeyWSize'];
                              isset( $this->UrwMaxKeyW )     && $this->UrwMaxKeyW     ? '' : $this->UrwMaxKeyW     = $xoopsConfigUrw['UrwMaxKeyW'];
                              isset( $this->UrwOperators )                            ? '' : $this->UrwOperators   = null;
                              isset( $this->UrwModule )                               ? '' : $this->UrwModule      = null;
                              isset( $this->UrwPagesNames )                           ? '' : $this->UrwPagesNames  = null;
                              isset( $this->UrwModuleName )                           ? '' : $this->UrwModuleName  = null;

                  strstr( $link, '.php' ) ? $uri  = pathinfo( $link ) : $uri['filename'] = 'index';
                                                                        $uri['dirname']  = $this->UrwModule;
                  $link = str_replace('+', 'pimp_my_plus', $link);
                  @list( $base, $vars ) =
                          explode( '?', $link );
                          parse_str( $vars, $var );
                      if( !$var ) { $var = array(); }

                             ksort( $var );
                                              $ops   = array();

                             $this->UrwVar = $var;

                       $ops = isset( $this->UrwOperators[$uri['filename']] ) ? XoopsUrlRewrite::UrwOpAsArray( $this->UrwOperators[$uri['filename']] )
                                                                             : XoopsUrlRewrite::UrwOpAsArray( $this->UrwVar );

                  isset( $this->UrwPagesNames[$uri['filename']] ) && $this->UrwPagesNames[$uri['filename']] 
                                                                  ?  $uri['filename'] = $this->UrwPagesNames[$uri['filename']] : '';
                  isset( $this->UrwModuleName ) && $this->UrwModuleName
                                                                  ?  $uri['dirname'] = $this->UrwModuleName                    : '';

                  $caption      ? $url[] = XoopsUrlRewrite::UrwMakeKeyWords( $caption ) : '';

                                           $ret  = '';
                                           $ret .= $uri['dirname'] ? ( $uri['dirname']  . '/' ) : '';
                                           $ret .= $uri['filename'] . '/';
                                           $ret .= $ops && $var ? implode( $this->UrwSeparator, $ops ) . '/' : '';

                  isset( $url )          ? $ret .= implode( '-', $url ) : '';
                         $this->UrwExt   ? $ret .= '.' . $this->UrwExt  : '';

                                   $ret = str_replace('pimpmyplus', '+', $ret);
                                    Return XOOPS_URL . '/' . $ret;

      }

/* Functions */
function UrwMakeKeyWords( $caption )
      {
      $this->UrwMaxKeyWSize ? '' : $this->UrwMaxKeyWSize = 1;
      $this->UrwMaxKeyW     ? '' : $this->UrwMaxKeyW     = 100;
      $caption = strtolower( html_entity_decode( utf8_decode( trim( strip_tags( $caption ) ) ) ) );
      $caption = strtr( $caption,
                        '\\/\'"ΰαβγδηθικλμνξορςστυφωϊϋόύÿΐΑΒΓΔΗΘΙΚΛΜΝΞΟΡÒΣΤΥΦΩΪΫάέ',
                        '  __aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');

      $in      = array('  ', '?', '!', '.', ',', ':', "'", '"', '&', '(', ')', '[', ']', '{', '}', '___', '__', '---', '--','-');
      $out     = array(' ', '',  '',  '',  '',  '',  '-', '',  'et','',  '',  '',  '',  '',  '',  '_',   '_', '-', '-', ' ' );
      $caption = str_replace($in, $out, $caption);

      $caption = preg_replace('#&[^;]+;#', '', $caption);

      $words   = explode( ' ', $caption );
                                                          $words_array   = array();
                                                          $i=1;
      foreach( $words as $word ) { if( strlen( trim( $word ) ) >= $this->UrwMaxKeyWSize ) {
                                   $words_array[] = $word;
                                   if( ++$i>$this->UrwMaxKeyW ) break(0);
                                   } }
      Return implode( '-', $words_array );
      }
      
      

function UrwOpAsArray( $operators=null )
      {
      
      foreach( $operators as $k=>$v ) {

      if( is_array( $v ) ) {


          foreach( $v as $kk=>$vv ) { $ops[] = isset( $this->UrwVar[$vv] ) ? $this->UrwVar[$vv] : ''; }

  } else {
                                      $ops[] = isset( $this->UrwVar[$k] )  ? $this->UrwVar[$k] : '';
         } // if array  

      } // foreach
      
      Return $ops;

      }

/* Module Settings */
function UrwModule( $module=null )
      {
      $this->UrwModule = $module;
      }

function UrwPagesNames( $pages=null )
      {
      $this->UrwPagesNames = $pages;
      }

function UrwModuleName( $name=null )
      {
      $this->UrwModuleName = $name;
      }

function UrwOperators( $operators=null )
      {
       foreach( $operators as $id=>$op_list ) {

             list( $page, $operators ) = explode('|', $op_list );
                   $operators = explode(',', $operators);

             foreach( $operators as $ops ) {   
             list(    $type, $op )                  = explode(':', $ops );
                      $operators_array[trim( $op )] = trim( $op );
             }
                       ksort( $operators_array );
 $this->UrwOperators[$page] = $operators_array;
                       unset( $operators_array );
       }
      }

function UrwIsActive( $isactive=1 )
      {
      $this->UrwIsActive = $isactive;
      }

/* Core Settings */
function UrwExt( $ext='' )
      {
      $this->UrwExt = $ext;
      }

function UrwMaxKeyWSize( $size=0 )
      {
      $this->UrwMaxKeyWSize = $size;
      }

function UrwMaxKeyW( $max=0 )
      {
      $this->UrwMaxKeyW = $max;
      }

function UrwSeparator( $sep='|' )
      {
      $this->UrwSeparator = $sep;
      }

}

?>