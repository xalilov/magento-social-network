<?php

class Phi_Socnet_Model_System_Config_Source_Facebook_Account_Field
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray ()
    {
        $fbFields = $this->getFields();

        $fields = array();
        foreach($fbFields as $key => $field) {
            $f = Mage::getModel( 'customer/attribute')
                ->load($key,'attribute_code');
            if($f->getAttributeId()) {
                $fields[$key] = $field;
            }
        }
        if(Mage::getModel('socnet/plugin')
                ->loadByKey('registration')
                ->getAttributeByKey('password')
                ->getData('data') === 'true') {
                $field = new stdClass();
                $field->name = "password";
                $fields['password'] = $field;
        }

        if(Mage::getModel('socnet/plugin')
                ->loadByKey('registration')
                ->getAttributeByKey('captcha')
                ->getData('data') === 'true') {
            $field = new stdClass();
                $field->name = "captcha";
                $fields['captcha'] = $field;
        }

        return $fields;
    }

    public function asJson() {
        return json_encode(array_values($this->toOptionArray()),true);
    }

    protected function getFields() {

        $field = new stdClass();
        $field->name = "name";
        $fields['name'] = $field;

        $field = new stdClass();
        $field->name = "first_name";
        $fields['firstname'] = $field;

        $field = new stdClass();
        $field->name = "last_name";
        $fields['lastname'] = $field;

        $field = new stdClass();
        $field->name = "email";
        $fields['email'] = $field;

        $field = new stdClass();
        $field->name = "gender";
        $fields['gender'] = $field;

        $field = new stdClass();
        $field->name = "location";
        $fields['location'] = $field;

        $field = new stdClass();
        $field->name = "password";
        $fields['password'] = $field;

        $field = new stdClass();
        $field->name = "birthday";
        $fields['birthday'] = $field;

        return $fields;
    }
}