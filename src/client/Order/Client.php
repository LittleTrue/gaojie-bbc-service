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

        //验证主体配置
        $this->credentialValidate->setRule(
            [
                'seller|账号名称' => 'require',
                'api_key|验证码' => 'require',
                'order|订单信息'  => 'require',
            ]
        );
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置:' . $this->credentialValidate->getError());
        }

        //验证订单信息
        $this->credentialValidate->setRule(
            [
                'order_sn|订单编号'                   => 'require',
                'buyer_name|买家姓名'                 => 'require',
                'buyer_phone|买家电话号码'              => 'require',
                'buyer_idcard|买家身份证号码'            => 'require',
                'country_code|国家、地区代码'            => 'require',
                'province_code|省、市、区代码'           => 'require', //固定
                'buyer_address|买家地址'              => 'require',
                'sender_name|发货人姓名'               => 'require',
                'sender_phone|发货人电话号码'            => 'require',
                'sender_country_code|发货人国家、地区代码'  => 'require',
                'sender_province_code|发货人省、市、区代码' => 'require',
                'sender_address|发货人地址'            => 'require',
                'main_desc|订单商品描述'                => 'require',  //固定
                'order_name|订购人姓名'                => 'require',
                'order_idnum|订购人身份证'              => 'require',
                'order_tel|订购人电话号码'               => 'require',
                'order_account_num|订购人平台注册号'      => 'require',
                'record_no_qg|平台企业备案号'            => 'require',
                'record_name|平台企业备案名称'            => 'require',
                'customs_code|关区代码'               => 'require',
                //                'warehouse_code|仓库代码'             => 'require',
                //                'handlook_number|海关账册号'           => 'require',
                'order_goods|订单商品明细' => 'require',
            ]
        );
        if (!$this->credentialValidate->check($infos['order'])) {
            throw new ClientError('订单信息:' . $this->credentialValidate->getError());
        }

        //验证订单商品明细
        $this->credentialValidate->setRule(
            [
                'customs_goods_id|备案商品ID'  => 'require',
                'goods_num|订单商品数量'         => 'require',
                'goods_price|订单商品单价'       => 'require',
                'trade_curr|订单币制代码'        => 'require',
                'order_goods_barcode|商品条码' => 'require',
            ]
        );
        foreach ($infos['order']['order_goods'] as $value) {
            if (!$this->credentialValidate->check($value)) {
                throw new ClientError('订单商品明细:' . $this->credentialValidate->getError());
            }
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

        //验证主体配置
        $this->credentialValidate->setRule(
            [
                'seller|账号名称' => 'require',
                'api_key|验证码' => 'require',
                'order|订单信息'  => 'require',
            ]
        );
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置:' . $this->credentialValidate->getError());
        }

        //验证订单信息
        $this->credentialValidate->setRule(
            [
                'order_sn|订单号码' => 'require',
            ]
        );
        if (!$this->credentialValidate->check($infos['order'])) {
            throw new ClientError('订单信息:' . $this->credentialValidate->getError());
        }

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

        //验证主体配置
        $this->credentialValidate->setRule(
            [
                'seller|账号名称' => 'require',
                'api_key|验证码' => 'require',
                'order|订单信息'  => 'require',
            ]
        );
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置:' . $this->credentialValidate->getError());
        }

        //验证订单信息
        $this->credentialValidate->setRule(
            [
                'order_sn|订单编号'      => 'require',
                'order_name|订购人姓名'   => 'require',
                'order_idnum|订购人身份证' => 'require',
            ]
        );
        if (!$this->credentialValidate->check($infos['order'])) {
            throw new ClientError('订单信息:' . $this->credentialValidate->getError());
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

        //验证主体配置
        $this->credentialValidate->setRule(
            [
                'seller|账号名称' => 'require',
                'api_key|验证码' => 'require',
                'order|订单信息'  => 'require',
            ]
        );
        if (!$this->credentialValidate->check($infos)) {
            throw new ClientError('主体配置:' . $this->credentialValidate->getError());
        }

        //验证订单信息
        $this->credentialValidate->setRule(
            [
                'order_sn|报关订单编号' => 'require',
            ]
        );
        if (!$this->credentialValidate->check($infos['order'])) {
            throw new ClientError('订单信息:' . $this->credentialValidate->getError());
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
