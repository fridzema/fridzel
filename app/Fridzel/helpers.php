<?php

function cdnPath($cdn, $asset)
{
    return '//'.rtrim($cdn, '/').'/'.ltrim($asset, '/');
}

function cdn($asset)
{
		$cdn_config = Config::get('cdn');
    if ($cdn_config) {
        $assetName = explode('?', basename($asset));

        foreach ($cdn_config as $cdn => $types) {
            if (preg_match('/^.*\.('.$types.')$/i', $assetName[0])) {
                return cdnPath($cdn, $asset);
            }
        }

        end($cdn_config);

        $path = cdnPath(key($cdn_config), $asset);
    } else {
        $path = asset($asset);
    }

    return $path;
}
