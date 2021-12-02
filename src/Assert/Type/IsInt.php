<?php

namespace mtf\Assert\Type;

/**
 * 数字整形
 * @author dongasai
 *
 */
class IsInt extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是`数字整型`。结果: %s';

    /**
     * 断言
     *
     * @param mixed $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::integer($value, $this->getMessage($message));

        return true;
    }

}