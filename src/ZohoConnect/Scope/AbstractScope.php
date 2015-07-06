<?php

namespace ZohoConnect\Scope;

use ZohoConnect\Exceptions\ZohoException;
use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Http\Response;

abstract class AbstractScope
{
    /* content type */

    const XML = 'xml';
    const JSON = 'json';

    /* verbs constants */
    const POST = 'POST';
    const GET = 'GET';
    const DELETE = 'DELETE';
    const PUT = 'PUT';

    protected $headers = array();
    protected $contentType;
    protected $authToken;

    public function getContentType()
    {
        return $this->contentType;
    }

    public function setContentType($contentType)
    {
        if ($contentType !== self::JSON && $contentType !== self::XML) {
            throw new ZohoException("The contentType is wrong, expected  xml or json. ");
        }
        $this->contentType = $contentType;
        return $this;
    }

    public function getAuthToken()
    {
        return $this->authToken;
    }

    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     *
     * @param string $type
     * @param string $url
     * @param string[] $params
     * @return Response
     * @throws ZohoException
     */
    protected function apiRequest($type, $url, $params = array())
    {
        if (!$this->getContentType()) {
            throw new ZohoException("It was informed the contentType, see " . __CLASS__ . "::setContentType. ");
        }
        $strParams = http_build_query($params);
        $request = new Request();

        switch ($type) {
            case self::GET:
                $request->setUri($url . '?' . $strParams);
                $request->setMethod(Request::METHOD_GET);
                break;
            case self::POST:
                $request->setMethod(Request::METHOD_POST);
                $request->setUri($url);
                $request->setPost($params);
                break;
            case self::DELETE:
                $request->setMethod(Request::METHOD_DELETE);
                $request->setUri($url . '?' . $strParams);
                break;
            case self::PUT:
                $request->setMethod(Request::METHOD_PUT);
                $request->setUri($url);
                $request->setPost($params);
                break;
        }

        $client = new Client();
        $client->dispatch($request);
        return $client->getResponse();
    }
}
