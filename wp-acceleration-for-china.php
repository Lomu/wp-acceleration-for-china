<?php
/*
  Plugin Name: WP Acceleration for China
  Plugin URI: http://lomu.me/post/wp-acceleration-for-china
  Description: 替换Gravatar头像链接，加快WordPress打开速度，为WordPress中国用户提供加速
  Author: Lomu
  Author URI: http://lomu.me/
  Version: 1.2.0
*/

// 匹配出css、js、图片地址
function izt_replace_url($str){
    $regexp = "/<(link|script|img)([^<>]+)>/i";
    $str = preg_replace_callback( $regexp, "izt_replace_callback", $str );
    return $str;
}

// 匹配需要替换掉的链接地址
function izt_replace_callback($matches) {
  $google = get_option("wafc_google");
  $gravatar = get_option("wafc_gravatar");
  $google = !$google?1:$google;
  $gravatar = !$gravatar?1:$gravatar;

  $google_array = array('.lug.ustc.edu.cn', '.useso.com');
  $gravatar_array = array('https://secure.gravatar.com/avatar', 'http://cn.gravatar.com/avatar', 'http://cdn.v2ex.com/gravatar');

  $str = $matches[0];

  $patterns = array();
  $replacements = array();

  if($google>0){
    // 匹配谷歌CDN链接
    $patterns[0] = '/\.googleapis\.com/';

    // 使用CDN地址替换
    $replacements[0] = $google_array[$google-1];
  }

  if($gravatar>0){
    // 匹配头像链接
    $patterns[1] = '/http:\/\/[0-9]\.gravatar\.com\/avatar/';
    // $patterns[2] = '/http%3A%2F%2F[0-9]\.gravatar\.com%2F/';

    // 使用可以访问到头像图片替换
    $replacements[1] = $gravatar_array[$gravatar-1];
    // $replacements[2] = 'https%3A%2F%2Fsecure.gravatar.com%2F';
  }

  return preg_replace($patterns, $replacements, $str);
}

function izt_replace_start() {
   //开启缓冲
  ob_start("izt_replace_url");
}

function izt_replace_end() {
  // 关闭缓冲
  if(ob_get_level() > 0) ob_end_flush();
}

/**
 * 分别将开启和关闭缓冲添加到wp_loaded和shutdown动作
 * 也可以尝试添加到其他动作，只要内容输出在两个动作之间即可
 * 参考链接：http://codex.wordpress.org/Plugin_API/Action_Reference
 */
add_action('wp_loaded', 'izt_replace_start');
add_action('shutdown', 'izt_replace_end');


add_action('admin_menu', 'izt_wafc_menu');

function izt_wafc_menu(){
  add_submenu_page( 'options-general.php', 'WP Acceleration for China设置', 'WP加速', 'manage_options', 'izt-wafc', 'izt_wafc_fun' );
}

function izt_wafc_fun(){

  if (isset($_POST["action"]) && $_POST["action"] == "saveconfiguration") {
    update_option('wafc_google', $_POST["wafc_google"]);
    update_option('wafc_gravatar', $_POST["wafc_gravatar"]);
    echo '<div class="updated"><p><strong>设置保存成功！</strong></p></div>';
  }
  $google = get_option("wafc_google");
  $gravatar = get_option("wafc_gravatar");
  print_r(get_option("wa0fc_google"));
  ?>
  <div class="wrap">
    <form method="post">
      <input type="hidden" name="action" value="saveconfiguration">
      <h2>WP Acceleration for China 插件设置</h2>
      <table class="form-table">
        <tr>
          <th>Google CDN</th>
          <td>
            <select name="wafc_google">
              <option value="-1">不加速</option>
              <option value="1"<?=$google==1?' selected="selected"':''?>>中科大CDN</option>
              <option value="2"<?=$google==2?' selected="selected"':''?>>360 useso</option>
            </select>
          </td>
        </tr>
        <tr>
          <th>Gravatar头像</th>
          <td>
            <select name="wafc_gravatar">
              <option value="-1">不加速</option>
              <option value="1"<?=$gravatar==1?' selected="selected"':''?>>https访问</option>
              <option value="2"<?=$gravatar==2?' selected="selected"':''?>>CN子域名</option>
              <option value="3"<?=$gravatar==3?' selected="selected"':''?>>v2ex</option>
            </select>
          </td>
        </tr>
        <tr>
          <td><input type="submit" class="button button-primary" value="保存设置"></td>
          <td></td>
        </tr>
      </table>
    </form>
  </div>

<?php } ?>
