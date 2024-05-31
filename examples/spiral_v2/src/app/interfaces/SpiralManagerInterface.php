<?php

interface SpiralManagerInterface
{
  public static function get_query_params(array $keys): array;
  public static function get_post_params(array $keys): array;
  public static function get_envs(array $keys): array;
  public static function get_value_by_field_id_from_auth_record(string $field_id): mixed;
  public static function get_form(string $form_name, int $form_type): mixed;
  public static function get_record_on_completion_step(mixed $form): array;
  public static function set_th_values(string $key, array $value): void;
}
