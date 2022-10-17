<?php

namespace App\Utils;

/**
 * Max length = 6
 * For eg: x9aLd3, 0LPxYi, aXd91S, pLax78, 091XsD
 * The voucher code must be Unique, Case Sensitive, Alpha-Numeric. (No Symbol allowed)
 * The voucher code must be scrambled, non-sequence, and public users not able to guess the code patterns easily.
 *
 * @return @var string
 */
class Utility
{
  static function generateCodeString() {
    return substr(bin2hex(random_bytes(4)), 0, 6);
  }
}