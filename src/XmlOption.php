<?php

namespace mtf;

/**
 * xml配置信息应用
 */
class XmlOption
{

    public $config;
    private $oldConfig;

    static $optionList = array(
        'debug',
        'dir',
        'testsuites',
        'bootstrap',
    );

    public function __construct($config)
    {
        $this->config = $config;
        $this->oldConfig = $config;
    }


    /**
     * 应用配置信息
     *
     * @param array $value
     * @return array
     */
    public function applyOption(array $value)
    {
        $this->call();
        foreach ($this->config as $name => $cc) {

            if (in_array($name, self::$optionList)) {
                $value[$name] = $cc;
            }
        }


        return $value;
    }

    public function call()
    {
        $testsuites = [];

        if ($this->config['testsuites']) {
            foreach ($this->config['testsuites']['testsuite'] as $testsuite) {
                if ($testsuite instanceof \SimpleXMLElement) {
                    $testsuites[] = $this->attributeXml($testsuite);
                } else {
                    $testsuites = $this->config['testsuites']['testsuite'];
                    break;
                }
            }
        }
        $this->config['testsuites']= $testsuites;
    }

    /**
     * @param \SimpleXMLElement $testsuite
     */
    private function attributeXml(\SimpleXMLElement $testsuite): array
    {

        $data         = get_object_vars($testsuite);
        $data['name'] = $data['@attributes']['name'];
        unset($data['@attributes']);
        if(is_string($data['file'])){
            $data['file'] = [$data['file']];
        }
        return $data;
    }


}