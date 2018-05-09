<?php
/**
 * テストのベースクラス
 *
 *
 * PHP versions 5
 *
 *
 *
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     %%your_name%% <%%your_email%%>
 * @copyright  %%your_project%%
 * @license    %%your_license%%
 * @version    GIT: $Id$
 * @link       %%your_link%%
 * @see        http://www.enviphp.net/c/man/v3/core/unittest
 * @since      File available since Release 1.0.0
 * @doc_ignore
 */

require __DIR__.'/../../libs/JapaneseDateTime.php';

/**
 * テストのベースクラス
 *
 *
 *
 * @category   %%project_category%%
 * @package    %%project_name%%
 * @subpackage %%subpackage_name%%
 * @author     %%your_name%% <%%your_email%%>
 * @copyright  %%your_project%%
 * @license    %%your_license%%
 * @version    GIT: $Id$
 * @link       %%your_link%%
 * @see        http://www.enviphp.net/c/man/v3/core/unittest
 * @since      File available since Release 1.0.0
 * @doc_ignore
 */
class testCaseBase extends EnviTestCase
{

    /**
     * +-- コンストラクタ
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

    }
    /* ----------------------------------------- */

    /**
     * +-- 初期化
     *
     * @access public
     * @return void
     */
    public function initialize()
    {
    }
    /* ----------------------------------------- */


    /**
     * +-- 終了処理をする
     *
     * @access public
     * @return void
     */
    public function shutdown()
    {
    }
    /* ----------------------------------------- */


}

