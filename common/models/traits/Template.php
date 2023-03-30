<?php

namespace common\models\traits;

use api\templates\DefaultTemplate;
use TRS\RestResponse\templates\BaseTemplate;

trait Template
{

    /**
     * @param string $template
     * @return array
    */
    public function getAsArray($template = null, array $config = [])
    {
        $template = $template ?? DefaultTemplate::class;

        if (
            !class_exists($template)
            ||
            !(($templateBuilder = new $template($this)) instanceof BaseTemplate)
        ) {
            throw new \InvalidArgumentException(sprintf('Invalid template "%s"', $template));
        }

        if (property_exists($templateBuilder, 'config')) {
            $templateBuilder->config = $config;
        }
        return $templateBuilder->getAsArray();
    }
}
