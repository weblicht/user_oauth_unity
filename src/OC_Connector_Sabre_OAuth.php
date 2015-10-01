<?php

require __dir__ . '/../3rdparty/autoload.php';
use GuzzleHttp\Client;
use Sabre\DAV\Auth\Backend\BackendInterface;
use weblicht\OAuth\ResourceServer\ResourceServerException;
use weblicht\OAuth\ResourceServer\UnityResourceServer;


class OC_Connector_Sabre_OAuth implements BackendInterface
{
    private $currentUser;
    private $tokeninfoEndpoint;
    private $userinfoEndpoint;

    public function __construct($tokeninfoEndpoint, $userinfoEndpoint)
    {
        $this->tokeninfoEndpoint = $tokeninfoEndpoint;
        $this->userinfoEndpoint = $userinfoEndpoint;
        $this->currentUser = null;
    }

    public function getCurrentUser()
    {
        return $this->currentUser;
    }

    public function authenticate(\Sabre\DAV\Server $server, $realm)
    {
        $config = array(
            "tokeninfoEndpoint" => $this->tokeninfoEndpoint,
            "uerinfoEndpoint" => $this->userinfoEndpoint,
            "realm" => $realm
        );

        try {
            $clientToken = new Client(['base_uri' => $this->tokeninfoEndpoint]);
            $clientUser = new Client(['base_uri' => $this->userinfoEndpoint]);
            $resourceServer = new UnityResourceServer($clientToken, $clientUser);
            $requestHeaders = apache_request_headers();

            $authorizationHeader = isset($requestHeaders['Authorization']) ? $requestHeaders['Authorization'] : null;
            $resourceServer->setAuthorizationHeader($authorizationHeader);
            //get the query parameter
            $tokenIntrospection = $resourceServer->verifyToken();
            $this->currentUser = $this->persistentId2LoginName($tokenIntrospection->getEppn());
            if(!OC_User::userExists($this->currentUser)) {
                throw new ResourceServerException("User_doesnt_exist", "User doesn't exist, please log in through shibboleth first");
            }
            OC_User::setUserid($this->currentUser);
            OC_Util::setupFS($this->currentUser);

            return true;
        } catch (ResourceServerException $e) {
            $e->setRealm("owncloud");
            header("HTTP/1.1" . $e->getStatusCode());
            if (null !== $e->getAuthenticateHeader()) {
                header("WWW-Authenticate: " . $e->getAuthenticateHeader());
            }

            $output = array(
                "error" => $e->getMessage(),
                "code" => $e->getStatusCode(),
                "error_description" => $e->getDescription()
            );
            header("Content-Type: application/json");
            echo json_encode($output);
        } catch (Exception $e) {
            header("Content-Type: application/json");
            echo json_encode($e->getMessage());
        }
    }

    private function persistentId2LoginName($persistentId) {
        return hash('sha256', $persistentId);
    }
}
