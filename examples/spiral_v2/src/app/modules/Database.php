<?php

declare(strict_types=1);

load("library", "CurlClient");

class Database extends Base
{
  /** @var array ["api_base_url" => "", "api_key" => "", "db_id" => "", ...] */
  private array $config;
  private CurlClient $conn;

  public function __construct(array $config)
  {
    $this->config = $config;
    $this->conn = new CurlClient($config["api_key"]);
  }

  public function buildQuery(array $params): string
  {
    return http_build_query($params);
  }

  public function set_db_id(string $db_id): void
  {
    $this->config["db_id"] = $db_id;
  }
}
