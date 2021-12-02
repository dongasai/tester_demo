<?php

namespace mtf\Framework;

use mtf\Framework\Result\AssertionFailedError;
use mtf\Util\Helper;
use mtf\Util\InvalidArgumentHelper;
use mtf\Util\Type;

/**
 * Class Constraint InterfaceConstraint
 * 约束类,断言类应继承此类
 * @package mtf\Framework
 */
abstract class Constraint implements SelfDescribing, \Countable, InterfaceConstraint
{

    /**
     * @var string 默认消息
     */
    protected $defaultMessage = '';

    /**
     * 约束值
     * @var null
     */
    protected $expected = null;

    /**
     *
     * @var string 消息
     */
    protected $message = '';

    /**
     * 构造函数
     * @param null $expected
     */
    public function __construct($expected = null)
    {
        $this->expected = $expected;
    }

    /**
     * 调用断言逻辑
     * @param $value
     * @param string $message
     */
    protected function callMatches($value, $message = '')
    {
        $message = $this->getMessage($message);

        if (!$this->matches($value)) {
            $msg = sprintf(
                $message,
                Helper::valueToString($this->expected),
                Helper::valueToString($value)
            );

            InvalidArgumentHelper::reportInvalidArgument($msg);
        }
    }

    /**
     * 断言逻辑
     * @param $value
     * @return bool
     */
    protected function matches($value):bool
    {
        return true;
    }

    /**
     * 
     * @param string|null $message
     * @return string
     */
    public function getMessage($message = null)
    {
        if (empty($message)) {
            return $this->defaultMessage;
        }
        return $message;
    }

    /**
     * 运行断言
     * @param $value
     * @param $message
     */
    public function evaluate($value, string $message = null)
    {
        try {
             $this->
             assertions($value, $message);
        } catch (\InvalidArgumentException $InvalidArgumentException) {

            dump($InvalidArgumentException);
        } catch (\Exception $Exception) {
           
            
        }
        
       
    }

    /**
     * 约束条件的数量
     * 两个约束条件的比如:范围断言，非空字符串断言
     * @return int
     */
    public function count(): int
    {
        return 1;
    }

    public function toString(): string
    {
        return $this->message;
    }

}
