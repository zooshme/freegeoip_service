<?php

require_once(TOOLKIT . '/class.datasource.php');
require_once(EXTENSIONS . '/freegeoip_service/lib/class.freegeoip_service.php');

Class datasourcefreegeoip extends Datasource {

    /**
     * Root now uses dashes instead of underscores
     * @since 0.3
     */
    public $dsParamROOTELEMENT = 'user-geo-info';

    public function about(){
        return array(
            'name' => 'FreeGeoIp Service',
            'version' => '1.0.0',
            'release-date' => '2017-02-19',
            'author' => array(
                'name' => 'Dom Sammut',
                'website' => 'https://www.domsammut.com/'
            )
        );
    }

    public function execute(array &$param_pool = null){



        $data = freegeoip_service_request::ip_lookup($_SERVER['REMOTE_ADDR']);

        if (is_null($data)) {
            $result = new XMLElement($this->dsParamROOTELEMENT);
            $result->appendChild(new XMLElement('error', 'Location cannot be found.'));
            $result->appendChild(new XMLElement('ip_information', $_SERVER['REMOTE_ADDR']));
        } else {
            $result = new XMLElement($this->dsParamROOTELEMENT, $data);
        }

        return $result;


    }

}
