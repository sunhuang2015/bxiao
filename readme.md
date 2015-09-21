###Task Cron###
- ubuntu crontab -e
- * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1

