<?php

namespace GaoJie\GaoJieService;

use GaoJie\GaoJieClient\Application;
use GaoJie\GaoJieClient\Base\Exceptions\ClientError;

/**
 * 订单API服务.
 */
class OrderService
{
    /**
     * @var orderClient
     */
    private $_orderClient;

    public function __construct(Application $app)
    {
        $this->_orderClient = $app['order'];
    }

    /**
     * 新增商品.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function addOrder(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_orderClient->addOrder($infos);
    }

    /**
     * 订单查询.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function checkOrder(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_orderClient->checkOrder($infos);
    }

    /**
     * 订单修改.
     *
     * @throws ClientError
     * @throws \Exception
     */
    public function updateOrder(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_orderClient->updateOrder($infos);
    }
}
