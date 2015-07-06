<?php

namespace ZohoConnect\Test\Scope;

class ZohoSupportTest extends \PHPUnit_Framework_TestCase
{

    public function testGetRecords()
    {
        $support = new \ZohoConnect\Scope\ZohoSupport("meutokendeautenticacaozoho");
        $params = array(
            "portal" => "meuportal",
            'department' => "Meu Setor"
        );
        $this->assertInstanceOf("\Zend\Http\Response", $support->getRecords('requests', $params));
    }

    public function testGetRecordsById()
    {
        $support = new \ZohoConnect\Scope\ZohoSupport("meutokendeautenticacaozoho");
        $params = array(
            "portal" => "meuportal",
            'department' => "Meu Setor",
            'id' => "123456789"
        );
        try {
            $response = $support->getRecordsById('requests', $params);
        } catch (\Exception $exc) {
            echo $exc->getMessage();
            $response = null;
        }

        $this->assertInstanceOf("\Zend\Http\Response", $response);
        if (!is_null($response)) {
            $this->assertJson($response->getBody());
        }
    }

    public function testSearchRecords()
    {
        $support = new \ZohoConnect\Scope\ZohoSupport("meutokendeautenticacaozoho");
        $params = array(
            "portal" => "meuportal",
            'department' => "Meu Setor",
            'searchfield' => "Subject",
            'searchvalue' => "anystring"
        );
        try {
            $response = $support->searchRecords('requests', $params);
        } catch (\Exception $exc) {
            echo $exc->getMessage();
            $response = null;
        }

        $this->assertInstanceOf("\Zend\Http\Response", $response);
        if (!is_null($response)) {
            $this->assertJson($response->getBody());
        }
    }

    public function testDeleteRecord()
    {
        $support = new \ZohoConnect\Scope\ZohoSupport("meutokendeautenticacaozoho");
        $params = array(
            "portal" => "meuportal",
            'department' => "Meu Setor",
            'id' => "123456789"
        );
        try {
            $response = $support->deleteRecords('requests', $params);
        } catch (\Exception $exc) {
            $response = null;
        }

        $this->assertInstanceOf("\Zend\Http\Response", $response);
        if (!is_null($response)) {
            $this->assertJson($response->getBody());
        }
    }

    public function testAddRecord()
    {
        $support = new \ZohoConnect\Scope\ZohoSupport("meutokendeautenticacaozoho");
        $xml = '<requests>'
                . '<row no="1">'
                . '<fl val="Subject">Add Records Demo</fl>'
                . '<fl val="Contact Name">John</fl>'
                . '<fl val="Product Name">Customer Care</fl>'
                . '<fl val="Email">john@demo.com</fl>'
                . '<fl val="Phone">002200330044</fl>'
                . '</row>'
                . '</requests>';
        $params = array(
            "portal" => "meuportal",
            'department' => "Meu Setor",
            'xml' => $xml
        );
        try {
            $response = $support->addRecords('requests', $params);
        } catch (\Exception $exc) {
            $response = null;
        }

        $this->assertInstanceOf("\Zend\Http\Response", $response);
    }
}
