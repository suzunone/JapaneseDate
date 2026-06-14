#!/usr/bin/env php
<?php

/**
 * 国立天文台のデータを元にテストデータを生成する
 */
// 保存先ディレクトリの定数指定（末尾のスラッシュの有無は自動で吸収します）
const SAVE_DIR = __DIR__ . '/../fixtures/';

/**
 * URLからHTMLを取得し、定数 SAVE_DIR で指定されたディレクトリにキャッシュする関数
 *
 * @param string $url ターゲットURL
 * @return string|false HTML文字列（失敗時はfalse）
 */
function fetchHtmlWithCache(string $url): string|false
{
    // 1. 保存先ディレクトリのパスを整形・作成
    $base_dir = rtrim(SAVE_DIR, '/\\');
    if (!is_dir($base_dir) && !mkdir($base_dir, 0755, true) && !is_dir($base_dir)) {
        echo "Error: キャッシュディレクトリの作成に失敗しました ($base_dir)\n";

        return false;
    }

    // 2. URLからファイル名を抽出（例: rekiyou271.html）
    $filename = basename(parse_url($url, PHP_URL_PATH));
    if (empty($filename)) {
        $filename = md5($url) . '.html';
    }

    // ディレクトリパスとファイル名を結合してフルパスを生成
    $filepath = $base_dir . '/' . $filename;

    // 3. cURLセッションの初期化と実行
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $contents = curl_exec($ch);

    // cURLエラー（通信エラー、タイムアウトなど）のチェック
    if (curl_errno($ch)) {
        echo 'cURL Error: ' . curl_error($ch) . " (URL: $url)\n";
        curl_close($ch);

        return fallbackToLocal($filepath);
    }

    // HTTPステータスコードのチェック（404や500などをエラーとする）
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (PHP_VERSION_ID < 80500) {
        curl_close($ch);
    }

    if ($http_code < 200 || $http_code >= 300) {
        echo "HTTP Error: Status code $http_code (URL: $url)\n";

        return fallbackToLocal($filepath);
    }

    // 取得に成功した場合、指定のディレクトリへローカル保存（上書き）
    if (file_put_contents($filepath, $contents) === false) {
        echo "Warning: ファイルの保存に失敗しました ($filepath)\n";
    }

    return $contents;
}

/**
 * ローカルファイルのフォールバック処理
 *
 * @param string $filepath フルパス
 * @return string|false ファイル内容（ファイルが存在しない場合はfalse）
 */
function fallbackToLocal(string $filepath): string|false
{
    if (file_exists($filepath)) {
        echo "Notice: 読み込み失敗のため、ローカルキャッシュ ($filepath) からデータを復元します。\n";

        return file_get_contents($filepath);
    }
    echo "Error: ローカルキャッシュ ($filepath) も存在しません。\n";

    return false;
}

/**
 * @param string $url
 * @return string|false
 * @throws \JsonException
 */
function holiday(string $url): string|false
{
    $contents = fetchHtmlWithCache($url);
    if ($contents === false) {
        return json_encode([], JSON_THROW_ON_ERROR);
    }

    // 1. まず通常のUTF-8に変換する
    $contents = mb_convert_encoding($contents, 'UTF-8', 'Shift_JIS');

    // 2. DOMDocumentが確実にUTF-8として解釈できるようにメタタグを先頭に挿入する
    //    ※すでに meta head があっても、先頭にあるものが優先または上書き認識されます
    $contents = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $contents;

    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    // 3. メタタグが付与された状態のHTMLを読み込ませる
    $doc->loadHTML($contents);
    libxml_clear_errors();


    $xpath = new DOMXPath($doc);
    // summary属性が「国民の祝日」であるtable要素内のtr（ヘッダー行を除く）を取得
    $rows = $xpath->query('//table[@summary="国民の祝日"]/tr[td]');

    $holidays = [];

    foreach ($rows as $row) {
        $tds = $row->getElementsByTagName('td');
        if ($tds->length >= 2) {
            // 前後の不要な空白をトリミングして格納
            $name = trim($tds->item(0)->nodeValue, '  ');
            $date = trim($tds->item(1)->nodeValue, '  ');
            if ($name === '' || $date === '') {
                continue;
            }

            $holidays[] = [
                'name' => $name,
                'date' => $date
            ];
        }
    }

    // JSON形式に変換して出力（またはreturn）
    try {
        return json_encode($holidays, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    } catch (JsonException) {
        return false;
    }
}

/**
 * @param string $url
 * @return string|false
 * @throws \JsonException
 */
function season(string $url): string|false
{
    $contents = fetchHtmlWithCache($url);
    if ($contents === false) {
        return json_encode([], JSON_THROW_ON_ERROR);
    }

    // PHP 8.2+ 対応の文字化け対策（UTF-8変換 + メタタグ挿入）
    $contents = mb_convert_encoding($contents, 'UTF-8', 'Shift_JIS');
    $contents = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $contents;

    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($contents);
    libxml_clear_errors();

    $xpath = new DOMXPath($doc);
    // summary属性が「二十四節気および雑節」であるtable要素内のtr（ヘッダー行を除く）を取得
    $rows = $xpath->query('//table[@summary="二十四節気および雑節"]/tr[td]');

    $seasons = [];

    foreach ($rows as $row) {
        $tds = $row->getElementsByTagName('td');

        // テーブル内の区切り用の空行（tdが1つだけで中身が空など）はスキップ
        if ($tds->length < 3 || trim($tds->item(0)->nodeValue) === '') {
            continue;
        }

        // 1番目のtdから名称とクラス名（季節/雑節の分類）を取得
        $name_td = $tds->item(0);
        $name = trim($name_td->nodeValue);
        $type = $name_td->hasAttribute('class') ? trim($name_td->getAttribute('class')) : '';

        // 各項目のテキストを抽出・トリミング
        $solar_longitude = trim($tds->item(1)->nodeValue); // 太陽黄経
        $date = trim($tds->item(2)->nodeValue);            // 月日

        // 時間は存在しない場合（節分や彼岸など）があるため考慮
        $time = '';
        if ($tds->length >= 4) {
            $time = trim($tds->item(3)->nodeValue);
        }

        $seasons[] = [
            'name' => $name,
            'type' => $type, // spring, summer, fall, winter, zasetu
            'solar_longitude' => $solar_longitude,
            'date' => $date,
            'time' => $time
        ];
    }

    try {
        return json_encode($seasons, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    } catch (JsonException) {
        return false;
    }
}

/**
 * @param string $url
 * @return string|false
 * @throws \JsonException
 */
function moon(string $url): string|false
{
    $contents = fetchHtmlWithCache($url);
    if ($contents === false) {
        return json_encode([], JSON_THROW_ON_ERROR);
    }

    // PHP 8.2+ 対応の文字化け対策（UTF-8変換 + メタタグ挿入）
    $contents = mb_convert_encoding($contents, 'UTF-8', 'Shift_JIS');
    $contents = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . $contents;

    libxml_use_internal_errors(true);
    $doc = new DOMDocument();
    $doc->loadHTML($contents);
    libxml_clear_errors();

    $xpath = new DOMXPath($doc);
    // summary属性が「朔弦望」であるtable要素内のtr（ヘッダー行を除く）を取得
    $rows = $xpath->query('//table[@summary="朔弦望"]/tr[td]');

    $moons = [];

    foreach ($rows as $row) {
        $tds = $row->getElementsByTagName('td');

        // テーブル内の区切り用の空行はスキップ
        if ($tds->length < 3 || trim($tds->item(0)->nodeValue) === '') {
            continue;
        }

        // 各項目のテキストを抽出・トリミング（画像を除いたテキストのみが取得できます）
        $phase = trim($tds->item(0)->nodeValue); // 月相（朔、上弦、望、下弦）
        $date = trim($tds->item(1)->nodeValue); // 月日
        $time = trim($tds->item(2)->nodeValue); // 時刻

        $moons[] = [
            'phase' => $phase,
            'date' => $date,
            'time' => $time
        ];
    }

    try {
        return json_encode($moons, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    } catch (JsonException) {
        return false;
    }
}



foreach (include 'fixtures.php' as $year => $urls) {
    [,,$holiday_url, $season_url, $moon_url] = $urls;

    file_put_contents(SAVE_DIR.'holiday_'.$year.'.json', holiday($holiday_url));
    file_put_contents(SAVE_DIR.'season_'.$year.'.json', season($season_url));
    file_put_contents(SAVE_DIR.'moon_'.$year.'.json', moon($moon_url));
}
