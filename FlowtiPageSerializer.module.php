<?php


namespace ProcessWire;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class FlowtiPageSerializer extends Wire implements Module
{
    public static function getModuleInfo()
    {
        return [
            'title' => 'Flowti - Page Serializer',
            'version' => 100,
            'summary' => 'Provides methods to serialize a Page',
            'autoload' => true,
        ];
    }

    public function init() {
        require_once('vendor/autoload.php');
    }

    public function ready() {
        $this->addHook('Page::serialize', $this, 'serialize');
    }

    public function serialize($event) {

        $page = $event->object;
        $fields = $event->arguments(0)? : [];

        if(gettype($fields) === 'string') {
            $fields = [$fields];
        }

        if( gettype($fields) !== 'array' ) {
            throw new \Exception('FlowtiPageSerializer only accepts fields as string or array of strings');
        }

        if(count($fields) > 0 ) {
            $dataArray = [];
            foreach($fields as $field) {
                $dataArray[$field] = $page->$field;
            }
        } else {
            $dataArray = $page;
        }

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $dataJson = $serializer->serialize($dataArray, 'json');
        $event->return = $dataJson;
    }
}
