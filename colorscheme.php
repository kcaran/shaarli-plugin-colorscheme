<?php
/**
 * Plugin Colorscheme
 *
 * Displays a color in #xxyyzz format as an inline sample block.
 */

use Shaarli\Plugin\PluginManager;
use Shaarli\Render\TemplatePage;

/* HSP Color Model - http://alienryderflex.com/hsp.html */
function dark_color( $match ) {
  $brightness = sqrt( .299 * pow( hexdec( $match[1] ), 2 ) + .587 * pow( hexdec( $match[2] ), 2 ) + .114 * pow( hexdec( $match[3] ), 2 ) );
  return ($brightness <= 127.5);
}

function display_color( $match ) {
  $hex_color = '#' . strtolower( $match[1] ) . strtolower( $match[2] ) . strtolower( $match[3] );

  $dark = dark_color( $match ) ? ' dark' : '';

  return '<a class="colorscheme' . $dark . '" style="background-color: ' .  $hex_color . '" href="#">' . $hex_color .  '</a>';
}

function colorscheme_url( $url ) {
  $pattern = '/^https:\/\/assets.adobe.com\//i';
  return preg_match( $pattern, $url ) ? 1 : 0;
}

function hook_colorscheme_render_editlink( $data ) {
  if ($data['link_is_new'] && colorscheme_url( $data['link']['url'] )) {
    $data['link']['tags'] = 'colorscheme';
   }

  return $data;
}

function hook_colorscheme_render_linklist( $data ) {
    #$pattern = '/<a href="[^"]+">(#[a-f0-9]{6})</a>/i';
    $pattern = '/<a href="[^"]+">#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})<\/a>(?:\r\n|\n)?(?:<br\s*\/?>)?/msi';
    foreach ($data['links'] as &$value) {
      $value['description'] = preg_replace_callback( $pattern,
		"display_color",
		$value['description'], -1, $count );
    }

  return $data;
}

function hook_colorscheme_render_includes( $data ) {
  if ($data['_PAGE_'] == TemplatePage::LINKLIST) {
    $data['css_files'][] = PluginManager::$PLUGINS_PATH . '/colorscheme/colorscheme.css';
  }

  return $data;
}

function hook_colorscheme_render_footer($data)
{
    $data['js_files'][] = PluginManager::$PLUGINS_PATH . '/colorscheme/colorscheme.js';

    return $data;
}

/**
 * This function is never called, but contains translation calls for GNU gettext extraction.
 */
function colorscheme_dummy_translation()
{
    // meta
    t('Displays a color in #xxyyzz format as an inline sample block.');
}
