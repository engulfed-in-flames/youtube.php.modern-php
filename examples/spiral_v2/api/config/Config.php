<?php

class Config
{
  private static array $config = [
    "api" => [
      "api_base_url" => "",
      "api_key" => "",
    ],
    "uri" => [
      "/" => [],
      "/user" => ["login", "detail"],
    ],
    "db" => [
      "user" => "59744",
      "like" => "59643",
      "item" => "67532",
    ]
  ];

  public static function defineConstants(array $options): void
  {
  }
}
