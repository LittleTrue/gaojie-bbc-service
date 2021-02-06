<?php

namespace GaoJie\GaoJieClient\Order;

use GaoJie\GaoJieClient\Application;
use GaoJie\GaoJieClient\Base\BaseClient;
use GaoJie\GaoJieClient\Base\Exceptions\ClientError;

/**
 * 订单API客户端.
 */
class Client extends BaseClient
{
    /**
     * @var Application
     */
    protected $credentialValidate;

    /**
     * @var Application
     */
    protected $authAuto;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        $this->credentialValidate = $app['credential'];
    }

    /**
     * 新增订单.
     *
     * @throws ClientError
     */
    public function addOrder(array $infos)
    {
        $param = [];

        //使用Credential验证参数
        $this->credentialValidate->setRule(
            [
                'seller|账号名称' => 'require',
                'api_key|验证码' => 'require',
                'order|订单信息'  => 'require',
            ]
        );

        //验证
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置:' . $this->credentialValidate->getError());
        }

        $param['seller']   = base64_encode($infos['seller']);
        $param['api_key']  = base64_encode($infos['api_key']);
        $param['mark']     = base64_encode('add_orders');
        $param['function'] = base64_encode('order');
        $param['order']    = base64_encode(\GuzzleHttp\json_encode($infos['order'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->setParams($param);

        return $this->httpPostFormParams('');
    }

    /**
     * 订单查询.
     */
    public function checkOrder(array $infos)
    {
        $param = [];

        //使用Credential验证参数
        $this->credentialValidate->setRule(
            [
                'seller|账号名称' => 'require',
                'api_key|验证码' => 'require',
                'order|订单信息'  => 'require',
            ]
        );

        //验证
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        array_push($infos['order'], count($infos['order']['order_sn']));

        $param['seller']   = base64_encode($infos['seller']);
        $param['api_key']  = base64_encode($infos['api_key']);
        $param['mark']     = base64_encode('select_orders');
        $param['function'] = base64_encode('order');
        $param['order']    = base64_encode(\GuzzleHttp\json_encode($infos['order'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->setParams($param);

        return $this->httpPostFormParams('');
    }

    /**
     * 订单修改.
     */
    public function updateOrder(array $infos)
    {
        $param = [];

        //使用Credential验证参数
        $this->credentialValidate->setRule(
            [
                'seller|账号名称' => 'require',
                'api_key|验证码' => 'require',
                'order|订单信息'  => 'require',
            ]
        );

        //验证
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        $param['seller']   = base64_encode($infos['seller']);
        $param['api_key']  = base64_encode($infos['api_key']);
        $param['mark']     = base64_encode('edit_orders');
        $param['function'] = base64_encode('order');
        $param['order']    = base64_encode(\GuzzleHttp\json_encode($infos['order'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->setParams($param);

        return $this->httpPostFormParams('');
    }

    /**
     * 订单物流单号查询.
     */
    public function checkLogistics(array $infos)
    {
        $param = [];

        //使用Credential验证参数
        $this->credentialValidate->setRule(
            [
                'seller|账号名称' => 'require',
                'api_key|验证码' => 'require',
                'order|订单信息'  => 'require',
            ]
        );

        //验证
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置' . $this->credentialValidate->getError());
        }

        $param['seller']   = base64_encode($infos['seller']);
        $param['api_key']  = base64_encode($infos['api_key']);
        $param['mark']     = base64_encode('select_package');
        $param['function'] = base64_encode('order');
        $param['order']    = base64_encode(\GuzzleHttp\json_encode($infos['order'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        $this->setParams($param);

        return $this->httpPostFormParams('');
    }
}
