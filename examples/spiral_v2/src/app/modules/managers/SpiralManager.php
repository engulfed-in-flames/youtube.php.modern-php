<?php

declare(strict_types=1);

load("interface", "SpiralManagerInterface");

/**
 * Spiral APIを操作するためのクラス
 * 
 * @implements SpiralManagerInterface
 * 
 * @link https://support.spiral-platform.com/function/function-site-manage/6898.html
 * @link https://support.spiral-platform.com/function/function-site-manage/block/7144.html
 */
class SpiralManager implements SpiralManagerInterface
{
  const FORM_REGISTRATION = 1;
  const FORM_UPDATE = 2;
  const FORM_DELETE = 3;
  const FORM_LOGIN = 4;
  const FORM_PASSWORD_RESET = 5;
  const FORM_COLLATION = 6;


  /**
   * 複数のクエリパラメータを取得する
   * 
   * @param array $keys [$key1 => $is_array1, $key2 => $is_array2] 形式の連想配列
   * @return array [$key1 => $value1, $key2 => $value2] 形式の連想配列
   */
  public static function get_query_params(array $keys): array
  {
    global $SPIRAL;

    $params = [];

    foreach ($keys as $key => $is_array) {
      if ($is_array) {
        $params[$key] = $SPIRAL->getQueryParams($key);
      } else {
        $params[$key] = $SPIRAL->getQueryParam($key);
      }
    }

    return $params;
  }

  /**
   * 複数のPOSTパラメータを取得する
   * 
   * @param array $keys [$key1 => $is_array1, $key2 => $is_array2] 形式の連想配列
   * @return array [$key1 => $value1, $key2 => $value2] 形式の連想配列
   */
  public static function get_post_params(array $keys): array
  {
    global $SPIRAL;

    $params = [];

    foreach ($keys as $key => $is_array) {
      if ($is_array) {
        $params[$key] = $SPIRAL->getPostParams($key);
      } else {
        $params[$key] = $SPIRAL->getPostParam($key);
      }
    }

    return $params;
  }

  /**
   * 複数の環境変数を取得する
   * 
   * @param array $keys [$key1, $key2] 形式の配列
   * @return array [$key1 => $value1, $key2 => $value2] 形式の連想配列
   */
  public static function get_envs(array $keys): array
  {
    global $SPIRAL;

    $values = [];

    foreach ($keys as $key) {
      $clean_key = strtoupper($key);
      $values[] = $SPIRAL->getEnvValue($clean_key);
    }

    return $values;
  }

  /**
   * 
   */
  public static function set_th_values(string $key, array $value): void
  {
    global $SPIRAL;

    $SPIRAL->setTHValues($key, $value);
  }

  /**
   * 指定したフィールドIDを利用して、認証レコードから値を取得する。
   * 
   * @param string $field_id "_id", "1", "2", "3", ...
   */
  public static function get_value_by_field_id_from_auth_record(string $field_id): mixed
  {
    global $SPIRAL;

    return $SPIRAL->getAuthRecordByFieldId($field_id);
  }

  /**
   * 登録・更新フォームの完了ステップにて、登録・更新したレコードを取得する。
   * 
   * @param $form フォーム
   * @return array レコード
   */
  public static function get_record_on_completion_step(mixed $form): array
  {
    global $SPIRAL;

    if (!method_exists($form, "isCompletedStep")) {
      throw new LogicException("NOT currently on registration or update form");
    }

    if (!$form->isCompletedStep()) {
      throw new LogicException("NOT currently on a completion step");
    }

    return $SPIRAL->getRecordValue();
  }

  /**
   * フォームを取得する。
   * 
   * 各フォーム専用のメソッドは以下のリンクを参照してください。
   * 
   * @param string $form_name フォームの識別名
   * @param int $form_type フォームの種類
   * @return mixed フォーム
   * @link https://support.spiral-platform.com/function/function-site-manage/block/7144.html
   */
  public static function get_form(string $form_name, int $form_type): mixed
  {
    global $SPIRAL;

    return match ($form_type) {
      self::FORM_REGISTRATION => $SPIRAL->getRegistrationForm($form_name),
      self::FORM_UPDATE => $SPIRAL->getUpdateForm($form_name),
      self::FORM_DELETE => $SPIRAL->getDeleteForm($form_name),
      self::FORM_LOGIN => $SPIRAL->getLoginForm($form_name),
      self::FORM_PASSWORD_RESET => $SPIRAL->getPasswordReRegistrationForm($form_name),
      self::FORM_COLLATION => $SPIRAL->getCollationForm($form_name),
      default => throw new LogicException("Invalid form type"),
    };
  }
}
