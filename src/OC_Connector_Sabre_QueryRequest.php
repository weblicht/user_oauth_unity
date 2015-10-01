<?php

/**
 * Created by IntelliJ IDEA.
 * User: wqiu
 * Date: 01/10/15
 * Time: 17:51
 */
class OC_Connector_Sabre_QueryRequest extends \Sabre\HTTP\Request
{
    public function getUri() {
        $uri = OC_Request::requestUri();
        return strtok($uri,'?');
    }

    public function getRawServerValue($field) {
        if($field == 'REQUEST_URI') {
            return $this->getUri();
        }
        else{
            return isset($this->_SERVER[$field])?$this->_SERVER[$field]:null;
        }
    }
}