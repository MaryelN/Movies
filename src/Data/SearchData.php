<?php

namespace App\Data;

class SearchData
{
  /**
   *
   * @var string
   */
  public $q = '';

  /**
   *
   * @var Genre[]
   */
  public $genre = [];

  /**
   *
   * @var null|integer
   */
  public $min;

  /**
   *
   * @var null|integer
   */
  public $max;

/**
 *
 * @var array
 */
  public $reviews = [];

}