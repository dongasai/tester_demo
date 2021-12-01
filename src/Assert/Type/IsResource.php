<?php

namespace mtf\Assert\Type;

/**
 * Description of IsResource
 * 资源类型尼姑
 * @author dongasai
 */
class IsResource extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::resource($value, $this->expected, $this->getMessage($message));
        return true;
    }

    public function count(): int
    {
        return 2;
    }

}
