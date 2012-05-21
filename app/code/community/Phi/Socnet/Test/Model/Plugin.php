<?php

class Phi_Socnet_Test_Model_Plugin extends EcomDev_PHPUnit_Test_Case {

//    public function setUp()
//    {
//        try {
//            parent::setUp();
//
//        } catch (Exception $e) {
//            var_dump($e->getTrace());
//            die;
//        }
//    }

    /**
     * Retrieves a network instance
     * @loadFixture
     * @test
     */
    public function getNetwork()
    {
        $this->model = Mage::getModel('socnet/plugin')->load('a_plugin','key');
        $n = $this->model->getNetwork();
        $this->assertInstanceOf('Phi_Socnet_Model_Network', $n);
        $this->assertEquals('a_plugin_key', $n->getKey());
    }

}
