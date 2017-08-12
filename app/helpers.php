<?php

function cdnPath($cdn, $asset)
{
    return '//'.rtrim($cdn, '/').'/'.ltrim($asset, '/');
}

function cdn($asset)
{
    if (Config::get('cdn')) {
        $cdns = Config::get('cdn');
        $assetName = explode('?', basename($asset));

        foreach ($cdns as $cdn => $types) {
            if (preg_match('/^.*\.('.$types.')$/i', $assetName[0])) {
                return cdnPath($cdn, $asset);
            }
        }

        end($cdns);

        $path = cdnPath(key($cdns), $asset);
    } else {
        $path = asset($asset);
    }

    return $path;
}
