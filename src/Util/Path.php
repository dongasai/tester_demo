<?php

namespace mtf\Util;

use TypeExtension\Single\Dir;
use TypeExtension\Single\File;

class Path
{

    /**
     * 获取文件的路径
     *
     * @param Dir $dir
     * @param string $filePath
     * @return File
     * @throws \Exception
     */
    static public function getRealPath(Dir $dir, $filePath): File
    {
        if (substr($filePath, 0, 1) == '/') {
            return new File(START_DIR . DIRECTORY_SEPARATOR . $filePath);
        }

        return new File($dir . DIRECTORY_SEPARATOR . $filePath);
    }

    /**
     * 获取文件夹的路径
     * @param Dir $dir
     * @param string $dirPath
     * @return Dir
     * @throws \Exception
     */
    static public function getDirRealPath(Dir $dir, $dirPath): Dir
    {
        if (substr($dirPath, 0, 1) == '/') {
            return new Dir(START_DIR . DIRECTORY_SEPARATOR . $dirPath);
        }

        return new Dir($dir->getPath() . DIRECTORY_SEPARATOR . $dirPath);
    }


}