<?php

class Pagination
{
  const DEFAULT_PER_PAGE = 10;
  const DEFAULT_MAX_NAVS = 5;

  private int $count;
  private int $current_page;
  private int $per_page;
  private int $max_navs;

  public function __construct(
    int $count,
    int $current_page,
    int $per_page = self::DEFAULT_PER_PAGE,
    int $max_navs = self::DEFAULT_MAX_NAVS
  ) {
    $this->current_page = max(1, $current_page);
    $this->count = $count;
    $this->per_page = $per_page;
    $this->max_navs = $max_navs;
  }

  public function generate(): array
  {
    $count  = $this->count;
    $current_page = $this->current_page;
    $per_page = $this->per_page;
    $max_navs = $this->max_navs;
    $max_navs_half = floor($max_navs / 2);

    $navs = [];
    $last_page = ceil($count / $per_page);

    if ($current_page > $last_page) {
      return $navs;
    }

    if ($current_page < $max_navs_half + 1) {
      $quotient = ceil($count / $per_page);
      $last_page_num = $quotient < $max_navs ? $quotient : $max_navs;

      $navs["pages"] = range(1, $last_page_num);
    }

    if ($current_page >= $max_navs_half + 1) {
      $prev_page_nums = range($current_page - $max_navs_half, $current_page - 1);

      $diff = $count - ($current_page * $per_page);
      $quotient = ceil($diff / $per_page);

      if ($quotient > 0) {
        $last_page_num = $quotient < 3 ? $quotient : 2;
        $next_page_nums = range(1, $last_page_num);
        $next_page_nums = array_map(fn ($n) => $current_page + $n, $next_page_nums);

        $navs["pages"] = [
          ...$prev_page_nums,
          $current_page,
          ...$next_page_nums
        ];
      }

      if ($quotient <= 0) {
        $navs["pages"] = [
          ...$prev_page_nums,
          $current_page,
        ];
      }
    }

    if ($current_page > 1) {
      $navs["first_page"] = 1;
      $navs["prev_page"] = $current_page - 1;
    }

    if ($current_page < $last_page) {
      $navs["next_page"] = $current_page + 1;
      $navs["last_page"] = $last_page;
    }

    return $navs;
  }

  public function set_per_page(int $per_page): void
  {
    if ($per_page < 1) {
      throw new InvalidArgumentException("'\$per_page' must be greater than 0.");
    }

    $this->per_page = $per_page;
  }

  public function set_max_navs(int $max_navs): void
  {
    if ($max_navs < 1) {
      throw new InvalidArgumentException("'\$max_navs' must be greater than 0.");
    }

    $this->max_navs = $max_navs;
  }

  public function set_query_param(string $query_param): void
  {
    $this->query_param = $query_param;
  }

  public function __get($key): void
  {
    throw new BadFunctionCallException("Getter is NOT allowed.");
  }

  public function __set($key, $value): void
  {
    throw new BadFunctionCallException("Setter is NOT allowed.");
  }
}


$limit = 10;
$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
$page = max(1, $page);
$count = 239;

$pagination = new Pagination($count, $page);
$navs = $pagination->generate();

echo "<pre>";
print_r($navs);
echo "</pre>";
