<?php

namespace  Codwelt\codinstagram\clases;

class tools
{

    /**
     * @param $data
     * @return TYPE_NAME|null
     */
    public static function forceToArray($data)
    {
        if (is_null($data)) {
            return null;
        } else {
            try {
                if (count($data) > 0 || isset($data)) {
                    /** @var TYPE_NAME $data */
                    $data = $data->toArray();
                } else {
                    $data = null;
                }
                return $data;
            } catch (\Exception $e) {
               return $data->toArray();
            }
        }
    }
}
