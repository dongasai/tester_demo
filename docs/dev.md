# 开发相关

# 使用Docker进行开发

```bash

cd testerdemo
sudo docker-compose up -d 
sudo docker exec -it testerdemo_php_1 bash 

```


# 开发进度
* [x] 读取xml配置文件
* [ ] 英文输出器（默认为中文输出器）
* [ ] Suites测试用例集合功能
* [ ] UnitTest转换
* [ ] 插件系统

# 开发常用命令

## xml读取开发
```bash

#xml读取开发
composer xml 

```

## Suites 功能
```bash

#Suites 读取开发
composer suites 

```

# commit 
> 格式
```
<type>(<scope>): <subject>
```
commitizen
npm install -g commitizen cz-conventional-changelog
## Type
* feat 新功能:     新功能
* fix  修正:      BUG修正
* docs 文档:     仅文档修改
* style 格式:    不影响代码含义的更改（空白、格式、缺少分号等）
* refactor 更改: 既不修复bug也不添加功能的代码更改
* perf 性能:    提高性能的代码更改
* test 测试:     添加缺失的测试或更正现有测试
* build 构建:    影响生成系统或外部依赖项的更改（示例范围：composer、Docker、Docker compose）
* ci:       对CI配置文件和脚本的更改（示例范围：Travis、Circle、BrowserStack、SauceLabs）
* chore 其他:    不修改src或测试文件的其他更改
* revert 恢复:   恢复以前的提交

