<?php

$keys = [
  "API_BASE_URL",
  "API_KEY",
  "APP_NAME",
  "APP_ID",
  "SITE_ID",
  "USER_AREA_ID",
  "ADMIN_AREA_ID",
];

[
  $api_base_url,
  $api_key,
  $app_name,
  $app_id,
  $site_id,
  $user_area_id,
  $admin_area_id,
] = SpiralManager::get_envs($keys);

return [
  "common" => [
    "api_base_url" => $api_base_url,
    "api_key" => $api_key,
    "app_name" => $app_name,
    "app_id" => $app_id,
    "site_id" => $site_id,
    "user_area_id" => $user_area_id,
    "admin_area_id" => $admin_area_id,
  ],
  "db" => [
    "user" => "00000",
    "admin" => "00000",
    "application" => "00000",
    "application_history" => "00000",
  ],
  "page" => [
    "site_top" => "p000000",
    "user" => [
      "login" => "p000000",
      "detail" => "p000000",
    ],
    "admin" => [
      "login" => "p000000",
      "detail" => "p000000",
    ]
  ],
  "path" => [
    "asset" => [
      "img" => "/app/assets/img/",
      "css" => "/app/assets/css/",
      "js" => "/app/assets/js/",
    ]
  ]
];
