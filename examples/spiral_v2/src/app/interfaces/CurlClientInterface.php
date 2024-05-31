<?php

interface CurlClientInterface
{
  public function get($path, $query = "");
  public function post($path, $body = []);
  public function patch($path, $body = []);
  public function delete($path, $body = []);
}
