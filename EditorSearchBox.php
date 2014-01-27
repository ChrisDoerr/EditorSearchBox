<?php
/**
 * Editor Search Box Core Class.
 *
 * @category    Editor Search Box
 * @copyright   Copyright (c) 2014 http://www.meomundo.com
 * @author      Christian Doerr <doerr@meomundo.com>
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU General Public License, version 2 (GPL-2.0)
 */
class EditorSearchBox {
  
  public function __construct() {

    /**
     * Load meta box (only) when opening an existin post in the editor.
     */
    if( is_admin() ) {
  
      add_action( 'load-post.php', array( $this, 'metaBoxSetup' ) );

    }

  }

  /**
   * Register the new custom meta box.
   */
  public function metaBoxSetup() {

    add_action( 'add_meta_boxes', array( $this, 'addMetaBox' ) );

  }

  /**
   * Actually create the new custom meta box.
   */
  public function addMetaBox() {
  
    /** 
     * You only want the meta box to appear when editing post, pages or custom post types.
     * So the easiest way to achieve this is to exclude certain post types and basically
     * allow all the others.
     */
    $blacklist  = array( 'attachement', 'revision', 'nav_menu_item' );

    $postTypes  = get_post_types();
  
    foreach( $postTypes as $postType ) {
   
      if( !in_array( $postType, $blacklist ) ) {
    
        add_meta_box(
          'editorSearchBox',
          _x( 'Search', 'esb' ),
          array( $this, 'viewMetaBox' ),
          $postType,
          'side',
          'default'
        );
    
      }
  
    }

  }

  /**
   * View the search bpx
   *
   * @param object Post object (automatically being provided by the internal WordPress API call).
   */
  public function viewMetaBox( $object ) {
    
    $postType   = get_post_type( $object->ID );
    
    if( $postType === false ) {

      $postType = 'post';
 
    }

    $html = ' <input type="text" name="s" id="EditorSearchBoxInput" />';

    $html .= '<p><a href="javascript:void(0);" class="button-secondary" onclick="javascript:window.location=\'edit.php?post_status=all&post_type=' . $postType . '&action=-1&m=0&paged=1&mode=list&action2=-1&s=\'+encodeURIComponent(document.getElementById(\'EditorSearchBoxInput\').value);">' . _x( 'Search', 'esb' ) . "</a></p>\n";

    echo $html;
    
  }

}
?>