# Dashboard Mutu

1. copy `system-configuration-example.ini` into `system-configuration.ini`
2. fill the data in `system-configuration.ini`.
3. run `php init` choose `production`
4. run composer install.
5. create database
6. change database name in `common/config/main-local.php`
7. run `php yii migrate --migrationPath=@yii/rbac/migrations`
8. run `php yii migrate`.
