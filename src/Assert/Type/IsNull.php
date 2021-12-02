<?php

namespace mtf\Assert\Type;

use mtf\Framework\Constraint;

class IsNull extends Constraint
{

    /**
     * 执行断言
     * @param mixed $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        $this->callMatches($value,$message);
        return true;
    }

    /**
     * 断言逻辑
     * @param $value
     * @return bool
     */
    protected function matches($value): bool
    {
        return is_null($value);
    }

}