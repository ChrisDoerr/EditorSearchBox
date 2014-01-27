<?php
/*
Plugin Name:  Editor Search Box
Description:  Adds a search box to the editor sidebar so you don't always have to go back to the movie index. JS needs to be enabled and you need to click the button(!) since RETURN will SAVE THE POST.
Author:       Chris Doerr
Version:      1.0.0
Author URI:   http://www.meomundo.com/
*/

if( !class_exists( 'EditorSearchBox' ) ) {
  
  include_once 'EditorSearchBox.php';
  
}

$EditorSearchBox = new EditorSearchBox();

?>