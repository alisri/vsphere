<?php
    namespace vsphere;
    use \GuzzleHttp\Client;
    class vmware{
        const GET = "GET";
        const POST="POST";
        private $connection;


        public function __construct($host, $username, $password, $verifyCE)
        {

            $this->connection=connection::getInstance(new Client(),$host,$username,$password,$verifyCE);
            $this->connection->getSession();

        }


        public function getAllOfVm(array $content=null){

            $vms=$this->connection->makeRequest(self::GET,"vcenter/src",false,$content);


            return new manageVmObjects(json_decode($vms->getBody()),$this->connection);


        }
        public function getVmByVm($VM,array $content=null){

            $object=$this->connection->makeRequest(self::GET,"vcenter/src/$VM",false,$content);

            return vm::makeVmInstance($this->connection,json_decode($object->getBody()),$VM);

        }





    }
