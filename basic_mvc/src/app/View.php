<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
  public function __construct(
    protected string $view,
    protected array $params = []
  ) {
  }


  public static function make(string $view, array $params = []): self
  {
    return new static($view, $params);
  }

  public function render(bool $withLayout = false): string // Strictly handling return value type
  {
    $viewPath = VIEW_PATH . DIRECTORY_SEPARATOR . $this->view . ".php";

    if (!file_exists($viewPath)) {
      throw new ViewNotFoundException();
    }

    // Caution❗: Should be careful when extracting variables (2.27)
    // extract($this->params);

    // NOTE: Why using ob_start()?
    ob_start();

    include VIEW_PATH . DIRECTORY_SEPARATOR . $this->view . ".php";


    return (string) ob_get_clean();
  }

  public function __toString(): string
  {
    return $this->render();
  }
}
