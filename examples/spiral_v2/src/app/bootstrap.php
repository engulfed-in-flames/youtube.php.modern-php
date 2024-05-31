<?php

require __DIR__ . "/helper.php";

load("abstract", "Base");
load("manager", "SpiralManager");
load("manager", "ConfigManager");
load("manager", "SessionManager");
load("module", "Database");
load("module", "Auth");

SessionManager::start();

[$env] = SpiralManager::get_envs(["ENV"]);
$config = get_config($env);

ConfigManager::load($config);
