<?php

namespace mtf\Assert\Type;

use mtf\Util\InvalidArgumentHelper;
use mtf\Util\Type;
use Webmozart\Assert\Assert;

/**
 * Description of IsNotA
 *
 * @author dongasai
 */
class IsNAN extends \mtf\Framework\Constraint
{

    /**
     * @var string 默认消息
     */
    protected $defaultMessage = '期望是一个不合法的数值,结果: %s';

    /**
     * 执行断言
     * @param mixed $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        $this->callMatches($value, $message);

        return true;
    }


    /**
     * 断言逻辑
     *
     * @param $other
     * @return bool
     */
    protected function matches($other):bool
    {
        return \is_nan($other);
    }

}
