<?php

namespace mtf\Assert\Type;

/**
 * Description of Float
 * 是浮点数类型
 * @author dongasai
 */
class IsFloat extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是`浮点型`。结果: %s';

    /**
     * 断言
     * @param mixed $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::float($value, $this->getMessage($message));
        return true;
    }

}
