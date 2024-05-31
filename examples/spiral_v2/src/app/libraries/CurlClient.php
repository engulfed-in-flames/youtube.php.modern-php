<?php

declare(strict_types=1);

load("interface", "CurlClientInterface");

class CurlClient extends Base implements CurlClientInterface
{
  private string $api_key;
  private CurlHandle|false $curl;

  public function __construct(string $api_key)
  {
    $this->api_key = $api_key;
  }

  /**
   * curlでGETリクエストを送信する
   * 
   * @param string $url 
   * @param string $query クエリパラメータの文字例
   * @return array
   */
  public function get($url, $query = "")
  {
    $url = trim($url, "/") . ($query ? "?{$query}" : "");
    return $this->request($url);
  }

  /**
   * curlでPOSTリクエストを送信する
   * 
   * @param string $url
   * @param array $body
   * @return mixed
   */
  public function post($url, $body = [])
  {
    return $this->request($url, "POST", $body);
  }

  /**
   * curlでPATCHリクエストを送信する
   * 
   * @param string $url 
   * @param array $body
   * @return mixed
   */
  public function patch($url, $body = [])
  {
    return $this->request($url, "PATCH", $body);
  }

  /**
   * curlでDELETEリクエストを送信する
   * 
   * @param string $url 
   * @return mixed
   */
  public function delete($url, $body = [])
  {
    return $this->request($url, "DELETE", $body);
  }

  /**
   * curlインスタンスを初期化する。
   * 
   * @param string $url
   * @param string $request_method
   * @param array $body
   */
  private function init($url, $request_method, $body = [])
  {
    $this->curl = curl_init();

    $header = $this->buildHeader();
    $options = [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_URL => $url,
      CURLOPT_HTTPHEADER => $header,
      CURLOPT_CUSTOMREQUEST => $request_method,
      CURLOPT_POSTFIELDS => empty($body) ? null : json_encode($body),
    ];


    curl_setopt_array($this->curl, $options);
  }

  /**
   * curlでリクエストを送信する
   * 
   * @param string $url 
   * @param string $method HTTPリクエストメソッド
   * @param array $body
   * @return array
   */
  private function request($url, $method = "GET", $body = [])
  {
    try {
      $this->init($url, strtoupper($method), $body);
      $response = $this->execute();

      return json_decode($response);
    } catch (Exception $_) {
      return [];
    }
  }

  /**
   * curlを実行する。その後、実行結果（リスポンス）をJSON形式の文字列から連想配列に変換してリターンする。
   * 
   * @return mixed
   */
  private function execute()
  {
    $response = curl_exec($this->curl);

    if (curl_errno($this->curl)) {
      $this->handleCurlError();
    }

    return $response;
  }

  /**
   * curl実行に失敗した時のエラーを処理する。
   * 
   * @throws Exception
   */
  private function handleCurlError()
  {
    throw new Exception("cURL Error: " . curl_error($this->curl));
  }

  private function buildHeader(): array
  {
    return [
      "Authorization: Bearer " . $this->api_key,
      "Content-Type: application/json",
    ];
  }

  public function __destruct()
  {
    curl_close($this->curl);
  }
}
