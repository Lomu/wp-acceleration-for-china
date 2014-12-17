<?php
/*
  Plugin Name: WP Acceleration for China
  Plugin URI: http://lomu.me/post/wp-acceleration-for-china
  Description: 替换Google CDN文件、Gravatar头像链接，加快WordPress打开速度，为WordPress中国用户提供加速
  Author: Lomu
  Author URI: http://lomu.me/
  Version: 1.0.0
*/

// 匹配出css、js、图片地址
function izt_replace_url($str){
    $regexp = "/<(link|script|img)([^<>]+)>/i";
    $str = preg_replace_callback( $regexp, "izt_replace_callback", $str );
    return $str;
}

// 匹配需要替换掉的链接地址
function izt_replace_callback($matches) {
  $str = $matches[0];

  $patterns = array();
  $replacements = array();

  // 匹配谷歌CDN链接
  $patterns[0] = '/\.googleapis\.com/';

  // 匹配头像链接
  $patterns[1] = '/http:\/\/[0-9]\.gravatar\.com\//';
  $patterns[2] = '/http%3A%2F%2F[0-9]\.gravatar\.com%2F/';

  // 使用中科大CDN地址
  $replacements[0] = '.lug.ustc.edu.cn';

  // 目前使用https可以访问到头像图片
  $replacements[1] = 'https://secure.gravatar.com/';
  $replacements[2] = 'https%3A%2F%2Fsecure.gravatar.com%2F';

  return preg_replace($patterns, $replacements, $str);
}

function izt_buffer_start() {
   //开启缓冲
  ob_start("izt_replace_url");
}

function izt_buffer_end() {
  // 关闭缓冲
  ob_end_flush();
}

/**
 * 分别将开启和关闭缓冲添加到wp_loaded和shutdown动作
 * 也可以尝试添加到其他动作，只要内容输出在两个动作之间即可
 * 参考链接：http://codex.wordpress.org/Plugin_API/Action_Reference
 */
add_action('wp_loaded', 'izt_buffer_start');
add_action('shutdown', 'izt_buffer_end');

?>