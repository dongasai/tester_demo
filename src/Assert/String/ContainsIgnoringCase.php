<?php

namespace mtf\Assert\String;

use Webmozart\Assert\Assert;

/**
 * Description of Contains
 * 检查字符串是否包含子字符串,不区分大小写
 *
 * @author dongasai
 */
class ContainsIgnoringCase extends \mtf\Framework\Constraint
{

    /**
     * 断言
     * @param string $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        $message = $this->getMessage($message);
        if (false === \stripos($value, $this->expected)) {
            Assert::reportInvalidArgument(\sprintf(
                                              $message ?: 'Expected a value to contain %2$s. Got: %s',
                                              Assert::valueToString($value),
                                              Assert::valueToString($this->expected)
                                          ));
        }

        return true;
    }


}
