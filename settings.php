<?php

OCP\User::checkAdminUser();

$params = array('tokenIntrospectionEndpoint');

if($_POST) {
    foreach($params as $param) {
        if (isset($_POST[$param])) {
            OCP\Config::setAppValue('user_oauth_unity', $param, $_POST[$param]);
        }
    }
}

$tmpl = new OCP\Template('user_oauth_unity', 'settings');


$tmpl->assign('tokenIntrospectionEndpoint', OCP\Config::getAppValue('user_oauth_unity', 'tokenIntrospectionEndpoint', 'https://example.org/oauth2' ));

return $tmpl->fetchPage();

