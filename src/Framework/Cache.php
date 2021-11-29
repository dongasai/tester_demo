<?php

namespace mtf\Framework;

class Cache
{

    const KEY_RUN_TIME     = 'run_time';

    const KEY_ASSERT_COUNT = 'assert_count';

    /**
     * 获取缓存
     *
     * @param string $key
     * @return bool|mixed|null
     */
    static public function get(string $key)
    {
        $cache = new \Jenner\SimpleFork\Cache\SharedMemory();

        return $cache->get(RUN_UN . $key);
    }

    /**
     * 增长
     *
     * @param string $key
     * @param int $number
     * @return bool
     */
    static public function inc(string $key, $number = 1)
    {
        $cache = new \Jenner\SimpleFork\Cache\SharedMemory();

        return $cache->set(RUN_UN . $key, $cache->get(RUN_UN.$key) + $number);
    }

    /**
     * 减少
     *
     * @param string $key
     * @param int $number
     * @return bool
     */
    static public function dec(string $key, $number = 1)
    {
        $cache = new \Jenner\SimpleFork\Cache\SharedMemory();

        return $cache->set(RUN_UN . $key, $cache->get(RUN_UN.$key) - $number);
    }

    /**
     * 删除指定缓存
     * @param $key
     */
    public static function delete($key)
    {
        $cache = new \Jenner\SimpleFork\Cache\SharedMemory();
        $cache->delete(RUN_UN . $key);
    }



    static public function incRuntime($time)
    {
        return self::inc(self::KEY_RUN_TIME, (int)($time * 1000));
    }

    static public function getRunTime()
    {
        return self::get(self::KEY_RUN_TIME) / 1000;
    }

    static public function incAssertCount($time)
    {
        return self::inc(self::KEY_ASSERT_COUNT, $time);
    }

    static public function getAssertCount()
    {
        return self::get(self::KEY_ASSERT_COUNT);
    }

    static public function reset()
    {
        self::delete(self::KEY_RUN_TIME);
        self::delete(self::KEY_ASSERT_COUNT);
    }






}