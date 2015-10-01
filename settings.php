<?php

OCP\User::checkAdminUser();

$params = array('tokeninfoEndpoint', 'userinfoEndpoint');

if($_POST) {
    foreach($params as $param) {
        if (isset($_POST[$param])) {
            OCP\Config::setAppValue('user_oauth_unity', $param, $_POST[$param]);
        }
    }
}

$tmpl = new OCP\Template('user_oauth_unity', 'settings');


$tmpl->assign('tokeninfoEndpoint', OCP\Config::getAppValue('user_oauth_unity', 'tokeninfoEndpoint', 'https://example.org/oauth2/tokeninfo' ));
$tmpl->assign('userinfoEndpoint', OCP\Config::getAppValue('user_oauth_unity', 'userinfoEndpoint', 'https://example.org/oauth2/userinfo'));

return $tmpl->fetchPage();

