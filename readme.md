###Task Cron###
- ubuntu cron -e
- * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1

