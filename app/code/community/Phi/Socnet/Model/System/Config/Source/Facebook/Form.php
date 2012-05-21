<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Select
 *
 * @author chervox
 */
class Phi_Socnet_Model_System_Config_Source_Facebook_Form {

    public function toOptionArray($type) {
        $options = array();
        $options =
            Mage::getModel('socnet/system_config_source_facebook_form_'.
            strtolower($type))->toOptionArray();
        return $options;
    }
}
