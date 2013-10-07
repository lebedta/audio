#!/usr/bin/env php
<?php

require_once __DIR__.'/base_script.php';

build_bootstrap();

show_run("Destroying cache dir manually", "rm -rf app/cache/*");

show_run("Creating directories for app kernel", "mkdir -p app/cache/dev app/cache/test app/logs web/uploads web/uploads/cards ");

show_run("Clear up dev cache", "php app/console -e=dev cache:warmup");
//show_run("Clear up dev cache", "php app/console -e=test cache:warmup");
//show_run("Clear up dev cache", "php app/console -e=prod cache:warmup");

show_run("assets:install", "app/console assets:install --symlink");

//show_run("Generate getters and setters for GscoreBundle", "php app/console doctrine:mongodb:generate:documents ApplicationChatBundle");

/* rebuild schema for doctrine*/
//show_run("Drop db", "php app/console doctrine:database:drop --force");
//show_run("Create db", "php app/console doctrine:database:create");
//show_run("Update schema", "php app/console doctrine:schema:update --force");
show_run("Execute a migration", "php app/console doctrine:migrations:migrate");
//show_run("Fixtures load", "php app/console doctrine:fixtures:load");

//show_run("fixtures:load", "app/console --env=dev doctrine:mongodb:fixtures:load");

show_run("Changing permissions", "chmod -R 777 app/cache app/logs web/uploads web/uploads/cards");

//show_run("Fix code style", "./php-cs-fixer.phar fix ./ --config=sf21");

exit(0);
