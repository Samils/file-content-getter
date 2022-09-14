<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs
 * - Autoload, application dependencies
 *
 * MIT License
 *
 * Copyright (c) 2020 Ysare
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Sammy\Packs {
  /**
   * Make sure the module base internal class is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!class_exists ('Sammy\Packs\FileContentGetter')) {
  /**
   * @class FileContentGetter
   * Base internal class for the
   * FileContentGetter module.
   * -
   * This is (in the ils environment)
   * an instance of the php module,
   * wich should contain the module
   * core functionalities that should
   * be extended.
   * -
   * For extending the module, just create
   * an 'exts' directory in the module directory
   * and boot it by using the ils directory boot.
   * -
   */
  class FileContentGetter {
    use FileContentGetter\Base;
    use FileContentGetter\File;

    public function getFileLines ($file, $lines) {
      if (!is_array ($lines)) {
        return;
      }

      $args = array_slice (func_get_args (), 2, func_num_args ());

      $fileContent = self::FileContent ($file);

      if (isset ($lines ['from']) && isset ($lines ['to'])){
        $from = is_numeric($lines ['from']) ? (int)($lines ['from']) : 0;
        $to = is_numeric ($lines ['to']) ? (int)($lines ['to']) : 0;
      } elseif (isset ($lines [0]) && isset ($lines [1])){
        $in = is_numeric ($lines [0]) ? (int)($lines [0]) : 0;
        $get = is_numeric ($lines [1]) ? (int)($lines [1]) : 0;

        $from = (($in - $get) < 0) ? 0 : ($in - $get);
        $to = $in + $get;

      } elseif (isset ($lines ['in']) && isset ($lines ['get'])){
        $in = is_numeric ($lines ['in']) ? (int)($lines ['in']) : 0;
        $get = is_numeric ($lines ['get']) ? (int)($lines ['get']) : 0;

        $from = (($in - $get) < 0) ? (($in - $get) * (-1)) : ($in - $get);
        $to = $in + $get;

      } else {
        return;
      }

      $l = preg_split ('/\n/', htmlentities ($fileContent));
      $fl = [];

      $f = $from >= 1 ? ($from - 1) : $from;

      for ( ; $f <= $to - 1; $f++) {
        if (isset($l[$f])) {
          array_push($fl, ['num' => ($f + 1), 'content' => (
            preg_replace ('/\s/', '&nbsp;',
              preg_replace ('/\t/', str_repeat ('&nbsp;', 4), $l [$f])
            )
          )]);
        }
      }
      return $fl;
    }
  }}
}
