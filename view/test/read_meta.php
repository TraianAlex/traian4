<?php

$result = getUrlData2('http://localhost/traian3/new-pdo');
echo '<pre>';print_r($result);echo '</pre>';
echo $result['title'], '<br>';

function getUrlData2($url) {
    $result = false;
    $contents = getUrlContents2($url);
    if (isset($contents) && is_string($contents)) {
        $title = null;
        $metaTags = null;
        preg_match('/<title>([^>]*)<\/title>/si', $contents, $match);
        if (isset($match) && is_array($match) && count($match) > 0) {
            $title = strip_tags($match[1]);
        }
        preg_match_all('/<[\s]*meta[\s]*name="?' . '([^>"]*)"?[\s]*' . 'content="?([^>"]*)"?[\s]*[\/]?[\s]*>/si', $contents, $match);
        if (isset($match) && is_array($match) && count($match) == 3) {
            $originals = $match[0];
            $names = $match[1];
            $values = $match[2];
            if (count($originals) == count($names) && count($names) == count($values)) {
                $metaTags = array();
                for ($i = 0, $limiti = count($names); $i < $limiti; $i++) {
                    $metaTags[$names[$i]] = array(
                        'html' => htmlentities($originals[$i]),
                        'value' => $values[$i]
                    );
                }
            }
        }
        $result = array(
            'title' => $title,
            'metaTags' => $metaTags
        );
    }
    return $result;
}

function getUrlContents2($url, $maximumRedirections = null, $currentRedirection = 0) {
    $result = false;
    $contents = @file_get_contents($url);
    // Check if we need to go somewhere else
    if (isset($contents) && is_string($contents)) {
        preg_match_all('/<[\s]*meta[\s]*http-equiv="?REFRESH"?' . '[\s]*content="?[0-9]*;[\s]*URL[\s]*=[\s]*([^>"]*)"?' . '[\s]*[\/]?[\s]*>/si', $contents, $match);
        if (isset($match) && is_array($match) && count($match) == 2 && count($match[1]) == 1) {
            if (!isset($maximumRedirections) || $currentRedirection < $maximumRedirections) {
                return getUrlContents($match[1][0], $maximumRedirections, ++$currentRedirection);
            }
            $result = false;
        } else {
            $result = $contents;
        }
    }
    return $contents;
}

/*
  New version based on mariano at cricava dot com's work with:
  1) Support for Meta properties (like Facebook's og tags).
  2) Support for Unicode (UTF-8) encoded Meta lines.
  3) An option not to convert htmlentities - if you plan to actually use the results and not just display them.
 */
$result = getUrlData('http://localhost/traian3/new-pdo', true);
echo '<pre>';
print_r($result, true);
echo '</pre>';

function getUrlData($url, $raw = false) { // $raw - enable for raw display
    $result = false;
    $contents = getUrlContents($url);
    if (isset($contents) && is_string($contents)) {
        $title = null;
        $metaTags = null;
        $metaProperties = null;
        preg_match('/<title>([^>]*)<\/title>/si', $contents, $match);
        if (isset($match) && is_array($match) && count($match) > 0) {
            $title = strip_tags($match[1]);
        }
        preg_match_all('/<[\s]*meta[\s]*(name|property)="?' . '([^>"]*)"?[\s]*' . 'content="?([^>"]*)"?[\s]*[\/]?[\s]*>/si', $contents, $match);
        if (isset($match) && is_array($match) && count($match) == 4) {
            $originals = $match[0];
            $names = $match[2];
            $values = $match[3];
            if (count($originals) == count($names) && count($names) == count($values)) {
                $metaTags = array();
                $metaProperties = $metaTags;
                if ($raw) {
                    if (version_compare(PHP_VERSION, '5.4.0') == -1)
                        $flags = ENT_COMPAT;
                    else
                        $flags = ENT_COMPAT | ENT_HTML401;
                }
                for ($i = 0, $limiti = count($names); $i < $limiti; $i++) {
                    if ($match[1][$i] == 'name')
                        $meta_type = 'metaTags';
                    else
                        $meta_type = 'metaProperties';
                    if ($raw)
                        ${$meta_type}[$names[$i]] = array(
                            'html' => htmlentities($originals[$i], $flags, 'UTF-8'),
                            'value' => $values[$i]
                        );
                    else
                        ${$meta_type}[$names[$i]] = array(
                            'html' => $originals[$i],
                            'value' => $values[$i]
                        );
                }
            }
        }
        $result = array(
            'title' => $title,
            'metaTags' => $metaTags,
            'metaProperties' => $metaProperties,
        );
    }
    return $result;
}

function getUrlContents($url, $maximumRedirections = null, $currentRedirection = 0) {
    $result = false;
    $contents = @file_get_contents($url);
    // Check if we need to go somewhere else
    if (isset($contents) && is_string($contents)) {
        preg_match_all('/<[\s]*meta[\s]*http-equiv="?REFRESH"?' . '[\s]*content="?[0-9]*;[\s]*URL[\s]*=[\s]*([^>"]*)"?' . '[\s]*[\/]?[\s]*>/si', $contents, $match);
        if (isset($match) && is_array($match) && count($match) == 2 && count($match[1]) == 1) {
            if (!isset($maximumRedirections) || $currentRedirection < $maximumRedirections) {
                return getUrlContents($match[1][0], $maximumRedirections, ++$currentRedirection);
            }
            $result = false;
        } else {
            $result = $contents;
        }
    }
    return $contents;
}

$tags = get_meta_tags(BASE);
// Notice how the keys are all lowercase now, and
// how . was replaced by _ in the key.
//echo $tags['author'];       // name
//echo $tags['keywords'];     // php documentation
//echo $tags['description'];  // a php manual
//echo $tags['geo_position']; // 49.33;-86.59
//echo $tags['viewport'],'<br>';
//echo $tags['token'],'<br>';

$res = getUrlData2(BASE);
//echo '<pre>';print_r($res);echo '</pre>';
//echo $res['metaTags']['token']['value'],'<br>';
//echo Sessions::get('head'),'<br>';