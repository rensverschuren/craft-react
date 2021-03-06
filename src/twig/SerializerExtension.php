<?php

namespace react\twig;
use Craft;

class SerializerExtension extends \Twig_Extension
{
    private $serializer;

    public function getFunctions()
    {
        return array(
            new \Twig_Function('serialize', array($this, 'serialize')),
        );
    }

    public function serialize($data, $schema = 'entry', $group = 'default') {
        $dir = Craft::getAlias('@config/react');
        $path = $dir . "/$schema.php";
        $config = include_once($path);

        $f = $config[$group];
        $result = $f($data);

        return $result;
    }
}