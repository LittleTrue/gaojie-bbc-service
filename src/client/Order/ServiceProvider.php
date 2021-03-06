<?php

namespace GaoJie\GaoJieClient\Order;

use GaoJie\GaoJieClient\Base\Credential;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ServiceProvider.
 */
class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $app)
    {
        $app['order'] = function ($app) {
            return new Client($app);
        };

        //注册验证器
        $app['credential'] = function ($app) {
            return new Credential($app);
        };
    }
}
