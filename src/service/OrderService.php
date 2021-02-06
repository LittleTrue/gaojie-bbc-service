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
     * @param array $infos
     * @return
     * @throws ClientError
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
     * @param array $infos
     * @return
     * @throws ClientError
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
     * @param array $infos
     * @return
     * @throws ClientError
     */
    public function updateOrder(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_orderClient->updateOrder($infos);
    }

    /**
     * 订单物流单号查询.
     * @param array $infos
     * @return mixed
     * @throws ClientError
     */
    public function checkLogistics(array $infos)
    {
        if (empty($infos)) {
            throw new ClientError('参数缺失', 1000001);
        }

        return $this->_orderClient->checkLogistics($infos);
    }
}
