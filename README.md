# 监控页面

## 说明
> 监控 stock.bwg.net变化，发送邮件通知

## 使用

1. 执行composer install
2. 修改变量 config 为你的发送邮件信息
3. 添加脚本到crontab中，例:
> */5 * * * * /usr/local/php/bin/php  /data/web/bwg/run.php >/dev/null &