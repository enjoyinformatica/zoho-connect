<?php

namespace ZohoConnect\Scope;

use Zend\Http\Response;

class ZohoSupport extends AbstractScope
{

    protected $uriApiBase;
    protected $modulesAvailable = array(
        'requests', 'solutions',
        'accounts', 'contacts', 'contracts',
        'products', 'tasks'
    );

    public function __construct($authToken, $contentType = self::JSON)
    {
        $this->uriApiBase = "https://support.zoho.com/api/";
        $this->setContentType($contentType);
        $this->setAuthToken($authToken);
    }

    /**
     * @param array $required
     * @param array $params
     * @return boolean
     */
    protected function isValid($required, $params)
    {
        if (count($params) === 0) {
            return false;
        }
        $valid = true;
        foreach ($required as $value) {
            if (!array_key_exists($value, $params)) {
                $valid = false;
            }
        }
        return $valid;
    }

    /**
     *
     * @param string $module
     * @param array $params
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function getRecords($module, $params = array())
    {
        if (!in_array($module, $this->modulesAvailable)) {
            throw new \InvalidArgumentException("Invalid module. Available: " . implode(", ", $this->modulesAvailable));
        }
        $requiredParams = array('portal', 'department');
        $paramsAvailable = array('selectfields', 'fromindex', 'toindex', 'myrecords');
        if (!$this->isValid($requiredParams, $params)) {
            throw new \InvalidArgumentException("Parameters required: " . implode(", ", $requiredParams));
        }
        $nParams = array(
            'portal' => $params['portal'],
            'department' => $params['department'],
            'authtoken' => $this->getAuthToken()
        );
        foreach ($paramsAvailable as $item) {
            if (array_key_exists($item, $params)) {
                $nParams[$item] = $params[$item];
            }
        }

        $uri = $this->uriApiBase . $this->getContentType() . '/' . $module . '/getrecords';
        return $this->apiRequest(self::GET, $uri, $nParams);
    }

    /**
     * @param string $module
     * @param array $params
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function getRecordsById($module, $params = array())
    {
        if (!in_array($module, $this->modulesAvailable)) {
            throw new \InvalidArgumentException("Invalid module. Available: " . implode(", ", $this->modulesAvailable));
        }
        $requiredParams = array('portal', 'department', 'id');
        $paramsAvailable = array('selectfields');
        if (!$this->isValid($requiredParams, $params)) {
            throw new \InvalidArgumentException("Parameters required: " . implode(", ", $requiredParams));
        }
        $nParams = array(
            'portal' => $params['portal'],
            'department' => $params['department'],
            'authtoken' => $this->getAuthToken(),
            'id' => $params['id']
        );
        foreach ($paramsAvailable as $item) {
            if (array_key_exists($item, $params)) {
                $nParams[$item] = $params[$item];
            }
        }
        $uri = $this->uriApiBase . $this->getContentType() . '/' . $module . '/getrecordsbyid';
        return $this->apiRequest(self::GET, $uri, $nParams);
    }

    /**
     * @param string $module
     * @param array $params
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function searchRecords($module, $params = array())
    {
        if (!in_array($module, $this->modulesAvailable)) {
            throw new \InvalidArgumentException("Invalid module. Available: " . implode(", ", $this->modulesAvailable));
        }
        $requiredParams = array('portal', 'department', 'searchvalue', 'searchfield');
        $paramsAvailable = array('selectfields', 'fromindex', 'toindex', 'noOfDays');
        if (!$this->isValid($requiredParams, $params)) {
            throw new \InvalidArgumentException("Parameters required: " . implode(", ", $requiredParams));
        }
        $nParams = array(
            'portal' => $params['portal'],
            'department' => $params['department'],
            'authtoken' => $this->getAuthToken(),
            'searchvalue' => $params['searchvalue'],
            'searchfield' => $params['searchfield']
        );
        foreach ($paramsAvailable as $item) {
            if (array_key_exists($item, $params)) {
                $nParams[$item] = $params[$item];
            }
        }
        $uri = $this->uriApiBase . $this->getContentType() . '/' . $module . '/getrecordsbysearch';
        return $this->apiRequest(self::GET, $uri, $nParams);
    }

    /**
     * @param string $module
     * @param array $params
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function addRecords($module, $params = array())
    {
        if (!in_array($module, $this->modulesAvailable)) {
            throw new \InvalidArgumentException("Invalid module. Available: " . implode(", ", $this->modulesAvailable));
        }
        $requiredParams = array('portal', 'department', 'xml');
        if (!$this->isValid($requiredParams, $params)) {
            throw new \InvalidArgumentException("Parameters required: " . implode(", ", $requiredParams));
        }
        $nParams = array(
            'portal' => $params['portal'],
            'department' => $params['department'],
            'authtoken' => $this->getAuthToken(),
            'xml' => $params['xml']
        );
        $content = $this->getContentType();
        $uri = $this->uriApiBase . 'xml/' . $module . '/addrecords';
        $response = $this->apiRequest(self::GET, $uri, $nParams);
        $this->setContentType($content);
        return $response;
    }

    /**
     * @param string $module
     * @param array $params
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function updateRecords($module, $params = array())
    {
        if (!in_array($module, $this->modulesAvailable)) {
            throw new \InvalidArgumentException("Invalid module. Available: " . implode(", ", $this->modulesAvailable));
        }
        $requiredParams = array('portal', 'department', 'xml', 'id');
        if (!$this->isValid($requiredParams, $params)) {
            throw new \InvalidArgumentException("Parameters required: " . implode(", ", $requiredParams));
        }
        $nParams = array(
            'portal' => $params['portal'],
            'department' => $params['department'],
            'authtoken' => $this->getAuthToken(),
            'xml' => $params['xml'],
            'id' => $params['id']
        );
        $uri = $this->uriApiBase . $this->getContentType() . '/' . $module . '/updaterecords';
        return $this->apiRequest(self::GET, $uri, $nParams);
    }

    /**
     * @param string $module
     * @param array $params
     * @return Response
     * @throws \InvalidArgumentException
     */
    public function deleteRecords($module, $params = array())
    {
        if (!in_array($module, $this->modulesAvailable)) {
            throw new \InvalidArgumentException("Invalid module. Available: " . implode(", ", $this->modulesAvailable));
        }
        $requiredParams = array('portal', 'department', 'id');
        if (!$this->isValid($requiredParams, $params)) {
            throw new \InvalidArgumentException("Parameters required: " . implode(", ", $requiredParams));
        }
        $nParams = array(
            'portal' => $params['portal'],
            'department' => $params['department'],
            'authtoken' => $this->getAuthToken(),
            'id' => $params['id']
        );
        $uri = $this->uriApiBase . $this->getContentType() . '/' . $module . '/deleterecords';
        return $this->apiRequest(self::GET, $uri, $nParams);
    }
}
